<?php
$help = <<<'HELP'
lineageos_stats.php is a command-line script to download LineageOS stats
about the number of builds and installs from https://stats.lineageos.org
It displays more information than is provided by the LineageOS web page,
which only displays builds by their code name and countries by their ISO
codes. This script can search for countries by their English names and 
for builds by their device model names. It tallies the total builds and 
installs by country, device manufacturer, processor family, release year
of devices, build status and LineageOS version number.   
  
By default the script shows the country list and the build list with 
statistics tables at the end. If information is known about a build 
(device model, manufacturer, processor family, device release year), 
that is displayed in the build list. There is normally 1 build per 
device model, but some builds support multiple device models.

The information in the lists is separated by tabs, so you can copy it 
from the terminal and paste it into your favorite spreadsheet 
application. It is much easier to read in a spreadsheet. 
 
Getting the country list is fast, but getting the build list is
very slow because the script has to download roughly 1500 web pages to
get all the builds for each country to construct the build list, and 
there are some less popular builds that it won't find because LineageOS 
only provides the top 250 builds for each country. LineageOS doesn't 
provide a complete list of builds, but it does provide a total installs 
number, so any installs that aren't found are tallied at the end of the 
list under "Other builds". 

The status codes for the builds are: O=active official build, 
D=discontinued official build, U=unofficial build 
 
INSTALLATION:   
1. Install the command line interface for PHP 7 or later. 
2. Download this script from https://github.com/amosbatto/lineageos_stats
   If the ZIP file was downloaded, then decompress it. 
  
In a Debian/Ubuntu/Mint terminal, these commands should work:  
  sudo apt install php
  wget -O lineageos_stats.zip https://github.com/amosbatto/lineageos_stats/archive/refs/heads/main.zip
  unzip lineageos_stats.zip -d lineageos_stats
  
EXECUTION:  
To run the script in a terminal:  
  php lineageos_stats.php
  
Depending on how you installed PHP, you may have to include the path to 
execute it. For example in Windows:  
  C:\users\bob\php8.3\php.exe lineageos_stats.php 

Command line options:  
 -c , --country   Display the country list.   
                  Ex: php lineageos_stats.php -c  
                  
 -cXX             Can specify an optional two letter country code or a
 --country=XX     country name to display stats for a single country.  
                  Ex: php lineageos_stats.php -cUS  
                  Ex: php lineageos_stats.php --country=BR  
                  Ex: php lineageos_stats.php -c"United Arab Emirates"  
                  
 -b , --build     Display the build list.  
                  Ex: php lineageos_stats.php -b  
  
 -bCODENAME       Can specify a buid codename or a device model name to  
 --build=CODENAME display stats for a single build.  
                  Ex: php lineageos_stats.php -blavender  
                  Ex: php lineageos_stats.php --build=lavender  
                  Ex: php lineageos_stats.php -b"Xiaomi Redmi Note 7"  
                  Ex: php lineageos_stats.php --build="nOtE 7"  
                  The search is case insensitive and can find partial   
                  strings.
                   
 -i , --installs  Only show the number of installs and not other stats.     
                  
 -v , --verbose   Show information about what countries are being  
                  downloaded and what builds were found. Recommended for
                  progress on how script is progressing when getting the
                  build list.  

Author:  Amos Batto (amosbatto[AT]yahoo.com, https://amosbbatto.wordpress.com)
License: MIT license (for the lineageos_stats script and the included 
         SimpleHtmlDom (https://sourceforge.net/projects/simplehtmldom)
Date:    2025-10-19 (version 0.1)

HELP;

$startTime = microtime(true);
 
try {
	require('./simple_html_dom/simple_html_dom.php');
}
catch (Exception $e) {
	die($e->getMessage() . 
		"\nCannot find simple_html_dom.php. See the INSTALLATION directions below:\n\n" . $help);
} 

$GLOBALS["OS"] = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? "windows" : "unix-like";

$shortOpts = 'hvic::b::';
$longOpts  = array('help', 'verbose', 'installs', 'country::', 'build::');
$options = getopt($shortOpts, $longOpts);

if (isset($options['h']) || isset($options['help'])) {
	echo $help;
	exit(0);
}

$GLOBALS['verbose'] = $verbose = (isset($options['v']) || isset($options['verbose'])) ? true : false;
$GLOBALS['onlyShowInstalls'] = $onlyShowInstalls = 
	(isset($options['i']) || isset($options['installs'])) ? true : false;

$showCountry = "default";
$showBuild   = "default";

if (isset($options['c']) or isset($options['country'])) {
	$showBuild = false;
	
	if (isset($options['c']) and $options['c']) 
		$showCountry = $options['c'];
	
	if (isset($options['country']) and $options['country']) 
		$showCountry = $options['country'];
}

if (isset($options['b']) or isset($options['build'])) {
	if ($showCountry == "default")
		$showCountry = false;
	
	if (isset($options['b']) and $options['b'])
		$showBuild = $options['b'];
	
	if (isset($options['build']) and $options['build'])  
		$showBuild = $options['build'];
}

$GLOBALS['countryData'] = $countryData = [
	'AF' => ['Afghanistan', 43844.11],
	'AX' => ['Åland Islands', ''],
	'AL' => ['Albania', 2771.51],
	'DZ' => ['Algeria', 47435.31],
	'AS' => ['American Samoa', 46.03],
	'AD' => ['Andorra', 82.9],
	'AO' => ['Angola', 39040.04],
	'AI' => ['Anguilla', 14.73],
	'AG' => ['Antigua and Barbuda', 94.21],
	'AR' => ['Argentina', 45851.38],
	'AM' => ['Armenia', 2952.37],
	'AW' => ['Aruba', 108.15],
	'AU' => ['Australia', 26974.03],
	'AT' => ['Austria', 9113.57],
	'AZ' => ['Azerbaijan', 10397.71],
	'BS' => ['Bahamas', 403.03],
	'BH' => ['Bahrain', 1643.33],
	'BD' => ['Bangladesh', 175686.9],
	'BB' => ['Barbados', 282.62],
	'BY' => ['Belarus', 8997.6],
	'BE' => ['Belgium', 11758.6],
	'BZ' => ['Belize', 422.92],
	'BJ' => ['Benin', 14814.46],      //LOS also uses "DY" (Dahomey) for the same country
	'DY' => ['Benin', 14814.46],
	'BM' => ['Bermuda', 64.56],
	'BT' => ['Bhutan', 796.68],
	'BO' => ['Bolivia', 12581.84],
	'BQ' => ['Bonaire, Sint Eustatius and Saba', 31.34],
	'BA' => ['Bosnia and Herzegovina', 3140.1],
	'BW' => ['Botswana', 2562.12],
	'BV' => ['Bouvet Island', ''],
	'BR' => ['Brazil', 212812.41],
	'IO' => ['British Indian Ocean Territory', 39.73],
	'BN' => ['Brunei Darussalam', 466.33],
	'BG' => ['Bulgaria', 6714.56],
	'BF' => ['Burkina Faso', 24074.58],
	'BI' => ['Burundi', 14390],
	'CV' => ['Cape Verde', 527.33],
	'KH' => ['Cambodia', 17847.98],
	'CM' => ['Cameroon', 29879.34],
	'CA' => ['Canada', 40126.72],
	'KY' => ['Cayman Islands', 75.84],
	'CF' => ['Central African Republic', 5513.28],
	'TD' => ['Chad', 21003.71],
	'CL' => ['Chile', 19859.92],
	'CN' => ['China', 1416096.09],
	'CX' => ['Christmas Island', ''],
	'CC' => ['Cocos (Keeling) Islands', ''],
	'CO' => ['Colombia', 53425.64],
	'KM' => ['Comoros', 882.85],
	'CG' => ['Congo', 6484.44],
	'CD' => ['Democratic Republic of Congo', 112832.47],
	'CK' => ['Cook Islands', 13.26],
	'CR' => ['Costa Rica', 5152.95],
	'CI' => ["Côte d'Ivoire", 32711.55],
	'HR' => ['Croatia', 3848.16],
	'CU' => ['Cuba', 10937.2],
	'CW' => ['Curaçao', 185.49],
	'CY' => ['Cyprus', 1370.75],
	'CZ' => ['Czech Republic', 10609.24],  //LOS also uses 'XC' for the same country
	'XC' => ['Czech Republic', 10609.24],
	'DK' => ['Denmark', 6002.51],
	'DJ' => ['Djibouti', 1184.08],
	'DM' => ['Dominica', 65.87],
	'DO' => ['Dominican Republic', 11520.49],
	'EC' => ['Ecuador', 18289.9],
	'EG' => ['Egypt', 118366],
	'SV' => ['El Salvador', 6365.5],
	'GQ' => ['Equatorial Guinea', 1938.43],
	'ER' => ['Eritrea', 3607],
	'EE' => ['Estonia', 1344.23],
	'SZ' => ['Eswatini', 1256.17],
	'ET' => ['Ethiopia', 135472.05],
	'FK' => ['Falkland Islands (Malvinas)', 3.47],
	'FO' => ['Faroe Islands', 56],
	'FJ' => ['Fiji', 933.15],
	'FI' => ['Finland', 5623.33],
	'FR' => ['France', 66650.8],
	'GF' => ['French Guiana', 313.67],
	'PF' => ['French Polynesia', 282.47],
	'TF' => ['French Southern Territories', ''],
	'GA' => ['Gabon', 2593.13],
	'GM' => ['Gambia', 2822.09],
	'GE' => ['Georgia', 3806.67],
	'DE' => ['Germany', 84075.08],
	'GH' => ['Ghana', 35064.27],
	'GI' => ['Gibraltar', 40.13],
	'GR' => ['Greece', 9938.84],
	'GL' => ['Greenland', 55.75],
	'GD' => ['Grenada', 117.3],
	'GP' => ['Guadeloupe', 373.79],
	'GU' => ['Guam', 169],
	'GT' => ['Guatemala', 18687.88],
	'GG' => ['Guernsey', 64.48],
	'GN' => ['Guinea', 15099.73],
	'GW' => ['Guinea-Bissau', 2249.52],
	'GY' => ['Guyana', 835.99],
	'HT' => ['Haiti', 11906.1],
	'HM' => ['Heard Island and McDonald Islands', ''],
	'VA' => ['Vatican City', 0.5],
	'HN' => ['Honduras', 11005.85],
	'HK' => ['Hong Kong', 7396.08],
	'HU' => ['Hungary', 9632.29],
	'IS' => ['Iceland', 398.27],        //LOS also uses "IC" for the same country
	'IC' => ['Iceland', 398.27],
	'IN' => ['India', 1463865.53],
	'ID' => ['Indonesia', 285721.24],
	'IR' => ['Iran', 92417.68],
	'IQ' => ['Iraq', 47020.77],
	'IE' => ['Ireland', 5308.04],
	'IM' => ['Isle of Man', 84.12],
	'IL' => ['Israel', 9517.18],
	'IT' => ['Italy', 59146.26],
	'JM' => ['Jamaica', 2837.08],
	'JP' => ['Japan', 123103.48],
	'JE' => ['Jersey', 103.99],
	'JO' => ['Jordan', 11520.68],
	'KZ' => ['Kazakhstan', 20843.75],
	'KE' => ['Kenya', 57532.49],
	'KI' => ['Kiribati', 136.49],
	'KR' => ['South Korea', 51667.03],
	'XK' => ['Kosovo', 1674.13],
	'KW' => ['Kuwait', 5026.08],
	'KG' => ['Kyrgyzstan', 7295.03],
	'LA' => ['Laos', 7873.05],
	'LV' => ['Latvia', 1853.56],
	'LB' => ['Lebanon', 5849.42],
	'LS' => ['Lesotho', 2363.33],
	'LR' => ['Liberia', 5731.21],
	'LY' => ['Libya', 7458.56],
	'LI' => ['Liechtenstein', 40.13],
	'LT' => ['Lithuania', 2830.14],
	'LU' => ['Luxembourg', 680.45],
	'MO' => ['Macao', 722],
	'MK' => ['Macedonia', 1813.79],
	'MG' => ['Madagascar', 32740.68],
	'MW' => ['Malawi', 22216.12],
	'MY' => ['Malaysia', 35977.84],
	'MV' => ['Maldives', 529.68],
	'ML' => ['Mali', 25198.82],
	'MT' => ['Malta', 545.41],
	'MH' => ['Marshall Islands', 36.28],
	'MQ' => ['Martinique', 340.44],
	'MR' => ['Mauritania', 5315.07],
	'MU' => ['Mauritius', 1268.28],
	'YT' => ['Mayotte', 337.01],
	'MX' => ['Mexico', 131946.9],
	'FM' => ['Micronesia', 528.68],
	'MD' => ['Moldova', 113.68],
	'MC' => ['Monaco', 38.34],
	'MN' => ['Mongolia', 3517.1],
	'ME' => ['Montenegro', 632.73],
	'MS' => ['Montserrat', 4.36],
	'MA' => ['Morocco', 38430.77],
	'MZ' => ['Mozambique', 35631.65],
	'MM' => ['Myanmar', 54850.65],
	'NA' => ['Namibia', 3092.82],
	'NR' => ['Nauru', 12.03],
	'NP' => ['Nepal', 29618.12],
	'NL' => ['Netherlands', 18346.82],
	'NC' => ['New Caledonia', 295.33],
	'NZ' => ['New Zealand', 5251.9],
	'NI' => ['Nicaragua', 7007.5],
	'NE' => ['Niger', 27917.83],
	'NG' => ['Nigeria', 237527.78],
	'NU' => ['Niue', 1.82],
	'KP' => ['North Korea', 26571],
	'NF' => ['Norfolk Island', ''],
	'MP' => ['Northern Mariana Islands', 43.54],
	'NO' => ['Norway', 5623.07],
	'OM' => ['Oman', 5494.69],
	'PK' => ['Pakistan', 255219.55],
	'PW' => ['Palau', 17.66],
	'PS' => ['Palestine, State of', 5589.62],
	'PA' => ['Panama', 4571.19],
	'PG' => ['Papua New Guinea', 10762.82],
	'PY' => ['Paraguay', 7013.08],
	'PE' => ['Peru', 34576.67],
	'PH' => ['Philippines', 116786.96],
	'PN' => ['Pitcairn', ''],
	'PL' => ['Poland', 38140.91],
	'PT' => ['Portugal', 10411.83],
	'PR' => ['Puerto Rico', 3235.29],
	'QA' => ['Qatar', 3115.89],
	'MD' => ['Moldova', 2996.11],
	'RE' => ['Réunion', 882.41],
	'RO' => ['Romania', 18908.65],
	'RU' => ['Russian Federation', 143997.39],
	'RW' => ['Rwanda', 14569.34],
	'BL' => ['Saint Barthélemy', 11.41],
	'SH' => ['Saint Helena, Ascension and Tristan da Cunha', 5.2],
	'KN' => ['Saint Kitts and Nevis', 46.92],
	'LC' => ['Saint Lucia', 180.15],
	'MF' => ['Saint Martin (French part)', 24.94],
	'PM' => ['Saint Pierre and Miquelon', 5.57],
	'VC' => ['Saint Vincent and the Grenadines', 99.92],
	'WS' => ['Samoa', 219.31],
	'SM' => ['San Marino', 33.57],
	'ST' => ['Sao Tome and Principe', 240.25],
	'SA' => ['Saudi Arabia', 34566.33],
	'SN' => ['Senegal', 18931.97],
	'RS' => ['Serbia', 6689.04],
	'SC' => ['Seychelles', 132.78],
	'SL' => ['Sierra Leone', 8819.79],
	'SG' => ['Singapore', 5870.75],
	'NN' => ['Sint Maarten (Dutch part)', 43.92], //Really "SX", but LOS uses "NN"
	'SX' => ['Sint Maarten (Dutch part)', 43.92],
	'SK' => ['Slovakia', 5474.88],
	'SI' => ['Slovenia', 2117.07],
	'SB' => ['Solomon Islands', 838.65],
	'SO' => ['Somalia', 19654.74],
	'ZA' => ['South Africa', 64747.32],
	'GS' => ['South Georgia and the South Sandwich Islands', ''],
	'SS' => ['South Sudan', 12188.79],
	'ES' => ['Spain', 47889.96],
	'LK' => ['Sri Lanka', 23229.47],
	'SD' => ['Sudan', 51662.15],
	'SR' => ['Suriname', 639.85],
	'SJ' => ['Svalbard and Jan Mayen', ''],
	'SE' => ['Sweden', 10656.63],
	'CH' => ['Switzerland', 8967.41],
	'SY' => ['Syrian Arab Republic', 25620.43],
	'TW' => ['Taiwan', 23112.79],
	'TJ' => ['Tajikistan', 10786.73],
	'TZ' => ['Tanzania', 70546],
	'TH' => ['Thailand', 71619.86],
	'TL' => ['Timor-Leste', 1418.52],
	'TG' => ['Togo', 9721.61],
	'TK' => ['Tokelau', 2.61],
	'TO' => ['Tonga', 103.74],
	'TT' => ['Trinidad and Tobago', 1511.16],
	'TN' => ['Tunisia', 12348.57],
	'TR' => ['Turkey', 87685.43],
	'TM' => ['Turkmenistan', 7618.85],
	'TC' => ['Turks and Caicos Islands', 46.86],
	'TV' => ['Tuvalu', 9.49],
	'UG' => ['Uganda', 51384.89],
	'UA' => ['Ukraine', 38980.38],
	'AE' => ['United Arab Emirates', 11346],
	'GB' => ['United Kingdom', 69551.33],     //LOS also uses "UK" for same country
	'UK' => ['United Kingdom', 69551.33],
	'US' => ['United States', 347275.81],
	'UM' => ['United States Minor Outlying Islands', 84.14],
	'UY' => ['Uruguay', 3384.69],
	'UZ' => ['Uzbekistan', 37053.43],
	'VU' => ['Vanuatu', 335.17],
	'VE' => ['Venezuela', 28516.9],
	'VN' => ['Viet Nam', 101598.53],
	'VG' => ['Virgin Islands, British', ''],
	'VI' => ['Virgin Islands, U.S.', ''],
	'WF' => ['Wallis and Futuna', 11.19],
	'EH' => ['Western Sahara', 600.9],
	'YE' => ['Yemen', 41773.88],
	'ZM' => ['Zambia', 21913.87],
	'ZW' => ['Zimbabwe', 16950.8],
	'World' => ['World', 8231613.07]
	//LOS also uses "EA", which isn't an ISO code, but could mean "East Africa" or "Euro Area". 
	//It only has 2 installs and an unknown carrier, so hard to figure out where it is.
	
	//world population data from United Nations, medium variant projection for July 1, 2025
	//https://population.un.org/wpp/assets/Excel%20Files/1_Indicator%20(Standard)/EXCEL_FILES/1_General/WPP2024_GEN_F01_DEMOGRAPHIC_INDICATORS_COMPACT.xlsx
];

//Class to hold info about each LingeageOS build
class LosBuild {
	public $codename;   //codename of the LOS build
	//info about device(s) supported by the build:
	public $maker, $modelName, $altModelNames, $processor, $modelReleaseDate;
	public $status;     //status codes: O=active official build, D=discontinued official build, U=unofficial build 
	public $installs;   //Total number of installs for the different versions of the build
	public $aVersions; 
	public $aCountries;
	
	public function __construct($codename=null, $maker=null, $modelName=null, $altModelNames=null, 
			$processor=null, $modelReleaseDate=null, $status=null) 
	{
		$this->codename         = $codename;    
		$this->maker            = $maker; 
		$this->modelName        = $modelName;
		$this->altModelNames    = $altModelNames;
		$this->processor        = $processor; 
		$this->modelReleaseDate = $modelReleaseDate; 
		$this->status           = $status;
	}
	
	//download info from https://stats.lineageos.org/model/$buildCode and add it to this LosBuild object
	//returns the number of installs for the build
	public function downloadInfo($buildCode = null) {
		if (empty($buildCode))
			$buildCode = $this->codename;
			
		$buildData = $GLOBALS['buildData'];
		
		$buildPage = new simple_html_dom();
		$buildPage->load_file('https://stats.lineageos.org/model/'.$buildCode);

		$this->installs = $buildPage->find('div[id=total-download]', 0)->find('div.aside-value', 0)->innertext();
		$aVersionDivs = $buildPage->find('div[id=top-devices]', 0)->find('div.leaderboard-row');
		
		foreach ($aVersionDivs as $versionDiv) {
			$version = $versionDiv->find('span.leaderboard-left a', 0)->innertext();
			$versionInstalls = $versionDiv->find('span.leaderboard-right', 0)->innertext();
			$this->aVersions[$version] = $versionInstalls;
		}
		
		$aCountryDivs = $buildPage->find('div[id=top-countries]', 0)->find('div.leaderboard-row');
		
		foreach ($aCountryDivs as $countryDiv) {
			$country = $countryDiv->find('span.leaderboard-left a', 0)->innertext();
			$countryInstalls = $countryDiv->find('span.leaderboard-right', 0)->innertext();
			$this->aCountries[$country] = $countryInstalls;
		}
		
		//if no data about the build in $buildData, then set it as an unofficial build
		if (!isset($buildData[$buildCode])) {
			$this->status = 'U';
		}
		else {
			$this->maker            = $buildData[$buildCode]->maker;
			$this->modelName        = $buildData[$buildCode]->modelName;
			$this->altModelNames    = $buildData[$buildCode]->altModelNames;
			$this->processor        = $buildData[$buildCode]->processor; 
			$this->modelReleaseDate = $buildData[$buildCode]->modelReleaseDate; 
			$this->status           = $buildData[$buildCode]->status;
		}
		
		return $this->installs;
	}
	
	//pass info in an associative array to set member variables in the LosBuild object.
	//This method is used by showOneCountry(), so doesn't need to download the build info
	public function setInfo($aBuildInfo) {
		$buildData = $GLOBALS['buildData'];
		
		foreach ($aBuildInfo as $varName => $varVal) {
			$this->{$varName} = $varVal;
		}
		
		$buildCode = $this->codename;
		
		//if no data about the build in $buildData, then set it as an unofficial build
		if (!isset($buildData[$buildCode])) {
			$this->status = 'U';
		}
		else {
			$this->maker            = $buildData[$buildCode]->maker;
			$this->modelName        = $buildData[$buildCode]->modelName;
			$this->altModelNames    = $buildData[$buildCode]->altModelNames;
			$this->processor        = $buildData[$buildCode]->processor; 
			$this->modelReleaseDate = $buildData[$buildCode]->modelReleaseDate; 
			$this->status           = $buildData[$buildCode]->status;
		}
	}
}

//array of information about the LineageOS builds.
//Includes all official builds and the top 250 unofficial builds
$GLOBALS['buildData'] = $buildData = [
	//buildCodename => new LosBuild($codename, $maker, $modelName, $altModelNames, $processor, $modelReleaseDate, $status)
	'G'         => new LosBuild('G', '10.or', 'G', '', 'Snapdragon 626', '2017-10-03', 'D'),
	'austin'    => new LosBuild('austin', 'Amazon', 'Fire 7" (Austin)', '', 'MediaTek MT8127', '2017-06-01', 'U'),
	'ford'      => new LosBuild('ford', 'Amazon', 'Fire 7" (ford)', '', 'MediaTek MT8127', '2015-11-01', 'U'),
	'karnak'    => new LosBuild('karnak', 'Amazon', 'Fire HD 8', '', 'MediaTek MT8163', '2018-10-04', 'U'),
	'douglas'   => new LosBuild('douglas', 'Amazon', 'Fire HD 8 (2017)', '', 'MediaTek MT8163', '2017-06-01', 'U'),
	'suez'      => new LosBuild('suez', 'Amazon', 'Fire HD 10 ', '', 'MediaTek MT8173 ', '2017-06-01', 'U'),
	'peach'     => new LosBuild('peach', 'ARK', 'Benefit A3', '', 'Snapdragon 410', '2015-07-01', 'D'),
	'I001D'     => new LosBuild('I001D', 'ASUS', 'ROG Phone 2 (ZS660KL)', '', 'Snapdragon 855+', '2019-09-01', 'D'),
	'obiwan'    => new LosBuild('obiwan', 'ASUS', 'ROG Phone 3', '', 'Snapdragon 865+', '2020-08-01', 'D'),
	'Z00A'      => new LosBuild('Z00A', 'ASUS', 'Zenfone 2 (1080p)', '', 'Atom Z3580', '2015-03-01', 'D'),
	'Z008'      => new LosBuild('Z008', 'ASUS', 'Zenfone 2 (720p)', '', 'Atom Z3560', '2015-03-01', 'D'),
	'Z00D'      => new LosBuild('Z00D', 'ASUS', 'Zenfone 2 (ZE500CL)', '', 'Atom Z2560', '2015-03-01', 'D'),
	'Z00T'      => new LosBuild('Z00T', 'ASUS', 'Zenfone 2 Laser (1080p)', 'Zenfone 2 Selfie (1080p)', 'Snapdragon 615', '2015-11-01', 'D'),
	'Z00L'      => new LosBuild('Z00L', 'ASUS', 'Zenfone 2 Laser (720p)', '', 'Snapdragon 410', '2015-11-01', 'D'),
	'zenfone3'  => new LosBuild('zenfone3', 'ASUS', 'Zenfone 3', '', 'Snapdragon 625', '2016-05-30', 'D'),
	'Z01R'      => new LosBuild('Z01R', 'ASUS', 'Zenfone 5Z (ZS620KL)', '', 'Snapdragon 845', '2018-06-01', 'O'),
	'I01WD'     => new LosBuild('I01WD', 'ASUS', 'Zenfone 6 (ZS630KL)', '', 'Snapdragon 855', '2019-05-16', 'D'),
	'sake'      => new LosBuild('sake', 'ASUS', 'ZenFone 8', '', 'Snapdragon 888', '2021-05-01', 'O'),
	'X00P'      => new LosBuild('X00P', 'ASUS', 'Zenfone Max M1', '', 'Snapdragon 430', '2018-12-01', 'D'),
	'X01AD'     => new LosBuild('X01AD', 'ASUS', 'Zenfone Max M2', '', 'Snapdragon 632', '2018-12-01', 'D'),
	'X00TD'     => new LosBuild('X00TD', 'ASUS', 'Zenfone Max Pro M1', '', 'Snapdragon 636', '2018-05-01', 'D'),
	'X01BD'     => new LosBuild('X01BD', 'ASUS', 'Zenfone Max Pro M2', '', 'Snapdragon 660', '2018-12-01', 'D'),
	'P024'      => new LosBuild('P024', 'ASUS', 'ZenPad 8.0 (Z380KL)', '', 'Snapdragon 410', '2015-07-01', 'D'),
	'm5'        => new LosBuild('m5', 'Banana Pi', 'M5 (Android TV)', '', 'Amlogic S905X3', '2020-12-01', 'O'),
	'm5_tab'    => new LosBuild('m5_tab', 'Banana Pi', 'M5 (Tablet)', '', 'Amlogic S905X3', '2020-12-01', 'O'),
	'vegetalte'		=> new LosBuild('vegetalte', 'BQ', 'Aquaris E5 4G', 'Aquaris E5s', 'Snapdragon 410', '2014-11-01', 'D'),
	'piccolo'		=> new LosBuild('piccolo', 'BQ', 'Aquaris M5', '', 'Snapdragon 615', '2015-08-01', 'D'),
	'chaozu'		=> new LosBuild('chaozu', 'BQ', 'Aquaris U', '', 'Snapdragon 430', '2016-09-01', 'D'),
	'tenshi'		=> new LosBuild('tenshi', 'BQ', 'Aquaris U Plus', '', 'Snapdragon 430', '2016-09-01', 'D'),
	'bardock'		=> new LosBuild('bardock', 'BQ', 'Aquaris X', '', 'Snapdragon 626', '2017-06-01', 'D'),
	'bardockpro'		=> new LosBuild('bardockpro', 'BQ', 'Aquaris X Pro', '', 'Snapdragon 626', '2017-06-01', 'D'),
	'zangya'		=> new LosBuild('zangya', 'BQ', 'Aquaris X2', '', 'Snapdragon 636', '2018-05-01', 'D'),
	'zangyapro'		=> new LosBuild('zangyapro', 'BQ', 'Aquaris X2 Pro', '', 'Snapdragon 626', '2017-06-01', 'D'),
	'paella'		=> new LosBuild('paella', 'BQ', 'Aquaris X5', '', 'Snapdragon 412', '2015-10-14', 'D'),
	'gohan'		=> new LosBuild('gohan', 'BQ', 'Aquaris X5 Plus', '', 'Snapdragon 652', '2016-07-01', 'D'),
	'c2502t_cm8900plus_800x1280_4x64g'		=> new LosBuild('c2502t_cm8900plus_800x1280_4x64g', 'C Idea', 'CM8900 Plus', '', 'Snapdragon QT615', '2025-09-24', 'U'),
	'wade'		=> new LosBuild('wade', 'Dynalink', 'TV Box 4K (2021)', '', 'Amlogic S905Y2', '2021-06-01', 'O'),
	'mata'		=> new LosBuild('mata', 'Essential', 'PH-1', '', 'Snapdragon 835', '2017-08-01', 'O'),
	'pro1'		=> new LosBuild('pro1', 'F(x)tec', 'Pro¹', '', 'Snapdragon 835', '2019-10-01', 'O'),
	'pro1x'		=> new LosBuild('pro1x', 'F(x)tec', 'Pro¹ X', '', 'Snapdragon 662', '2022-12-01', 'O'),
	'FP2'		=> new LosBuild('FP2', 'Fairphone', 'Fairphone 2', '', 'Snapdragon 801', '2015-12-01', 'D'),
	'FP3'		=> new LosBuild('FP3', 'Fairphone', 'Fairphone 3', 'Fairphone 3+', 'Snapdragon 632', '2019-09-01', 'O'),
	'FP4'		=> new LosBuild('FP4', 'Fairphone', 'Fairphone 4', '', 'Snapdragon 750G', '2021-10-01', 'O'),
	'FP5'		=> new LosBuild('FP5', 'Fairphone', 'Fairphone 5', '', 'Qualcomm QCM6490', '2023-08-01', 'O'),
	'deadpool'		=> new LosBuild('deadpool', 'Google', 'ADT-3', '', 'Amlogic S905Y2', '2020-09-22', 'O'),
	'seed'		=> new LosBuild('seed', 'Google', 'Android One 2nd Gen', '', 'Snapdragon 410', '2015-07-01', 'D'),
	'sabrina'		=> new LosBuild('sabrina', 'Google', 'Chromecast with Google TV (4K)', '', 'Amlogic S905D3G', '2020-09-01', 'O'),
	'maguro'		=> new LosBuild('maguro', 'Google', 'Galaxy Nexus GSM', '', 'OMAP 4460', '2011-10-01', 'D'),
	'toroplus'		=> new LosBuild('toroplus', 'Google', 'Galaxy Nexus LTE (Sprint)', '', 'OMAP 4460', '2012-01-01', 'D'),
	'toro'		=> new LosBuild('toro', 'Google', 'Galaxy Nexus LTE (Verizon)', '', 'OMAP 4460', '2011-12-15', 'D'),
	'manta'		=> new LosBuild('manta', 'Google', 'Nexus 10', '', 'Exynos 5250', '2012-11-13', 'D'),
	'mako'		=> new LosBuild('mako', 'Google', 'Nexus 4', '', 'Snapdragon S4 Pro', '2012-11-13', 'D'),
	'hammerhead'		=> new LosBuild('hammerhead', 'Google', 'Nexus 5', '', 'Snapdragon 800', '2013-10-31', 'D'),
	'bullhead'		=> new LosBuild('bullhead', 'Google', 'Nexus 5X', '', 'Snapdragon 808', '2015-09-29', 'D'),
	'shamu'		=> new LosBuild('shamu', 'Google', 'Nexus 6', '', 'Snapdragon 805', '2014-10-29', 'D'),
	'angler'		=> new LosBuild('angler', 'Google', 'Nexus 6P', '', 'Snapdragon 810', '2015-09-29', 'D'),
	'flo'		=> new LosBuild('flo', 'Google', 'Nexus 7 (Wi-Fi, 2013 version)', '', 'Snapdragon S4 Pro', '2013-07-26', 'D'),
	'debx'		=> new LosBuild('debx', 'Google', 'Nexus 7 2013 (LTE, Repartitioned)', '', 'Snapdragon S4 Pro', '2013-07-26', 'D'),
	'deb'		=> new LosBuild('deb', 'Google', 'Nexus 7 2013 (LTE)', '', 'Snapdragon S4 Pro', '2013-07-26', 'D'),
	'flox'		=> new LosBuild('flox', 'Google', 'Nexus 7 2013 (Wi-Fi, Repartitioned)', '', 'Snapdragon S4 Pro', '2013-07-26', 'D'),
	'flounder_lte'		=> new LosBuild('flounder_lte', 'Google', 'Nexus 9 (LTE)', '', 'Tegra K1 (T124)', '2014-11-03', 'D'),
	'flounder'		=> new LosBuild('flounder', 'Google', 'Nexus 9 (Wi-Fi)', '', 'Tegra K1 (T124)', '2014-11-03', 'D'),
	'fugu'		=> new LosBuild('fugu', 'Google', 'Nexus Player', '', 'Atom Z3560', '2014-10-01', 'D'),
	'sailfish'		=> new LosBuild('sailfish', 'Google', 'Pixel', '', 'Snapdragon 821', '2016-10-01', 'O'),
	'walleye'		=> new LosBuild('walleye', 'Google', 'Pixel 2', '', 'Snapdragon 835', '2017-10-01', 'O'),
	'taimen'		=> new LosBuild('taimen', 'Google', 'Pixel 2 XL', '', 'Snapdragon 835', '2017-10-01', 'O'),
	'blueline'		=> new LosBuild('blueline', 'Google', 'Pixel 3', '', 'Snapdragon 845', '2018-10-01', 'O'),
	'crosshatch'		=> new LosBuild('crosshatch', 'Google', 'Pixel 3 XL', '', 'Snapdragon 845', '2018-10-01', 'O'),
	'sargo'		=> new LosBuild('sargo', 'Google', 'Pixel 3a', '', 'Snapdragon 670', '2019-04-01', 'O'),
	'bonito'		=> new LosBuild('bonito', 'Google', 'Pixel 3a XL', '', 'Snapdragon 670', '2019-04-01', 'O'),
	'flame'		=> new LosBuild('flame', 'Google', 'Pixel 4', '', 'Snapdragon 855', '2019-09-01', 'O'),
	'coral'		=> new LosBuild('coral', 'Google', 'Pixel 4 XL', '', 'Snapdragon 855', '2019-09-01', 'O'),
	'sunfish'		=> new LosBuild('sunfish', 'Google', 'Pixel 4a', '', 'Snapdragon 730G', '2020-08-01', 'O'),
	'bramble'		=> new LosBuild('bramble', 'Google', 'Pixel 4a 5G', '', 'Snapdragon 765G', '2020-10-01', 'O'),
	'redfin'		=> new LosBuild('redfin', 'Google', 'Pixel 5', '', 'Snapdragon 765G 5G', '2020-10-01', 'O'),
	'barbet'		=> new LosBuild('barbet', 'Google', 'Pixel 5a', '', 'Snapdragon 765G ', '2021-08-01', 'O'),
	'oriole'		=> new LosBuild('oriole', 'Google', 'Pixel 6', '', 'Tensor GS101', '2021-10-19', 'O'),
	'raven'		=> new LosBuild('raven', 'Google', 'Pixel 6 Pro', '', 'Tensor GS101', '2021-10-19', 'O'),
	'bluejay'		=> new LosBuild('bluejay', 'Google', 'Pixel 6a', '', 'Tensor GS101', '2022-07-01', 'O'),
	'panther'		=> new LosBuild('panther', 'Google', 'Pixel 7', '', 'Tensor GS201', '2022-10-13', 'O'),
	'cheetah'		=> new LosBuild('cheetah', 'Google', 'Pixel 7 Pro', '', 'Tensor GS201', '2022-10-13', 'O'),
	'lynx'		=> new LosBuild('lynx', 'Google', 'Pixel 7a', '', 'Tensor GS201', '2023-05-10', 'O'),
	'shiba'		=> new LosBuild('shiba', 'Google', 'Pixel 8', '', 'Tensor G3', '2023-10-04', 'O'),
	'husky'		=> new LosBuild('husky', 'Google', 'Pixel 8 Pro', '', 'Tensor G3', '2023-10-04', 'O'),
	'akita'		=> new LosBuild('akita', 'Google', 'Pixel 8a', '', 'Tensor G3', '2023-10-04', 'O'),
	'tokay'		=> new LosBuild('tokay', 'Google', 'Pixel 9', '', 'Tensor G4', '2024-08-22', 'O'),
	'caiman'		=> new LosBuild('caiman', 'Google', 'Pixel 9 Pro', '', 'Tensor G4', '2024-09-09', 'O'),
	'comet'		=> new LosBuild('comet', 'Google', 'Pixel 9 Pro Fold', '', 'Tensor G4', '2024-09-04', 'O'),
	'komodo'		=> new LosBuild('komodo', 'Google', 'Pixel 9 Pro XL', '', 'Tensor G4', '2024-08-22', 'O'),
	'dragon'		=> new LosBuild('dragon', 'Google', 'Pixel C', '', 'Tegra X1 (T210)', '2015-12-08', 'D'),
	'felix'		=> new LosBuild('felix', 'Google', 'Pixel Fold', '', 'Tensor GS201', '2023-06-27', 'O'),
	'tangorpro'		=> new LosBuild('tangorpro', 'Google', 'Pixel Tablet', '', 'Tensor GS201', '2023-06-10', 'O'),
	'marlin'		=> new LosBuild('marlin', 'Google', 'Pixel XL', '', 'Snapdragon 821', '2016-10-01', 'O'),
	'odroidc4'		=> new LosBuild('odroidc4', 'HardKernel', 'ODROID-C4 (Android TV)', '', 'Amlogic S905X3', '2020-12-01', 'O'),
	'odroidc4_tab'		=> new LosBuild('odroidc4_tab', 'HardKernel', 'ODROID-C4 (Tablet)', '', 'Amlogic S905X3', '2020-12-01', 'O'),
	'pme'		=> new LosBuild('pme', 'HTC', 'HTC 10', '', 'Snapdragon 820', '2016-05-01', 'D'),
	'm7'		=> new LosBuild('m7', 'HTC', 'One (GSM)', '', 'Snapdragon 600', '2013-03-01', 'D'),
	'm8'		=> new LosBuild('m8', 'HTC', 'One (M8)', '', 'Snapdragon 801', '2014-03-01', 'D'),
	'm8d'		=> new LosBuild('m8d', 'HTC', 'One (M8) Dual SIM', '', 'Snapdragon 801', '2014-06-01', 'D'),
	'm7vzw'		=> new LosBuild('m7vzw', 'HTC', 'One (Verizon)', '', 'Snapdragon 600', '2013-03-01', 'D'),
	'hiae'		=> new LosBuild('hiae', 'HTC', 'One A9', '', 'Snapdragon 617', '2015-10-20', 'D'),
	'himaul'		=> new LosBuild('himaul', 'HTC', 'One M9 (GSM)', '', 'Snapdragon 810', '2015-03-01', 'D'),
	'himawl'		=> new LosBuild('himawl', 'HTC', 'One M9 (Verizon)', '', 'Snapdragon 810', '2015-03-01', 'D'),
	't6'		=> new LosBuild('t6', 'HTC', 'One Max (GSM)', '', 'Snapdragon 600', '2013-10-01', 'D'),
	't6vzw'		=> new LosBuild('t6vzw', 'HTC', 'One Max (Verizon)', '', 'Snapdragon 600', '2013-10-01', 'D'),
	'mt2'		=> new LosBuild('mt2', 'Huawei', 'Ascend Mate 2 4G', '', 'Snapdragon 400', '2014-01-01', 'D'),
	'cherry'		=> new LosBuild('cherry', 'Huawei', 'Honor 4', 'Honor 4X', 'Snapdragon 410', '2014-10-01', 'D'),
	'che10'		=> new LosBuild('che10', 'Huawei', 'Honor 4x (China Telecom)', '', 'Snapdragon 410', '2014-10-01', 'D'),
	'kiwi'		=> new LosBuild('kiwi', 'Huawei', 'Honor 5X', '', 'Snapdragon 616', '2015-11-01', 'D'),
	'berkeley'		=> new LosBuild('berkeley', 'Huawei', 'Honor View 10', '', 'Kirin 970', '2018-01-01', 'D'),
	'HWPAR'		=> new LosBuild('HWPAR', 'Huawei', 'Nova 3', '', 'Kirin 970 ', '2018-08-01', 'U'),
	'HWSEA-A'		=> new LosBuild('HWSEA-A', 'Huawei', 'Nova 5 Pro', '', 'Kirin 980', '2019-06-01', 'U'),
	'figo'		=> new LosBuild('figo', 'Huawei', 'P Smart', '', 'Kirin 659', '2017-12-01', 'D'),
	'p10'		=> new LosBuild('p10', 'Huawei', 'P10 ', '', 'Kirin 960', '2017-03-01', 'U'),
	'anne'		=> new LosBuild('anne', 'Huawei', 'P20 Lite', '', 'Kirin 659', '2018-03-01', 'D'),
	'charlotte'		=> new LosBuild('charlotte', 'Huawei', 'P20 Pro', '', 'Kirin 970', '2018-04-01', 'D'),
	'HWMAR'		=> new LosBuild('HWMAR', 'Huawei', 'P30 Lite', '', 'Kirin 710', '2019-04-25', 'U'),
	'HWDUB-Q'		=> new LosBuild('HWDUB-Q', 'Huawei', 'Y7 Prime 2019', '', 'Snapdragon 450 ', '2019-01-01', 'U'),
	's2'		=> new LosBuild('s2', 'LeEco', 'Le 2', '', 'Snapdragon 652', '2016-04-01', 'D'),
	'x2'		=> new LosBuild('x2', 'LeEco', 'Le Max2', '', 'Snapdragon 820', '2016-04-01', 'D'),
	'zl1'		=> new LosBuild('zl1', 'LeEco', 'Le Pro3', 'Le Pro3 Elite', 'Snapdragon 821', '2016-10-01', 'D'),
	'kuntao'		=> new LosBuild('kuntao', 'Lenovo', 'P2', '', 'Snapdragon 625', '2016-11-01', 'D'),
	'TB8703'		=> new LosBuild('TB8703', 'Lenovo', 'TAB 3 8 Plus', '', 'Snapdragon 625 ', '2017-03-01', 'U'),
	'TBX704'		=> new LosBuild('TBX704', 'Lenovo', 'Tab 4 10 Plus', '', 'Snapdragon? 625 ', '2017-07-01', 'U'),
	'A6020'		=> new LosBuild('A6020', 'Lenovo', 'Vibe K5', 'Vibe K5 Plus', 'Snapdragon 415', '2016-04-01', 'D'),
	'kingdom'		=> new LosBuild('kingdom', 'Lenovo', 'Vibe Z2 Pro', '', 'Snapdragon 801', '2014-09-01', 'D'),
	'YTX703L'		=> new LosBuild('YTX703L', 'Lenovo', 'Yoga Tab 3 Plus LTE', '', 'Snapdragon 652', '2016-12-01', 'D'),
	'YTX703F'		=> new LosBuild('YTX703F', 'Lenovo', 'Yoga Tab 3 Plus Wi-Fi', '', 'Snapdragon 652', '2016-12-01', 'D'),
	'heart'		=> new LosBuild('heart', 'Lenovo', 'Z5 Pro GT', '', 'Snapdragon 855', '2019-01-29', 'O'),
	'zippo'		=> new LosBuild('zippo', 'Lenovo', 'Z6 Pro', '', 'Snapdragon 855', '2019-09-11', 'O'),
	'v410'		=> new LosBuild('v410', 'LG', 'G Pad 7.0 (LTE)', '', 'Snapdragon 400', '2014-05-01', 'D'),
	'v400'		=> new LosBuild('v400', 'LG', 'G Pad 7.0 WiFi', '', 'Snapdragon 400', '2014-07-01', 'D'),
	'v480'		=> new LosBuild('v480', 'LG', 'G Pad 8.0 (Wi-Fi)', '', 'Snapdragon 400', '2014-07-01', 'D'),
	'v500'		=> new LosBuild('v500', 'LG', 'G Pad 8.3', '', 'Snapdragon 600', '2013-10-14', 'D'),
	'v521'		=> new LosBuild('v521', 'LG', 'G Pad X (T-Mobile)', '', 'Snapdragon 617', '2016-06-01', 'D'),
	'd800'		=> new LosBuild('d800', 'LG', 'G2 (AT&T)', '', 'Snapdragon 800', '2013-09-12', 'D'),
	'd803'		=> new LosBuild('d803', 'LG', 'G2 (Canadian)', '', 'Snapdragon 800', '2013-09-12', 'D'),
	'd802'		=> new LosBuild('d802', 'LG', 'G2 (International)', '', 'Snapdragon 800', '2013-09-12', 'D'),
	'd801'		=> new LosBuild('d801', 'LG', 'G2 (T-Mobile)', '', 'Snapdragon 800', '2013-09-12', 'D'),
	'g2m'		=> new LosBuild('g2m', 'LG', 'G2 Mini', '', 'Snapdragon 400', '2014-04-01', 'D'),
	'd850'		=> new LosBuild('d850', 'LG', 'G3 (AT&T)', '', 'Snapdragon 801', '2014-06-01', 'D'),
	'd852'		=> new LosBuild('d852', 'LG', 'G3 (Canada)', '', 'Snapdragon 801', '2014-06-01', 'D'),
	'd855'		=> new LosBuild('d855', 'LG', 'G3 (International)', '', 'Snapdragon 801', '2014-06-01', 'D'),
	'f400'		=> new LosBuild('f400', 'LG', 'G3 (Korea)', '', 'Snapdragon 801', '2014-06-01', 'D'),
	'ls990'		=> new LosBuild('ls990', 'LG', 'G3 (Sprint)', '', 'Snapdragon 801', '2014-06-01', 'D'),
	'd851'		=> new LosBuild('d851', 'LG', 'G3 (T-Mobile)', '', 'Snapdragon 801', '2014-06-01', 'D'),
	'vs985'		=> new LosBuild('vs985', 'LG', 'G3 (Verizon)', '', 'Snapdragon 801', '2014-06-01', 'D'),
	'jagnm'		=> new LosBuild('jagnm', 'LG', 'G3 Beat', '', 'Snapdragon 400', '2014-08-01', 'D'),
	'jag3gds'		=> new LosBuild('jag3gds', 'LG', 'G3 S', '', 'Snapdragon 400', '2014-08-01', 'D'),
	'h815'		=> new LosBuild('h815', 'LG', 'G4 (International)', '', 'Snapdragon 808', '2015-06-01', 'D'),
	'h811'		=> new LosBuild('h811', 'LG', 'G4 (T-Mobile)', '', 'Snapdragon 808', '2015-06-01', 'D'),
	'h850'		=> new LosBuild('h850', 'LG', 'G5 (International)', '', 'Snapdragon 820', '2016-02-01', 'D'),
	'h830'		=> new LosBuild('h830', 'LG', 'G5 (T-Mobile)', '', 'Snapdragon 820', '2016-02-01', 'D'),
	'rs988'		=> new LosBuild('rs988', 'LG', 'G5 (US Unlocked)', '', 'Snapdragon 820', '2016-02-01', 'D'),
	'h870'		=> new LosBuild('h870', 'LG', 'G6 (EU Unlocked)', '', 'Snapdragon 821', '2017-02-01', 'D'),
	'h872'		=> new LosBuild('h872', 'LG', 'G6 (T-Mobile)', '', 'Snapdragon 821', '2017-02-01', 'D'),
	'us997'		=> new LosBuild('us997', 'LG', 'G6 (US Unlocked)', '', 'Snapdragon 821', '2017-02-01', 'D'),
	'judyln'		=> new LosBuild('judyln', 'LG', 'G7 ThinQ (G710AWM/EM/EMW)', 'G7+ ThinQ', 'Snapdragon 845', '2018-05-02', 'O'),
	'g710n'		=> new LosBuild('g710n', 'LG', 'G7 ThinQ (G710N)', '', 'Snapdragon 845', '2018-05-02', 'O'),
	'g710ulm'		=> new LosBuild('g710ulm', 'LG', 'G7 ThinQ (G710ULM/VMX)', '', 'Snapdragon 845', '2018-05-02', 'O'),
	'alphaplus'		=> new LosBuild('alphaplus', 'LG', 'G8 ThinQ', 'G8 ThinQ (Korea)', 'Snapdragon 855', '2019-02-01', 'O'),
	'betalm'		=> new LosBuild('betalm', 'LG', 'G8s ThinQ', '', 'Snapdragon 855', '2019-06-01', 'O'),
	'mh2lm'		=> new LosBuild('mh2lm', 'LG', 'G8X ThinQ (G850EM/EMW)', 'G8X ThinQ (G850QM/UM), V50S ThinQ', 'Snapdragon 855', '2019-06-01', 'O'),
	'm216'		=> new LosBuild('m216', 'LG', 'K10', '', 'Snapdragon 410', '2016-01-01', 'D'),
	'w7'		=> new LosBuild('w7', 'LG', 'L90', '', 'Snapdragon 400', '2014-02-01', 'D'),
	'w5'		=> new LosBuild('w5', 'LG', 'Optimus L70', '', 'Snapdragon 200', '2014-04-01', 'D'),
	'prada'		=> new LosBuild('prada', 'LG', 'Prada 3.0', '', 'OMAP 4430', '2012-01-01', 'U'),
	'style3lm'		=> new LosBuild('style3lm', 'LG', 'Style3', '', 'Snapdragon 845', '2020-06-25', 'O'),
	'h910'		=> new LosBuild('h910', 'LG', 'V20 (AT&T)', '', 'Snapdragon 820', '2016-10-01', 'D'),
	'h990'		=> new LosBuild('h990', 'LG', 'V20 (Global)', '', 'Snapdragon 820', '2016-10-01', 'D'),
	'us996d'		=> new LosBuild('us996d', 'LG', 'V20 (GSM Unlocked - DirtySanta)', '', 'Snapdragon 820', '2016-10-01', 'D'),
	'us996'		=> new LosBuild('us996', 'LG', 'V20 (GSM Unlocked)', '', 'Snapdragon 820', '2016-10-01', 'D'),
	'ls997'		=> new LosBuild('ls997', 'LG', 'V20 (Sprint)', '', 'Snapdragon 820', '2016-10-01', 'D'),
	'h918'		=> new LosBuild('h918', 'LG', 'V20 (T-Mobile)', '', 'Snapdragon 820', '2016-10-01', 'D'),
	'vs995'		=> new LosBuild('vs995', 'LG', 'V20 (Verizon)', '', 'Snapdragon 820', '2016-10-01', 'D'),
	'l01k'		=> new LosBuild('l01k', 'LG', 'V30 (Japan)', '', 'Snapdragon 835', '2017-08-01', 'O'),
	'h932'		=> new LosBuild('h932', 'LG', 'V30 (T-Mobile)', '', 'Snapdragon 835', '2017-08-01', 'D'),
	'joan'		=> new LosBuild('joan', 'LG', 'V30 (Unlocked)', 'V30 (T-Mobile), V30 (Other)', 'Snapdragon 835', '2017-08-01', 'O'),
	'judyp'		=> new LosBuild('judyp', 'LG', 'V35 ThinQ', '', 'Snapdragon 845', '2018-05-30', 'O'),
	'judypn'		=> new LosBuild('judypn', 'LG', 'V40 ThinQ', '', 'Snapdragon 845', '2018-10-03', 'O'),
	'flashlmdd'		=> new LosBuild('flashlmdd', 'LG', 'V50 ThinQ', '', 'Snapdragon 855', '2019-02-01', 'O'),
	'caymanslm'		=> new LosBuild('caymanslm', 'LG', 'Velvet', '', 'Snapdragon 845', '2020-07-31', 'O'),
	'bathena'		=> new LosBuild('bathena', 'Motorola', 'defy 2021', '', 'Snapdragon 662', '2021-06-01', 'O'),
	'maserati'		=> new LosBuild('maserati', 'Motorola', 'DROID 4', '', 'OMAP 4430', '2012-02-10', 'D'),
	'targa'		=> new LosBuild('targa', 'Motorola', 'DROID BIONIC', '', 'OMAP 4430', '2011-09-08', 'D'),
	'spyder'		=> new LosBuild('spyder', 'Motorola', 'DROID RAZR (CDMA)', 'DROID RAZR MAXX (CDMA)', 'OMAP 4430', '2011-11-11', 'D'),
	'umts_spyder'		=> new LosBuild('umts_spyder', 'Motorola', 'DROID RAZR (GSM)', 'DROID RAZR MAXX (GSM)', 'OMAP 4430', '2011-11-11', 'D'),
	'racer'		=> new LosBuild('racer', 'Motorola', 'edge', '', 'Snapdragon 765G', '2020-05-01', 'O'),
	'berlin'		=> new LosBuild('berlin', 'Motorola', 'edge 20', '', 'Snapdragon 778G 5G', '2021-07-29', 'O'),
	'pstar'		=> new LosBuild('pstar', 'Motorola', 'edge 20 pro', '', 'Snapdragon 870', '2021-08-01', 'O'),
	'berlna'		=> new LosBuild('berlna', 'Motorola', 'edge 2021', '', 'Snapdragon 778G 5G', '2021-08-19', 'O'),
	'dubai'		=> new LosBuild('dubai', 'Motorola', 'edge 30', '', 'Snapdragon 778G+ 5G', '2022-05-01', 'O'),
	'tundra'		=> new LosBuild('tundra', 'Motorola', 'edge 30 fusion', '', 'Snapdragon 888+', '2022-09-01', 'O'),
	'miami'		=> new LosBuild('miami', 'Motorola', 'edge 30 neo', '', 'Snapdragon 695', '2022-10-07', 'O'),
	'eqs'		=> new LosBuild('eqs', 'Motorola', 'edge 30 ultra', '', 'Snapdragon 8+ Gen1', '2022-09-01', 'O'),
	'rtwo'		=> new LosBuild('rtwo', 'Motorola', 'edge 40 pro', 'moto X40 edge+ (2023)', 'Snapdragon 8 Gen2', '2023-04-01', 'O'),
	'nio'		=> new LosBuild('nio', 'Motorola', 'edge s', 'moto g100', 'Snapdragon 870', '2021-02-01', 'O'),
	'condor'		=> new LosBuild('condor', 'Motorola', 'moto e', '', 'Snapdragon 200', '2014-05-13', 'D'),
	'otus'		=> new LosBuild('otus', 'Motorola', 'moto e (2015)', '', 'Snapdragon 200', '2015-02-25', 'D'),
	'surnia'		=> new LosBuild('surnia', 'Motorola', 'moto e LTE (2015)', '', 'Snapdragon 410', '2015-02-01', 'D'),
	'rhannah'		=> new LosBuild('rhannah', 'Motorola', 'moto e5 plus (XT1924-1/2/4/5)', '', 'Snapdragon 425', '2018-05-01', 'D'),
	'ahannah'		=> new LosBuild('ahannah', 'Motorola', 'moto e5 plus (XT1924-3/9)', '', 'Snapdragon 430', '2018-05-01', 'D'),
	'hannah'		=> new LosBuild('hannah', 'Motorola', 'moto e5 plus (XT1924-6/7/8)', '', 'Snapdragon 435', '2018-05-01', 'D'),
	'guam'		=> new LosBuild('guam', 'Motorola', 'moto e7 plus', 'K12', 'Snapdragon 460', '2020-09-16', 'O'),
	'falcon'		=> new LosBuild('falcon', 'Motorola', 'moto g', '', 'Snapdragon 400', '2013-11-01', 'D'),
	'titan'		=> new LosBuild('titan', 'Motorola', 'moto g (2014)', '', 'Snapdragon 400', '2014-06-01', 'D'),
	'osprey'		=> new LosBuild('osprey', 'Motorola', 'moto g (2015)', '', 'Snapdragon 410', '2015-07-01', 'D'),
	'peregrine'		=> new LosBuild('peregrine', 'Motorola', 'moto g 4G', '', 'Snapdragon 400', '2014-06-01', 'D'),
	'kiev'		=> new LosBuild('kiev', 'Motorola', 'moto g 5G', 'moto one 5G ace', 'Snapdragon 750G', '2020-05-01', 'O'),
	'fogo'		=> new LosBuild('fogo', 'Motorola', 'moto g 5G - 2024', '', 'Snapdragon 765G', '2020-05-01', 'O'),
	'nairo'		=> new LosBuild('nairo', 'Motorola', 'moto g 5G plus', 'moto one 5G', 'Snapdragon 662', '2021-01-01', 'O'),
	'thea'		=> new LosBuild('thea', 'Motorola', 'moto g LTE (2014)', '', 'Snapdragon 400', '2015-01-01', 'D'),
	'borneo'		=> new LosBuild('borneo', 'Motorola', 'moto g power 2021', '', 'Snapdragon 662', '2021-01-01', 'O'),
	'denver'		=> new LosBuild('denver', 'Motorola', 'moto g stylus 5G', '', 'Snapdragon 480', '2021-06-14', 'O'),
	'milanf'		=> new LosBuild('milanf', 'Motorola', 'moto g stylus 5G (2022)', '', 'Snapdragon 695', '2022-04-27', 'O'),
	'capri'		=> new LosBuild('capri', 'Motorola', 'moto g10', 'moto g10 power, K13 Note', 'Snapdragon 460', '2021-02-01', 'O'),
	'xpeng'		=> new LosBuild('xpeng', 'Motorola', 'moto g200 5G', 'Edge S30', 'Snapdragon 888+', '2021-11-01', 'O'),
	'merlin'		=> new LosBuild('merlin', 'Motorola', 'moto g3 turbo', '', 'Snapdragon 615', '2015-11-01', 'D'),
	'caprip'		=> new LosBuild('caprip', 'Motorola', 'moto g30', 'K13 Pro', 'Snapdragon 662', '2021-03-01', 'O'),
	'devon'		=> new LosBuild('devon', 'Motorola', 'moto g32', '', 'Snapdragon 680 4G', '2022-08-01', 'O'),
	'fogos'		=> new LosBuild('fogos', 'Motorola', 'moto g34 5G', 'moto g45 5G', 'Snapdragon 695', '2023-12-29', 'O'),
	'athene'		=> new LosBuild('athene', 'Motorola', 'moto g4', '', 'Snapdragon 617', '2016-05-01', 'D'),
	'harpia'		=> new LosBuild('harpia', 'Motorola', 'moto g4 play', '', 'Snapdragon 410', '2016-05-01', 'D'),
	'hawao'		=> new LosBuild('hawao', 'Motorola', 'moto g42', '', 'Snapdragon 680 4G', '2022-06-01', 'O'),
	'cedric'		=> new LosBuild('cedric', 'Motorola', 'moto g5', '', 'Snapdragon 430', '2017-03-01', 'D'),
	'potter'		=> new LosBuild('potter', 'Motorola', 'Moto G5 Plus', '', 'Snapdragon 625', '2017-04-01', 'U'),
	'rhode'		=> new LosBuild('rhode', 'Motorola', 'moto g52', '', 'Snapdragon 680 4G', '2022-04-01', 'O'),
	'montana'		=> new LosBuild('montana', 'Motorola', 'moto g5s', '', 'Snapdragon 430', '2017-08-01', 'D'),
	'sanders'		=> new LosBuild('sanders', 'Motorola', 'Moto G5S Plus', '', 'Snapdragon 625', '2017-08-01', 'U'),
	'jeter'		=> new LosBuild('jeter', 'Motorola', 'moto g6 play', '', 'Snapdragon 430', '2018-05-01', 'U'),
	'evert'		=> new LosBuild('evert', 'Motorola', 'moto g6 plus', '', 'Snapdragon 630', '2018-05-01', 'O'),
	'river'		=> new LosBuild('river', 'Motorola', 'moto g7', '', 'Snapdragon 632', '2019-02-01', 'O'),
	'channel'		=> new LosBuild('channel', 'Motorola', 'moto g7 play', '', 'Snapdragon 632', '2019-03-01', 'O'),
	'lake'		=> new LosBuild('lake', 'Motorola', 'moto g7 plus', '', 'Snapdragon 636', '2019-02-01', 'O'),
	'ocean'		=> new LosBuild('ocean', 'Motorola', 'moto g7 power', '', 'Snapdragon 632', '2019-02-01', 'O'),
	'rhodep'		=> new LosBuild('rhodep', 'Motorola', 'moto g82 5G', '', 'Snapdragon 695', '2022-06-07', 'O'),
	'bangkk'		=> new LosBuild('bangkk', 'Motorola', 'moto g84 5G', '', 'Snapdragon 695', '2023-09-08', 'O'),
	'guamp'		=> new LosBuild('guamp', 'Motorola', 'moto g9 play', 'moto g9, K12 Note', 'Snapdragon 662', '2020-08-01', 'O'),
	'cebu'		=> new LosBuild('cebu', 'Motorola', 'moto g9 power', 'K12 Pro', 'Snapdragon 662', '2020-11-01', 'O'),
	'ghost'		=> new LosBuild('ghost', 'Motorola', 'moto x', '', 'Snapdragon S4 Pro', '2013-08-23', 'D'),
	'victara'		=> new LosBuild('victara', 'Motorola', 'moto x (2014)', '', 'Snapdragon 801', '2014-09-26', 'D'),
	'lux'		=> new LosBuild('lux', 'Motorola', 'moto x play', '', 'Snapdragon 615', '2015-08-01', 'D'),
	'clark'		=> new LosBuild('clark', 'Motorola', 'moto x pure edition (2015)', 'moto x style (2015)', 'Snapdragon 808', '2015-09-01', 'D'),
	'payton'		=> new LosBuild('payton', 'Motorola', 'moto x4', '', 'Snapdragon 630', '2017-10-01', 'O'),
	'griffin'		=> new LosBuild('griffin', 'Motorola', 'moto z', '', 'Snapdragon 820', '2016-09-01', 'D'),
	'addison'		=> new LosBuild('addison', 'Motorola', 'moto z play', '', 'Snapdragon 625', '2016-09-01', 'D'),
	'nash'		=> new LosBuild('nash', 'Motorola', 'moto z2 force', 'moto z (2018)', 'Snapdragon 835', '2017-07-01', 'O'),
	'albus'		=> new LosBuild('albus', 'Motorola', 'moto z2 play', '', 'Snapdragon 626', '2017-06-01', 'D'),
	'messi'		=> new LosBuild('messi', 'Motorola', 'moto z3', '', 'Snapdragon 835', '2018-08-01', 'O'),
	'beckham'		=> new LosBuild('beckham', 'Motorola', 'moto z3 play', '', 'Snapdragon 636', '2018-06-01', 'O'),
	'deen'		=> new LosBuild('deen', 'Motorola', 'One', '', 'Snapdragon 625 ', '2020-07-02', 'U'),
	'troika'		=> new LosBuild('troika', 'Motorola', 'one action', '', 'Exynos 9609', '2019-10-31', 'O'),
	'liber'		=> new LosBuild('liber', 'Motorola', 'one fusion+', 'one fusion+ (India)', 'Snapdragon 730', '2020-06-01', 'D'),
	'chef'		=> new LosBuild('chef', 'Motorola', 'one power', '', 'Snapdragon 636', '2018-10-10', 'D'),
	'kane'		=> new LosBuild('kane', 'Motorola', 'one vision', 'p50', 'Exynos 9609', '2019-05-15', 'O'),
	'parker'		=> new LosBuild('parker', 'Motorola', 'one zoom', '', 'Snapdragon 675', '2019-09-05', 'D'),
	'xt897'		=> new LosBuild('xt897', 'Motorola', 'PHOTON Q 4G LTE', '', 'Snapdragon S4 Plus', '2012-08-19', 'D'),
	'bronco'		=> new LosBuild('bronco', 'Motorola', 'ThinkPhone by motorola', '', 'Snapdragon 8+ Gen1', '2023-01-01', 'O'),
	'ether'		=> new LosBuild('ether', 'Nextbit', 'Robin', '', 'Snapdragon 808', '2016-02-01', 'D'),
	'nx'		=> new LosBuild('nx', 'Nintendo', 'Switch v1 [Android TV]', 'Switch v2 [Android TV], Switch Lite [Android TV], Switch OLED [Android TV]', 'Tegra X1 (T210)', '2017-03-03', 'O'),
	'nx_tab'		=> new LosBuild('nx_tab', 'Nintendo', 'Switch v1 [Tablet]', 'Switch v2 [Tablet], Switch Lite [Tablet], Switch OLED [Tablet]', 'Tegra X1 (T210)', '2017-03-03', 'O'),
	'PL2'		=> new LosBuild('PL2', 'Nokia', 'Nokia 6.1 (2018)', '', 'Snapdragon 630', '2018-05-06', 'O'),
	'DRG'		=> new LosBuild('DRG', 'Nokia', 'Nokia 6.1 Plus', '', 'Snapdragon 636', '2018-08-30', 'D'),
	'B2N'		=> new LosBuild('B2N', 'Nokia', 'Nokia 7 plus', '', 'Snapdragon 660', '2018-04-30', 'O'),
	'NB1'		=> new LosBuild('NB1', 'Nokia', 'Nokia 8', '', 'Snapdragon 835', '2017-08-16', 'O'),
	'Spacewar'		=> new LosBuild('Spacewar', 'Nothing', 'Phone (1)', '', 'Snapdragon 778G+ 5G', '2022-07-12', 'O'),
	'Pong'		=> new LosBuild('Pong', 'Nothing', 'Phone (2)', '', 'Snapdragon 8+ Gen1', '2023-07-11', 'O'),
	'TP1803'		=> new LosBuild('TP1803', 'Nubia', 'Mini 5G', '', 'Snapdragon 855', '2019-04-01', 'O'),
	'nx651j'		=> new LosBuild('nx651j', 'Nubia', 'Play 5G', 'Red Magic 5G Lite', 'Snapdragon 765G', '2020-04-01', 'D'),
	'nx609j'		=> new LosBuild('nx609j', 'Nubia', 'Red Magic', '', 'Snapdragon 835', '2018-04-01', 'D'),
	'nx659j'		=> new LosBuild('nx659j', 'Nubia', 'Red Magic 5G (Global)', 'Red Magic 5G (China), Red Magic 5S (Global), Red Magic 5S (China)', 'Snapdragon 865', '2020-03-01', 'O'),
	'nx619j'		=> new LosBuild('nx619j', 'Nubia', 'Red Magic Mars', '', 'Snapdragon 845', '2018-12-01', 'O'),
	'nx563j'		=> new LosBuild('nx563j', 'Nubia', 'Z17', '', 'Snapdragon 835', '2017-06-01', 'O'),
	'nx606j'		=> new LosBuild('nx606j', 'Nubia', 'Z18', '', 'Snapdragon 845', '2018-09-01', 'O'),
	'nx611j'		=> new LosBuild('nx611j', 'Nubia', 'Z18 Mini', '', 'Snapdragon 660', '2018-04-01', 'O'),
	'nx512j'		=> new LosBuild('nx512j', 'Nubia', 'Z9 Max', '', 'Snapdragon 615', '2015-06-01', 'D'),
	'porg'		=> new LosBuild('porg', 'NVIDIA', 'Jetson Nano [Android TV]', 'Jetson Nano 2GB [Android TV]', 'Tegra X1 (T210)', '2019-03-18', 'O'),
	'porg_tab'		=> new LosBuild('porg_tab', 'NVIDIA', 'Jetson Nano [Tablet]', 'Jetson Nano 2GB [Tablet]', 'Tegra X1 (T210)', '2019-03-18', 'O'),
	'quill'		=> new LosBuild('quill', 'NVIDIA', 'Jetson TX2 [Android TV]', 'Jetson TX2 NX [Android TV]', 'Tegra X2 (T186)', '2017-03-14', 'O'),
	'quill_tab'		=> new LosBuild('quill_tab', 'NVIDIA', 'Jetson TX2 [Tablet]', 'Jetson TX2 NX [Tablet]', 'Tegra X2 (T186)', '2017-03-14', 'O'),
	'roth'		=> new LosBuild('roth', 'NVIDIA', 'Shield Portable', '', 'Tegra 4 (T114)', '2013-07-31', 'D'),
	'shieldtablet'		=> new LosBuild('shieldtablet', 'NVIDIA', 'Shield Tablet', '', 'Tegra K1 (T124)', '2014-07-29', 'D'),
	'foster'		=> new LosBuild('foster', 'NVIDIA', 'Shield TV (2015 / 2015 Pro / 2017 / 2019 Pro) [Android TV]', 'Jetson TX1 [Android TV]', 'Tegra X1 (T210)', '2015-05-28', 'O'),
	'foster_tab'		=> new LosBuild('foster_tab', 'NVIDIA', 'Shield TV (2015 / 2015 Pro / 2017 / 2019 Pro) [Tablet]', 'Jetson TX1 [Tablet]', 'Tegra X1 (T210)', '2015-05-28', 'O'),
	'sif'		=> new LosBuild('sif', 'NVIDIA', 'Shield TV (2019) [Android TV]', '', 'Tegra X1+ (T210b01)', '2019-10-28', 'O'),
	'mdarcy'		=> new LosBuild('mdarcy', 'NVIDIA', 'Shield TV 2019 Pro [Android TV]', '', 'Tegra X1+ (T210b01)', '2019-10-28', 'D'),
	'mdarcy_tab'		=> new LosBuild('mdarcy_tab', 'NVIDIA', 'Shield TV 2019 Pro [Tablet]', '', 'Tegra X1+ (T210b01)', '2019-10-28', 'D'),
	'salami'		=> new LosBuild('salami', 'OnePlus', 'OnePlus 11 5G', '', 'Snapdragon 8 Gen2', '2023-01-01', 'O'),
	'waffle'		=> new LosBuild('waffle', 'OnePlus', 'OnePlus 12', '', 'Snapdragon 8 Gen3', '2023-12-01', 'O'),
	'aston'		=> new LosBuild('aston', 'OnePlus', 'OnePlus 12R', '', 'Snapdragon 8 Gen2', '2024-01-01', 'O'),
	'oneplus2'		=> new LosBuild('oneplus2', 'OnePlus', 'OnePlus 2', '', 'Snapdragon 810', '2015-08-28', 'D'),
	'oneplus3'		=> new LosBuild('oneplus3', 'OnePlus', 'OnePlus 3', 'OnePlus 3T', 'Snapdragon 820', '2016-06-01', 'D'),
	'cheeseburger'		=> new LosBuild('cheeseburger', 'OnePlus', 'OnePlus 5', '', 'Snapdragon 835', '2017-06-01', 'O'),
	'dumpling'		=> new LosBuild('dumpling', 'OnePlus', 'OnePlus 5T', '', 'Snapdragon 835', '2017-11-01', 'O'),
	'enchilada'		=> new LosBuild('enchilada', 'OnePlus', 'OnePlus 6', '', 'Snapdragon 845', '2018-04-01', 'O'),
	'fajita'		=> new LosBuild('fajita', 'OnePlus', 'OnePlus 6T', 'OnePlus 6T (T-Mobile)', 'Snapdragon 845', '2018-11-01', 'O'),
	'guacamoleb'		=> new LosBuild('guacamoleb', 'OnePlus', 'OnePlus 7', '', 'Snapdragon 855', '2019-05-01', 'O'),
	'guacamole'		=> new LosBuild('guacamole', 'OnePlus', 'OnePlus 7 Pro', 'OnePlus 7 Pro (T-Mobile)', 'Snapdragon 855', '2019-05-01', 'O'),
	'hotdogb'		=> new LosBuild('hotdogb', 'OnePlus', 'OnePlus 7T', 'OnePlus 7T (T-Mobile)', 'Snapdragon 855+', '2019-09-01', 'O'),
	'hotdog'		=> new LosBuild('hotdog', 'OnePlus', 'OnePlus 7T Pro', '', 'Snapdragon 855+', '2019-10-01', 'O'),
	'instantnoodle'		=> new LosBuild('instantnoodle', 'OnePlus', 'OnePlus 8', 'OnePlus 8 (T-Mobile)', 'Snapdragon 865', '2020-04-01', 'O'),
	'instantnoodlep'		=> new LosBuild('instantnoodlep', 'OnePlus', 'OnePlus 8 Pro', '', 'Snapdragon 865', '2020-04-01', 'O'),
	'kebab'		=> new LosBuild('kebab', 'OnePlus', 'OnePlus 8T', 'OnePlus 8T (T-Mobile)', 'Snapdragon 865', '2020-10-01', 'O'),
	'lemonade'		=> new LosBuild('lemonade', 'OnePlus', 'OnePlus 9', 'OnePlus 9 (T-Mobile)', 'Snapdragon 888', '2021-03-01', 'O'),
	'lemonadep'		=> new LosBuild('lemonadep', 'OnePlus', 'OnePlus 9 Pro', 'OnePlus 9 Pro (T-Mobile)', 'Snapdragon 888', '2021-03-01', 'O'),
	'lemonades'		=> new LosBuild('lemonades', 'OnePlus', 'OnePlus 9R', '', 'Snapdragon 888', '2021-03-01', 'O'),
	'martini'		=> new LosBuild('martini', 'OnePlus', 'OnePlus 9RT', '', 'Snapdragon 888', '2021-10-01', 'O'),
	'avicii'		=> new LosBuild('avicii', 'OnePlus', 'OnePlus Nord', '', 'Snapdragon 765G', '2020-07-21', 'D'),
	'oscaro'		=> new LosBuild('oscaro', 'OnePlus', 'OnePlus Nord CE 2 Lite 5G', '', 'Snapdragon 695', '2022-04-30', 'O'),
	'larry'		=> new LosBuild('larry', 'OnePlus', 'OnePlus Nord CE 3 Lite 5G', 'OnePlus Nord N30 5G', 'Snapdragon 695', '2023-04-11', 'O'),
	'benz'		=> new LosBuild('benz', 'OnePlus', 'OnePlus Nord CE4', '', 'Snapdragon 7 Gen 3', '2024-04-01', 'O'),
	'billie'		=> new LosBuild('billie', 'OnePlus', 'OnePlus Nord N10', '', 'Snapdragon 690 5G', '2020-10-26', 'O'),
	'gunnar'		=> new LosBuild('gunnar', 'OnePlus', 'OnePlus Nord N20', '', 'Snapdragon 695', '2022-04-28', 'O'),
	'dre'		=> new LosBuild('dre', 'OnePlus', 'OnePlus Nord N200', '', 'Snapdragon 480', '2021-06-21', 'O'),
	'bacon'		=> new LosBuild('bacon', 'OnePlus', 'OnePlus One', '', 'Snapdragon 801', '2014-06-06', 'D'),
	'erhai'		=> new LosBuild('erhai', 'OnePlus', 'OnePlus Pad 2 Pro', 'OnePlus Pad 3', 'Snapdragon 8 Elite', '2025-05-01', 'O'),
	'onyx'		=> new LosBuild('onyx', 'OnePlus', 'OnePlus X', '', 'Snapdragon 801', '2015-11-01', 'D'),
	'A37'		=> new LosBuild('A37', 'OPPO', 'A37', 'A37f, A37fw', 'Snapdragon 410', '2016-06-01', 'U'),
	'A57'		=> new LosBuild('A57', 'OPPO', 'A57 (2016)', '', 'Snapdragon 435 ', '2016-12-01', 'U'),
	'f1f'		=> new LosBuild('f1f', 'OPPO', 'F1 (International)', '', 'Snapdragon 615', '2016-01-01', 'D'),
	'find7'		=> new LosBuild('find7', 'OPPO', 'Find 7a', 'Find 7s', 'Snapdragon 801', '2014-03-19', 'D'),
	'OP4AA7'		=> new LosBuild('OP4AA7', 'OPPO', 'K5', '', 'Snapdragon 730G', '2019-10-01', 'U'),
	'n3'		=> new LosBuild('n3', 'OPPO', 'N3', '', 'Snapdragon 801', '2015-01-01', 'D'),
	'R11'		=> new LosBuild('R11', 'OPPO', 'R11', '', 'Snapdragon 660 ', '2017-06-01', 'U'),
	'PACM00'		=> new LosBuild('PACM00', 'OPPO', 'R15 10', '', 'Helio P60', '2018-04-01', 'U'),
	'PBDM00'		=> new LosBuild('PBDM00', 'OPPO', 'R17 Pro / RX17 Pro', '', 'Snapdragon 710 ', '2018-11-01', 'U'),
	'r5'		=> new LosBuild('r5', 'OPPO', 'R5 (International)', 'R5s (International)', 'Snapdragon 615', '2014-12-01', 'D'),
	'r7plus'		=> new LosBuild('r7plus', 'OPPO', 'R7 Plus (International)', '', 'Snapdragon 615', '2015-05-01', 'D'),
	'r7sf'		=> new LosBuild('r7sf', 'OPPO', 'R7s (International)', '', 'Snapdragon 615', '2015-11-01', 'D'),
	'R9'		=> new LosBuild('R9', 'OPPO', 'R9', '', 'MediaTek Helio P10 ', '2016-03-01', 'U'),
	'r36s'		=> new LosBuild('r36s', 'R36S', 'R36S with Panel 4', '', 'Rockchip RK3326', '2025-05-31', 'U'),
	'radxa0'		=> new LosBuild('radxa0', 'Radxa', 'Zero (Android TV)', '', 'Amlogic S905Y2', '2020-12-01', 'O'),
	'radxa0_tab'		=> new LosBuild('radxa0_tab', 'Radxa', 'Zero (Tablet)', '', 'Amlogic S905Y2', '2020-12-01', 'O'),
	'radxa02'		=> new LosBuild('radxa02', 'Radxa', 'Zero 2 (Android TV)', '', 'Amlogic S905D3G', '2022-12-01', 'O'),
	'radxa02_tab'		=> new LosBuild('radxa02_tab', 'Radxa', 'Zero 2 (Tablet)', '', 'Amlogic S905D3', '2022-12-01', 'O'),
	'rpi3'		=> new LosBuild('rpi3', 'Raspberry Pi', 'Raspberry Pi 3', '', 'Broadcom BCM2837', '2016-02-29', 'U'),
	'rpi4'		=> new LosBuild('rpi4', 'Raspberry Pi', 'Raspberry Pi 4', '', 'Broadcom BCM2711', '2019-06-24', 'U'),
	'rpi5'		=> new LosBuild('rpi5', 'Raspberry Pi', 'Raspberry Pi 5', '', 'Broadcom BCM2712', '2023-10-23', 'U'),
	'cheryl'		=> new LosBuild('cheryl', 'Razer', 'Phone', '', 'Snapdragon 835', '2017-11-01', 'O'),
	'aura'		=> new LosBuild('aura', 'Razer', 'Phone 2', '', 'Snapdragon 845', '2018-10-01', 'O'),
	'luigi'		=> new LosBuild('luigi', 'Realme', 'Realme 10 Pro 5G', '', 'Snapdragon 695', '2022-11-24', 'O'),
	'RMX1801'		=> new LosBuild('RMX1801', 'Realme', 'Realme 2 Pro', '', 'Snapdragon 660', '2018-10-11', 'D'),
	'RMX1851'		=> new LosBuild('RMX1851', 'Realme', 'Realme 3 Pro', '', 'Snapdragon 710', '2019-04-29', 'D'),
	'oscar'		=> new LosBuild('oscar', 'Realme', 'Realme 9 Pro 5G', 'Realme 9 5G, Q5', 'Snapdragon 695', '2022-02-23', 'O'),
	'RMX2201CN'		=> new LosBuild('RMX2201CN', 'Realme', 'V3 5G', '', 'Dimensity 720', '2020-09-10', 'U'),
	'a30'		=> new LosBuild('a30', 'Samsung', 'Galaxy A30', '', 'Exynos 7904', '2019-03-01', 'U'),
	'a10'		=> new LosBuild('a10', 'Samsung', 'Galaxy A10', '', 'Exynos 7884', '2019-03-01', 'U'),
	'a20'		=> new LosBuild('a20', 'Samsung', 'Galaxy A20', '', 'Exynos 7884', '2019-04-05', 'U'),
	'a21s'		=> new LosBuild('a21s', 'Samsung', 'Galaxy A21s', '', 'Exynos 850', '2020-06-02', 'O'),
	'a3xelte'		=> new LosBuild('a3xelte', 'Samsung', 'Galaxy A3 (2016)', '', 'Exynos 7578', '2015-12-01', 'D'),
	'a5xelte'		=> new LosBuild('a5xelte', 'Samsung', 'Galaxy A5 (2016)', '', 'Exynos 7580', '2015-12-01', 'D'),
	'a5y17lte'		=> new LosBuild('a5y17lte', 'Samsung', 'Galaxy A5 (2017)', '', 'Exynos 7880', '2017-01-02', 'D'),
	'a51'		=> new LosBuild('a51', 'Samsung', 'Galaxy A51 (SM-A515F)', '', 'Exynos 9611', '2019-12-16', 'U'),
	'a52q'		=> new LosBuild('a52q', 'Samsung', 'Galaxy A52 4G', '', 'Snapdragon 720G', '2021-03-26', 'O'),
	'a52sxq'		=> new LosBuild('a52sxq', 'Samsung', 'Galaxy A52s 5G', '', 'Snapdragon 778G 5G', '2021-09-01', 'O'),
	'a6lte'		=> new LosBuild('a6lte', 'Samsung', 'Galaxy A6 (Exynos7870)', '', 'Exynos 7870', '2018-05-01', 'U'),
	'a7xelte'		=> new LosBuild('a7xelte', 'Samsung', 'Galaxy A7 (2016)', '', 'Exynos 7580', '2015-12-01', 'D'),
	'a7y17lte'		=> new LosBuild('a7y17lte', 'Samsung', 'Galaxy A7 (2017)', '', 'Exynos 7880', '2017-01-02', 'D'),
	'a7y18lte'		=> new LosBuild('a7y18lte', 'Samsung', 'Galaxy A7 (2018)', '', 'Exynos 7 Octa 7885', '2018-10-01', 'U'),
	'a70q'		=> new LosBuild('a70q', 'Samsung', 'Galaxy A70 (SM-A705)', '', 'Snapdragon 675', '2019-05-01', 'U'),
	'a71'		=> new LosBuild('a71', 'Samsung', 'Galaxy A71', '', 'Snapdragon 730', '2020-01-17', 'O'),
	'a72q'		=> new LosBuild('a72q', 'Samsung', 'Galaxy A72', '', 'Snapdragon 720G', '2021-03-26', 'O'),
	'a73xq'		=> new LosBuild('a73xq', 'Samsung', 'Galaxy A73 5G', '', 'Snapdragon 778G 5G', '2022-04-22', 'O'),
	'core33g'		=> new LosBuild('core33g', 'Samsung', 'Galaxy Core Prime (SM-G360H)', '', 'Snapdragon 410', '2014-11-01', 'U'),
	'f62'		=> new LosBuild('f62', 'Samsung', 'Galaxy F62', 'Galaxy M62', 'Exynos 9825', '2021-02-22', 'O'),
	'ms013g'		=> new LosBuild('ms013g', 'Samsung', 'Galaxy Grand 2 Duos', '', 'Snapdragon 400', '2013-11-25', 'D'),
	'grandneove3g'		=> new LosBuild('grandneove3g', 'Samsung', 'Galaxy Grand Neo Plus', '', 'Spreadtrum SC8830 ', '2015-01-01', 'U'),
	'grandppltedx'		=> new LosBuild('grandppltedx', 'Samsung', 'Galaxy J2 Prime / Grand Prime Plus', '', 'MediaTek MT6737T ', '2016-11-01', 'U'),
	'j3xlte'		=> new LosBuild('j3xlte', 'Samsung', 'Galaxy J3 (2016) (SM-J320F/G/M)', '', 'Spreadtrum SC9830A ', '2016-05-06', 'U'),
	'j3xnlte'		=> new LosBuild('j3xnlte', 'Samsung', 'Galaxy J3 (2016) (SM-J320FN)', '', 'Spreadtrum SC9830I ', '2016-05-06', 'U'),
	'j4primelte'		=> new LosBuild('j4primelte', 'Samsung', 'Galaxy J4+', '', 'Snapdragon 425', '2018-10-01', 'U'),
	'j5lte'		=> new LosBuild('j5lte', 'Samsung', 'Galaxy J5 (2015)', '', 'Snapdragon 410 ', '2015-06-26', 'U'),
	'j5xnlte'		=> new LosBuild('j5xnlte', 'Samsung', 'Galaxy J5 (J510MN/GN/FN)', '', 'Snapdragon 410 ', '2016-04-01', 'U'),
	'j6primelte'		=> new LosBuild('j6primelte', 'Samsung', 'Galaxy J6+', '', 'Snapdragon 425', '2018-09-25', 'U'),
	'j7elte'		=> new LosBuild('j7elte', 'Samsung', 'Galaxy J7 (2015)', '', 'Exynos 7580', '2015-06-01', 'D'),
	'on7xelte'		=> new LosBuild('on7xelte', 'Samsung', 'Galaxy J7 Prime', '', 'Exynos 7870', '2016-09-01', 'U'),
	'm20lte'		=> new LosBuild('m20lte', 'Samsung', 'Galaxy M20', '', 'Exynos 7904', '2019-01-28', 'D'),
	'm52xq'		=> new LosBuild('m52xq', 'Samsung', 'Galaxy M52 5G', '', 'Snapdragon 778G 5G', '2021-10-03', 'O'),
	'n8000'		=> new LosBuild('n8000', 'Samsung', 'Galaxy Note 10.1 ', '', 'Exynos 4 Quad 4412', '2012-08-01', 'U'),
	'n8010'		=> new LosBuild('n8010', 'Samsung', 'Galaxy Note 10.1 (N8010)', '', 'Exynos 4 Quad 4412', '2012-08-01', 'U'),
	'n8020'		=> new LosBuild('n8020', 'Samsung', 'Galaxy Note 10.1 (N8020)', '', 'Exynos 4 Quad 4412', '2012-12-01', 'U'),
	'lt03lte'		=> new LosBuild('lt03lte', 'Samsung', 'Galaxy Note 10.1 2014 (LTE)', '', 'Snapdragon 800', '2013-10-01', 'D'),
	'n1awifi'		=> new LosBuild('n1awifi', 'Samsung', 'Galaxy Note 10.1 Wi-Fi (2014)', '', 'Exynos 5420', '2013-10-10', 'D'),
	'n8013'		=> new LosBuild('n8013', 'Samsung', 'Galaxy Note 10.1 WiFi', '', 'Exynos 4412', '2012-08-01', 'U'),
	't0lte'		=> new LosBuild('t0lte', 'Samsung', 'Galaxy Note 2 (LTE)', '', 'Exynos 4412', '2012-09-01', 'D'),
	'ha3g'		=> new LosBuild('ha3g', 'Samsung', 'Galaxy Note 3 (International 3G)', '', 'Exynos 5420', '2013-09-01', 'D'),
	'hlte'		=> new LosBuild('hlte', 'Samsung', 'Galaxy Note 3 LTE (N9005/P)', '', 'Snapdragon 800', '2013-09-01', 'D'),
	'hltechn'		=> new LosBuild('hltechn', 'Samsung', 'Galaxy Note 3 LTE (N9008V)', '', 'Snapdragon 800', '2013-09-01', 'D'),
	'hltekor'		=> new LosBuild('hltekor', 'Samsung', 'Galaxy Note 3 LTE (N900K/L/S)', '', 'Snapdragon 800', '2013-09-01', 'D'),
	'hltetmo'		=> new LosBuild('hltetmo', 'Samsung', 'Galaxy Note 3 LTE (N900T/V/W8)', '', 'Snapdragon 800', '2013-09-01', 'D'),
	'treltexx'		=> new LosBuild('treltexx', 'Samsung', 'Galaxy Note 4', '', 'Exynos 5433 Octa', '2014-10-01', 'U'),
	'greatlte'		=> new LosBuild('greatlte', 'Samsung', 'Galaxy Note 8', '', 'Exynos 8895', '2017-09-01', 'U'),
	'n5100'		=> new LosBuild('n5100', 'Samsung', 'Galaxy Note 8.0 (GSM)', '', 'Exynos 4412', '2013-04-01', 'D'),
	'n5120'		=> new LosBuild('n5120', 'Samsung', 'Galaxy Note 8.0 (LTE)', '', 'Exynos 4412', '2013-04-01', 'D'),
	'n5110'		=> new LosBuild('n5110', 'Samsung', 'Galaxy Note 8.0 (Wi-Fi)', '', 'Exynos 4412', '2013-04-01', 'D'),
	'crownlte'		=> new LosBuild('crownlte', 'Samsung', 'Galaxy Note 9', '', 'Exynos 9810', '2018-08-09', 'D'),
	'n7100'		=> new LosBuild('n7100', 'Samsung', 'Galaxy Note II', '', 'Exynos 4412 Quad ', '2012-10-01', 'U'),
	'viennalte'		=> new LosBuild('viennalte', 'Samsung', 'Galaxy Note Pro 12.2', '', 'Exynos 5420 Octa', '2014-02-13', 'U'),
	'v1awifi'		=> new LosBuild('v1awifi', 'Samsung', 'Galaxy Note Pro 12.2 Wi-Fi', '', 'Exynos 5420', '2014-02-01', 'D'),
	'd1'		=> new LosBuild('d1', 'Samsung', 'Galaxy Note10', '', 'Exynos 9825', '2019-08-23', 'O'),
	'd1x'		=> new LosBuild('d1x', 'Samsung', 'Galaxy Note10 5G', '', 'Exynos 9825', '2019-08-23', 'O'),
	'd2s'		=> new LosBuild('d2s', 'Samsung', 'Galaxy Note10+', '', 'Exynos 9825', '2019-08-23', 'O'),
	'd2x'		=> new LosBuild('d2x', 'Samsung', 'Galaxy Note10+ 5G', '', 'Exynos 9825', '2019-08-23', 'O'),
	'i9100'		=> new LosBuild('i9100', 'Samsung', 'Galaxy S II', '', 'Exynos 4210', '2011-02-11', 'D'),
	'd2att'		=> new LosBuild('d2att', 'Samsung', 'Galaxy S III (AT&T)', '', 'Snapdragon S4 Plus', '2012-06-28', 'D'),
	'i9300'		=> new LosBuild('i9300', 'Samsung', 'Galaxy S III (International)', '', 'Exynos 4412', '2012-05-29', 'D'),
	'i9305'		=> new LosBuild('i9305', 'Samsung', 'Galaxy S III (LTE / International)', '', 'Exynos 4412', '2012-10-01', 'D'),
	'd2spr'		=> new LosBuild('d2spr', 'Samsung', 'Galaxy S III (Sprint)', '', 'Snapdragon S4 Plus', '2012-06-28', 'D'),
	'd2tmo'		=> new LosBuild('d2tmo', 'Samsung', 'Galaxy S III (T-Mobile)', '', 'Snapdragon S4 Plus', '2012-06-21', 'D'),
	'd2vzw'		=> new LosBuild('d2vzw', 'Samsung', 'Galaxy S III (Verizon)', '', 'Snapdragon S4 Plus', '2012-06-28', 'D'),
	's3ve3gds'		=> new LosBuild('s3ve3gds', 'Samsung', 'Galaxy S III Neo (Dual SIM)', '', 'Snapdragon 400', '2014-04-11', 'D'),
	's3ve3gjv'		=> new LosBuild('s3ve3gjv', 'Samsung', 'Galaxy S III Neo (Samsung Camera)', '', 'Snapdragon 400', '2014-04-11', 'D'),
	's3ve3gxx'		=> new LosBuild('s3ve3gxx', 'Samsung', 'Galaxy S III Neo (Sony Camera)', '', 'Snapdragon 400', '2014-04-11', 'D'),
	'beyond1lte'		=> new LosBuild('beyond1lte', 'Samsung', 'Galaxy S10', '', 'Exynos 9820', '2019-03-08', 'O'),
	'beyondx'		=> new LosBuild('beyondx', 'Samsung', 'Galaxy S10 5G', '', 'Exynos 9820', '2019-03-08', 'O'),
	'beyond2lte'		=> new LosBuild('beyond2lte', 'Samsung', 'Galaxy S10+', '', 'Exynos 9825', '2019-08-23', 'O'),
	'beyond0lte'		=> new LosBuild('beyond0lte', 'Samsung', 'Galaxy S10e', '', 'Exynos 9820', '2019-03-08', 'O'),
	'r8q'		=> new LosBuild('r8q', 'Samsung', 'Galaxy S20 FE', 'Galaxy S20 FE 5G', 'Snapdragon 865', '2021-04-23', 'O'),
	'x1s'		=> new LosBuild('x1s', 'Samsung', 'Galaxy S20', 'Galaxy S20 5G', 'Exynos 990', '2020-03-06', 'U'),
	'y2s'		=> new LosBuild('y2s', 'Samsung', 'Galaxy S20+', 'Galaxy S20+ 5G', 'Exynos 990', '2020-03-06', 'U'),
	'jfltexx'		=> new LosBuild('jfltexx', 'Samsung', 'Galaxy S4 (GT-I9505, SGH-I337M, SGH-M919/V)', '', 'Snapdragon 600', '2013-04-01', 'D'),
	'jfltevzw'		=> new LosBuild('jfltevzw', 'Samsung', 'Galaxy S4 (SCH-I545)', '', 'Snapdragon 600', '2013-04-01', 'D'),
	'jfltespr'		=> new LosBuild('jfltespr', 'Samsung', 'Galaxy S4 (SCH-R970, SPH-L720)', '', 'Snapdragon 600', '2013-04-01', 'D'),
	'jflteatt'		=> new LosBuild('jflteatt', 'Samsung', 'Galaxy S4 (SGH-I337)', '', 'Snapdragon 600', '2013-04-01', 'D'),
	'jactivelte'		=> new LosBuild('jactivelte', 'Samsung', 'Galaxy S4 Active', '', 'Snapdragon 600', '2013-06-01', 'D'),
	'ks01lte'		=> new LosBuild('ks01lte', 'Samsung', 'Galaxy S4 LTE-A (GT-I9506)', '', 'Snapdragon 800', '2013-10-01', 'D'),
	'serrano3gxx'		=> new LosBuild('serrano3gxx', 'Samsung', 'Galaxy S4 Mini (International 3G)', '', 'Snapdragon 400', '2013-07-01', 'D'),
	'serranodsdd'		=> new LosBuild('serranodsdd', 'Samsung', 'Galaxy S4 Mini (International Dual SIM)', '', 'Snapdragon 400', '2013-07-01', 'D'),
	'serranoltexx'		=> new LosBuild('serranoltexx', 'Samsung', 'Galaxy S4 Mini (International LTE)', '', 'Snapdragon 400', '2013-07-01', 'D'),
	'jfvelte'		=> new LosBuild('jfvelte', 'Samsung', 'Galaxy S4 Value Edition (GT-I9515/L)', '', 'Snapdragon 600', '2014-04-01', 'D'),
	'k3gxx'		=> new LosBuild('k3gxx', 'Samsung', 'Galaxy S5 (International 3G)', '', 'Exynos 5422', '2014-03-01', 'D'),
	'klteactivexx'		=> new LosBuild('klteactivexx', 'Samsung', 'Galaxy S5 Active (G870F)', '', 'Snapdragon 801', '2014-12-01', 'D'),
	'kltechn'		=> new LosBuild('kltechn', 'Samsung', 'Galaxy S5 LTE (G9006V/8V)', '', 'Snapdragon 801', '2014-04-01', 'D'),
	'klteaio'		=> new LosBuild('klteaio', 'Samsung', 'Galaxy S5 LTE (G900AZ/S902L)', '', 'Snapdragon 801', '2014-04-11', 'D'),
	'klte'		=> new LosBuild('klte', 'Samsung', 'Galaxy S5 LTE (G900F/M/R4/R7/T/T3/V/W8)', '', 'Snapdragon 801', '2014-04-11', 'D'),
	'kltedv'		=> new LosBuild('kltedv', 'Samsung', 'Galaxy S5 LTE (G900I/P)', '', 'Snapdragon 801', '2014-04-01', 'D'),
	'kltekor'		=> new LosBuild('kltekor', 'Samsung', 'Galaxy S5 LTE (G900K/L/S)', '', 'Snapdragon 801', '2014-04-01', 'D'),
	'kltekdi'		=> new LosBuild('kltekdi', 'Samsung', 'Galaxy S5 LTE (SC-04F/SCL23)', '', 'Snapdragon 801', '2014-05-01', 'D'),
	'kltechnduo'		=> new LosBuild('kltechnduo', 'Samsung', 'Galaxy S5 LTE Duos (G9006W/8W)', '', 'Snapdragon 801', '2014-04-01', 'D'),
	'klteduos'		=> new LosBuild('klteduos', 'Samsung', 'Galaxy S5 LTE Duos (G900FD/MD)', '', 'Snapdragon 801', '2014-06-01', 'D'),
	'lentislte'		=> new LosBuild('lentislte', 'Samsung', 'Galaxy S5 LTE-A', '', 'Snapdragon 805', '2014-07-15', 'D'),
	's5neolte'		=> new LosBuild('s5neolte', 'Samsung', 'Galaxy S5 Neo', '', 'Exynos 7580', '2015-08-01', 'D'),
	'kccat6'		=> new LosBuild('kccat6', 'Samsung', 'Galaxy S5 Plus', '', 'Snapdragon 805', '2014-08-21', 'D'),
	'kltesprsports'		=> new LosBuild('kltesprsports', 'Samsung', 'Galaxy S5 Sport', '', 'Snapdragon 801', '2014-06-23', 'D'),
	'zerofltexx'		=> new LosBuild('zerofltexx', 'Samsung', 'Galaxy S6', '', 'Exynos 7420', '2015-04-01', 'D'),
	'zeroltexx'		=> new LosBuild('zeroltexx', 'Samsung', 'Galaxy S6 Edge', '', 'Exynos 7420', '2015-04-01', 'D'),
	'noblelte'		=> new LosBuild('noblelte', 'Samsung', 'Galaxy Note 5', '', 'Exynos 7420 Octa', '2015-08-21', 'U'),
	'herolte'		=> new LosBuild('herolte', 'Samsung', 'Galaxy S7', '', 'Exynos 8890', '2016-03-18', 'D'),
	'hero2lte'		=> new LosBuild('hero2lte', 'Samsung', 'Galaxy S7 Edge', '', 'Exynos 8890', '2016-03-18', 'D'),
	'starlte'		=> new LosBuild('starlte', 'Samsung', 'Galaxy S9', '', 'Exynos 9810', '2018-03-11', 'D'),
	'star2qltechn'		=> new LosBuild('star2qltechn', 'Samsung', 'Galaxy S9+', '', 'Snapdragon 845', '2018-03-16', 'U'),
	'starqltechn'		=> new LosBuild('starqltechn', 'Samsung', 'Galaxy S9', '', 'Snapdragon 845 ', '2018-03-16', 'U'),
	'star2lte'		=> new LosBuild('star2lte', 'Samsung', 'Galaxy S9+', '', 'Exynos 9810', '2018-03-11', 'D'),
	'espresso3g'		=> new LosBuild('espresso3g', 'Samsung', 'Galaxy Tab 2 7.0 (GSM)', 'Galaxy Tab 2 10.1 (GSM)', 'OMAP 4430', '2012-04-01', 'D'),
	'espressowifi'		=> new LosBuild('espressowifi', 'Samsung', 'Galaxy Tab 2 7.0 (Wi-Fi / Wi-Fi + IR)', 'Galaxy Tab 2 10.1 (Wi-Fi / Wi-Fi + IR)', 'OMAP 4430', '2012-05-01', 'D'),
	'lt02ltespr'		=> new LosBuild('lt02ltespr', 'Samsung', 'Galaxy Tab 3 7.0 LTE', '', 'Snapdragon 400', '2016-09-01', 'D'),
	'lt01wifi'		=> new LosBuild('lt01wifi', 'Samsung', 'Galaxy Tab 3 8.0 (SM-T310) Wi-Fi', '', 'Exynos 4 Dual 4212', '2013-07-01', 'U'),
	'matisse3g'		=> new LosBuild('matisse3g', 'Samsung', 'Galaxy Tab 4 10.1 3G', '', 'Snapdragon 400', '2014-06-01', 'U'),
	'matisselte'		=> new LosBuild('matisselte', 'Samsung', 'Galaxy Tab 4 10.1 LTE', '', 'Snapdragon 400 ', '2014-05-01', 'U'),
	'matissewifi'		=> new LosBuild('matissewifi', 'Samsung', 'Galaxy Tab 4 10.1 Wi-Fi ', '', 'Snapdragon 400 ', '2014-06-01', 'U'),
	'gtaxllte'		=> new LosBuild('gtaxllte', 'Samsung', 'Galaxy Tab A (SM-T580)', '', 'Exynos 7870 Octa', '2016-05-01', 'U'),
	'gtaxlwifi'		=> new LosBuild('gtaxlwifi', 'Samsung', 'Galaxy Tab A 10.1" (2016)', '', 'Exynos 7870 Octa', '2016-05-01', 'U'),
	'gtexswifi'		=> new LosBuild('gtexswifi', 'Samsung', 'Galaxy Tab A 7.0', '', 'Spreadtrum SC8830', '2016-03-01', 'U'),
	'gtexslte'		=> new LosBuild('gtexslte', 'Samsung', 'Galaxy Tab A 7.0 LTE (2016)', '', 'Snapdragon 410', '2016-03-01', 'U'),
	'gtowifi'		=> new LosBuild('gtowifi', 'Samsung', 'Galaxy Tab A 8.0 (2019)', '', 'Snapdragon 429', '2019-07-01', 'O'),
	'gta4l'		=> new LosBuild('gta4l', 'Samsung', 'Galaxy Tab A7 10.4 2020 (LTE)', '', 'Snapdragon 662', '2020-09-01', 'O'),
	'gta4lwifi'		=> new LosBuild('gta4lwifi', 'Samsung', 'Galaxy Tab A7 10.4 2020 (Wi-Fi)', '', 'Snapdragon 662', '2020-09-01', 'O'),
	'gtel3g'		=> new LosBuild('gtel3g', 'Samsung', 'Galaxy Tab E ', '', 'Spreadtrum SC7730S ', '2015-07-01', 'U'),
	'gtesqltespr'		=> new LosBuild('gtesqltespr', 'Samsung', 'Galaxy Tab E 8.0 LTE (Sprint)', '', 'Snapdragon 410', '2016-01-01', 'D'),
	'gtelwifiue'		=> new LosBuild('gtelwifiue', 'Samsung', 'Galaxy Tab E 9.6 (WiFi)', '', 'Snapdragon 410', '2015-07-01', 'D'),
	'santos10wifi'		=> new LosBuild('santos10wifi', 'Samsung', 'Galaxy Tab III 10.1', '', 'Atom Z2560', '2013-07-07', 'U'),
	'santos103g'		=> new LosBuild('santos103g', 'Samsung', 'Galaxy Tab III 10.1', '', 'Atom Z2560', '2013-07-07', 'U'),
	'n2awifi'		=> new LosBuild('n2awifi', 'Samsung', 'Galaxy Tab PRO 10.1', '', 'Exynos 5420', '2014-02-01', 'D'),
	'mondrianwifi'		=> new LosBuild('mondrianwifi', 'Samsung', 'Galaxy Tab Pro 8.4', '', 'Snapdragon 800', '2014-01-01', 'D'),
	'chagalllte'		=> new LosBuild('chagalllte', 'Samsung', 'Galaxy Tab S 10.5 LTE', '', 'Exynos 5420', '2014-07-01', 'D'),
	'klimtlte'		=> new LosBuild('klimtlte', 'Samsung', 'Galaxy Tab S 10.5 LTE (SM-T705)', '', 'Exynos 5 Octa 5420 ', '2014-07-01', 'U'),
	'chagallwifi'		=> new LosBuild('chagallwifi', 'Samsung', 'Galaxy Tab S 10.5 Wi-Fi (SM-T820)', '', 'Exynos 5420', '2014-07-01', 'D'),
	'klimtwifi'		=> new LosBuild('klimtwifi', 'Samsung', 'Galaxy Tab S 8.4 Wi-Fi', '', 'Exynos 5420', '2014-07-01', 'D'),
	'gts28vewifi'		=> new LosBuild('gts28vewifi', 'Samsung', 'Galaxy Tab S2 8.0 Wi-Fi (2016)', '', 'Snapdragon 652', '2015-09-01', 'D'),
	'gts210ltexx'		=> new LosBuild('gts210ltexx', 'Samsung', 'Galaxy Tab S2 9.7 (LTE)', '', 'Exynos 5433', '2015-09-01', 'D'),
	'gts210wifi'		=> new LosBuild('gts210wifi', 'Samsung', 'Galaxy Tab S2 9.7 (Wi-Fi)', '', 'Exynos 5433', '2015-09-01', 'D'),
	'gts210vewifi'		=> new LosBuild('gts210vewifi', 'Samsung', 'Galaxy Tab S2 9.7 Wi-Fi (2016)', '', 'Snapdragon 652', '2016-08-01', 'D'),
	'gts3lwifi'		=> new LosBuild('gts3lwifi', 'Samsung', 'Galaxy Tab S3 WiFi', '', 'Snapdragon 820', '2017-03-24', 'U'),
	'gts4lv'		=> new LosBuild('gts4lv', 'Samsung', 'Galaxy Tab S5e (LTE)', '', 'Snapdragon 670', '2019-04-01', 'O'),
	'gts4lvwifi'		=> new LosBuild('gts4lvwifi', 'Samsung', 'Galaxy Tab S5e (Wi-Fi)', '', 'Snapdragon 670', '2019-04-01', 'O'),
	'gta4xl'		=> new LosBuild('gta4xl', 'Samsung', 'Galaxy Tab S6 Lite (LTE)', '', 'Exynos 9611', '2020-04-02', 'O'),
	'gta4xlwifi'		=> new LosBuild('gta4xlwifi', 'Samsung', 'Galaxy Tab S6 Lite (Wi-Fi)', '', 'Exynos 9611', '2020-04-02', 'O'),
	'gts7l'		=> new LosBuild('gts7l', 'Samsung', 'Galaxy Tab S7 (LTE)', '', 'Snapdragon 865+', '2020-08-21', 'O'),
	'gts7lwifi'		=> new LosBuild('gts7lwifi', 'Samsung', 'Galaxy Tab S7 (Wi-Fi)', '', 'Snapdragon 865+', '2020-08-21', 'O'),
	'j8y18lte'		=> new LosBuild('j8y18lte', 'Samsung', 'J8 (2018)', '', 'Snapdragon 450 ', '2018-07-01', 'U'),
	'gt58wifi'		=> new LosBuild('gt58wifi', 'Samsung', 'Tab A 2015 8.0 (SM-T350)', '', 'Snapdragon 410 ', '2015-05-01', 'U'),
	'gt510wifi'		=> new LosBuild('gt510wifi', 'Samsung', 'Tab A 2015 9.7 SM-T550 ', '', 'Snapdragon 410 ', '2015-05-01', 'U'),
	'axolotl'		=> new LosBuild('axolotl', 'SHIFT', 'SHIFT6mq', '', 'Snapdragon 845', '2020-06-01', 'O'),
	'ingot'		=> new LosBuild('ingot', 'Solana', 'Saga', '', 'Snapdragon 8+ Gen1', '2023-05-01', 'O'),
	'pdx203'		=> new LosBuild('pdx203', 'Sony', 'Xperia 1 II', '', 'Snapdragon 865', '2020-05-01', 'O'),
	'pdx215'		=> new LosBuild('pdx215', 'Sony', 'Xperia 1 III', '', 'Snapdragon 888', '2021-04-01', 'O'),
	'pdx234'		=> new LosBuild('pdx234', 'Sony', 'Xperia 1 V', '', 'Snapdragon 8 Gen2', '2023-05-01', 'O'),
	'kirin'		=> new LosBuild('kirin', 'Sony', 'Xperia 10', '', 'Snapdragon 630', '2019-02-01', 'O'),
	'pdx225'		=> new LosBuild('pdx225', 'Sony', 'Xperia 10 IV', '', 'Snapdragon 695', '2022-06-30', 'O'),
	'mermaid'		=> new LosBuild('mermaid', 'Sony', 'Xperia 10 Plus', '', 'Snapdragon 636', '2019-02-01', 'O'),
	'pdx235'		=> new LosBuild('pdx235', 'Sony', 'Xperia 10 V', '', 'Snapdragon 695', '2023-06-21', 'O'),
	'pdx206'		=> new LosBuild('pdx206', 'Sony', 'Xperia 5 II', '', 'Snapdragon 865', '2020-09-01', 'O'),
	'pdx214'		=> new LosBuild('pdx214', 'Sony', 'Xperia 5 III', '', 'Snapdragon 888', '2021-04-01', 'O'),
	'pdx237'		=> new LosBuild('pdx237', 'Sony', 'Xperia 5 V', '', 'Snapdragon 8 Gen2', '2023-09-01', 'O'),
	'taoshan'		=> new LosBuild('taoshan', 'Sony', 'Xperia L', '', 'Snapdragon 400', '2013-05-01', 'D'),
	'nicki'		=> new LosBuild('nicki', 'Sony', 'Xperia M', '', 'Snapdragon S4 Plus', '2013-06-01', 'D'),
	'huashan'		=> new LosBuild('huashan', 'Sony', 'Xperia SP', '', 'Snapdragon S4 Pro', '2013-04-01', 'D'),
	'mint'		=> new LosBuild('mint', 'Sony', 'Xperia T', '', 'Snapdragon S4', '2012-09-01', 'D'),
	'pollux'		=> new LosBuild('pollux', 'Sony', 'Xperia Tablet Z LTE', '', 'Snapdragon S4 Pro', '2013-02-01', 'D'),
	'pollux_windy'		=> new LosBuild('pollux_windy', 'Sony', 'Xperia Tablet Z Wi-Fi', '', 'Snapdragon S4 Pro', '2013-02-01', 'D'),
	'castor'		=> new LosBuild('castor', 'Sony', 'Xperia Tablet Z2 LTE', '', 'Snapdragon 801', '2014-03-26', 'D'),
	'castor_windy'		=> new LosBuild('castor_windy', 'Sony', 'Xperia Tablet Z2 Wi-Fi', '', 'Snapdragon 801', '2014-03-26', 'D'),
	'hayabusa'		=> new LosBuild('hayabusa', 'Sony', 'Xperia TX', '', 'Snapdragon S4', '2012-08-01', 'D'),
	'tsubasa'		=> new LosBuild('tsubasa', 'Sony', 'Xperia V', '', 'Snapdragon S4', '2012-09-01', 'D'),
	'suzu'		=> new LosBuild('suzu', 'Sony', 'Xperia X', '', 'Snapdragon 650', '2016-05-01', 'D'),
	'kugo'		=> new LosBuild('kugo', 'Sony', 'Xperia X Compact', '', 'Snapdragon 650', '2016-09-08', 'D'),
	'pioneer'		=> new LosBuild('pioneer', 'Sony', 'Xperia XA2', '', 'Snapdragon 630', '2018-02-01', 'O'),
	'voyager'		=> new LosBuild('voyager', 'Sony', 'Xperia XA2 Plus', '', 'Snapdragon 630', '2018-07-01', 'O'),
	'discovery'		=> new LosBuild('discovery', 'Sony', 'Xperia XA2 Ultra', '', 'Snapdragon 630', '2018-02-01', 'O'),
	'lilac'		=> new LosBuild('lilac', 'Sony', 'Xperia XZ1 Compact', '', 'Snapdragon 835 ', '2017-10-01', 'U'),
	'akari'		=> new LosBuild('akari', 'Sony', 'Xperia XZ2', '', 'Snapdragon 845', '2018-04-01', 'O'),
	'xz2c'		=> new LosBuild('xz2c', 'Sony', 'Xperia XZ2 Compact', '', 'Snapdragon 845', '2018-04-01', 'O'),
	'aurora'		=> new LosBuild('aurora', 'Sony', 'Xperia XZ2 Premium', '', 'Snapdragon 845', '2018-04-01', 'O'),
	'akatsuki'		=> new LosBuild('akatsuki', 'Sony', 'Xperia XZ3', '', 'Snapdragon 845', '2018-10-01', 'O'),
	'yuga'		=> new LosBuild('yuga', 'Sony', 'Xperia Z', '', 'Snapdragon S4 Pro', '2013-02-01', 'D'),
	'sirius'		=> new LosBuild('sirius', 'Sony', 'Xperia Z2', '', 'Snapdragon 801', '2014-04-01', 'D'),
	'z3'		=> new LosBuild('z3', 'Sony', 'Xperia Z3', '', 'Snapdragon 801', '2014-09-04', 'D'),
	'z3c'		=> new LosBuild('z3c', 'Sony', 'Xperia Z3 Compact', '', 'Snapdragon 801', '2014-09-04', 'D'),
	'ivy'		=> new LosBuild('ivy', 'Sony', 'Xperia Z3+', '', 'Snapdragon 810', '2015-06-01', 'D'),
	'karin'		=> new LosBuild('karin', 'Sony', 'Xperia Z4 Tablet LTE', '', 'Snapdragon 810', '2015-10-01', 'D'),
	'karin_windy'		=> new LosBuild('karin_windy', 'Sony', 'Xperia Z4 Tablet WiFi', '', 'Snapdragon 810', '2015-10-01', 'D'),
	'sumire'		=> new LosBuild('sumire', 'Sony', 'Xperia Z5', '', 'Snapdragon 810', '2015-09-01', 'D'),
	'suzuran'		=> new LosBuild('suzuran', 'Sony', 'Xperia Z5 Compact', '', 'Snapdragon 810', '2015-10-01', 'D'),
	'odin'		=> new LosBuild('odin', 'Sony', 'Xperia ZL', '', 'Snapdragon S4 Pro', '2013-03-01', 'D'),
	'dogo'		=> new LosBuild('dogo', 'Sony', 'Xperia ZR', '', 'Snapdragon S4 Pro', '2013-06-01', 'D'),
	'casuarina'		=> new LosBuild('casuarina', 'Vsmart', 'Joy 3', 'Joy 3+', 'Snapdragon 632', '2020-02-14', 'O'),
	'dopinder'		=> new LosBuild('dopinder', 'Walmart', 'onn. TV Box 4K (2021)', '', 'Amlogic S905Y2', '2021-06-01', 'O'),
	'kipper'		=> new LosBuild('kipper', 'Wileyfox', 'Storm', '', 'Snapdragon 615', '2015-11-01', 'D'),
	'crackling'		=> new LosBuild('crackling', 'Wileyfox', 'Swift', '', 'Snapdragon 410', '2015-10-01', 'D'),
	'wt88047'		=> new LosBuild('wt88047', 'Wingtech', 'Redmi 2', '', 'Snapdragon 410', '2015-01-01', 'D'),
	'shark'		=> new LosBuild('shark', 'Xiaomi', 'Black Shark', '', 'Snapdragon 845', '2018-04-01', 'O'),
	'umi'		=> new LosBuild('umi', 'Xiaomi', 'Mi 10', '', 'Snapdragon 865', '2020-02-01', 'O'),
	'monet'		=> new LosBuild('monet', 'Xiaomi', 'Mi 10 Lite 5G', '', 'Snapdragon 765G', '2020-05-01', 'D'),
	'cmi'		=> new LosBuild('cmi', 'Xiaomi', 'Mi 10 Pro', '', 'Snapdragon 865', '2020-02-01', 'O'),
	'thyme'		=> new LosBuild('thyme', 'Xiaomi', 'Mi 10S', '', 'Snapdragon 870', '2021-03-01', 'O'),
	'apollon'		=> new LosBuild('apollon', 'Xiaomi', 'Mi 10T', 'Mi 10T Pro, Redmi K30S Ultra', 'Snapdragon 865', '2020-10-01', 'O'),
	'gauguin'		=> new LosBuild('gauguin', 'Xiaomi', 'Mi 10T Lite 5G', 'Mi 10i 5G, Redmi Note 9 Pro 5G', 'Snapdragon 750G 5G', '2020-10-01', 'O'),
	'renoir'		=> new LosBuild('renoir', 'Xiaomi', 'Mi 11 Lite 5G', '', 'Snapdragon 780G 5G', '2021-03-01', 'O'),
	'mars'		=> new LosBuild('mars', 'Xiaomi', 'Mi 11 Pro', '', 'Snapdragon 888', '2021-03-01', 'D'),
	'haydn'		=> new LosBuild('haydn', 'Xiaomi', 'Mi 11i', 'Redmi K40 Pro, Redmi K40 Pro+, Mi 11X Pro', 'Snapdragon 888', '2021-01-01', 'O'),
	'cancro'		=> new LosBuild('cancro', 'Xiaomi', 'Mi 3', 'Mi 4', 'Snapdragon 800', '2013-10-01', 'D'),
	'libra'		=> new LosBuild('libra', 'Xiaomi', 'Mi 4c', '', 'Snapdragon 808', '2015-09-01', 'D'),
	'gemini'		=> new LosBuild('gemini', 'Xiaomi', 'Mi 5', '', 'Snapdragon 820', '2016-04-01', 'O'),
	'capricorn'		=> new LosBuild('capricorn', 'Xiaomi', 'Mi 5s', '', 'Snapdragon 821', '2016-10-01', 'D'),
	'natrium'		=> new LosBuild('natrium', 'Xiaomi', 'Mi 5s Plus', '', 'Snapdragon 821', '2016-10-01', 'O'),
	'tiffany'		=> new LosBuild('tiffany', 'Xiaomi', 'Mi 5X', '', 'Snapdragon 625', '2017-09-01', 'U'),
	'sagit'		=> new LosBuild('sagit', 'Xiaomi', 'Mi 6', '', 'Snapdragon 835', '2017-04-01', 'O'),
	'wayne'		=> new LosBuild('wayne', 'Xiaomi', 'Mi 6X', '', 'Snapdragon 660', '2018-04-01', 'D'),
	'dipper'		=> new LosBuild('dipper', 'Xiaomi', 'Mi 8', '', 'Snapdragon 845', '2018-07-01', 'O'),
	'ursa'		=> new LosBuild('ursa', 'Xiaomi', 'Mi 8 Explorer Edition', '', 'Snapdragon 845', '2018-07-01', 'O'),
	'platina'		=> new LosBuild('platina', 'Xiaomi', 'Mi 8 Lite', '', 'Snapdragon 660', '2018-09-01', 'D'),
	'equuleus'		=> new LosBuild('equuleus', 'Xiaomi', 'Mi 8 Pro', '', 'Snapdragon 845', '2018-09-01', 'O'),
	'xmsirius'		=> new LosBuild('xmsirius', 'Xiaomi', 'Mi 8 SE', '', 'Snapdragon 710', '2018-06-01', 'D'),
	'grus'		=> new LosBuild('grus', 'Xiaomi', 'Mi 9 SE', '', 'Snapdragon 712', '2019-02-01', 'O'),
	'davinci'		=> new LosBuild('davinci', 'Xiaomi', 'Mi 9T', 'Redmi K20 (China), Redmi K20 (India)', 'Snapdragon 730', '2019-06-01', 'O'),
	'tissot'		=> new LosBuild('tissot', 'Xiaomi', 'Mi A1', '', 'Snapdragon 625', '2017-10-01', 'D'),
	'jasmine_sprout'		=> new LosBuild('jasmine_sprout', 'Xiaomi', 'Mi A2', '', 'Snapdragon 660', '2018-07-01', 'D'),
	'daisy'		=> new LosBuild('daisy', 'Xiaomi', 'Mi A2 Lite', '', 'Snapdragon 625 ', '2018-07-01', 'U'),
	'laurel_sprout'		=> new LosBuild('laurel_sprout', 'Xiaomi', 'Mi A3', '', 'Snapdragon 665', '2019-07-01', 'O'),
	'pyxis'		=> new LosBuild('pyxis', 'Xiaomi', 'Mi CC 9', 'Mi 9 Lite', 'Snapdragon 665', '2019-07-01', 'O'),
	'vela'		=> new LosBuild('vela', 'Xiaomi', 'Mi CC9 Meitu Edition', '', 'Snapdragon 710', '2019-09-01', 'O'),
	'hydrogen'		=> new LosBuild('hydrogen', 'Xiaomi', 'Mi Max', '', 'Snapdragon 650', '2016-05-01', 'D'),
	'helium'		=> new LosBuild('helium', 'Xiaomi', 'Mi Max', '', 'Snapdragon 652', '2016-05-01', 'U'),
	'lithium'		=> new LosBuild('lithium', 'Xiaomi', 'Mi MIX', '', 'Snapdragon 821', '2016-10-01', 'D'),
	'chiron'		=> new LosBuild('chiron', 'Xiaomi', 'Mi MIX 2', '', 'Snapdragon 835', '2017-09-01', 'O'),
	'polaris'		=> new LosBuild('polaris', 'Xiaomi', 'Mi MIX 2S', '', 'Snapdragon 845', '2018-04-01', 'O'),
	'perseus'		=> new LosBuild('perseus', 'Xiaomi', 'Mi MIX 3', '', 'Snapdragon 845', '2018-11-01', 'O'),
	'tucana'		=> new LosBuild('tucana', 'Xiaomi', 'Mi Note 10', 'Mi Note 10 Pro, Mi CC9 Pro', 'Snapdragon 730G', '2019-11-11', 'O'),
	'scorpio'		=> new LosBuild('scorpio', 'Xiaomi', 'Mi Note 2', '', 'Snapdragon 821', '2016-11-01', 'D'),
	'jason'		=> new LosBuild('jason', 'Xiaomi', 'Mi Note 3', '', 'Snapdragon 660', '2017-09-01', 'D'),
	'mocha'		=> new LosBuild('mocha', 'Xiaomi', 'Mi Pad 1', '', 'Tegra K1 (T124)', '2014-06-01', 'U'),
	'zizhan'		=> new LosBuild('zizhan', 'Xiaomi', 'MIX Fold 2', '', 'Snapdragon 8+ Gen1', '2022-08-11', 'O'),
	'beryllium'		=> new LosBuild('beryllium', 'Xiaomi', 'POCO F1', '', 'Snapdragon 845', '2018-08-01', 'O'),
	'lmi'		=> new LosBuild('lmi', 'Xiaomi', 'POCO F2 Pro', 'Redmi K30 Pro, Redmi K30 Pro Zoom Edition', 'Snapdragon 865', '2020-05-01', 'O'),
	'alioth'		=> new LosBuild('alioth', 'Xiaomi', 'POCO F3', 'Redmi K40, Mi 11X', 'Snapdragon 870', '2021-03-01', 'O'),
	'munch'		=> new LosBuild('munch', 'Xiaomi', 'POCO F4', 'Redmi K40S', 'Snapdragon 870', '2022-06-01', 'O'),
	'marble'		=> new LosBuild('marble', 'Xiaomi', 'POCO F5 (Global)', 'POCO F5 (India), Redmi Note 12 Turbo', 'Snapdragon 7+ Gen 2', '2023-05-09', 'O'),
	'mondrian'		=> new LosBuild('mondrian', 'Xiaomi', 'POCO F5 Pro', 'Redmi K60', 'Snapdragon 8+ Gen1', '2023-05-09', 'O'),
	'miatoll'		=> new LosBuild('miatoll', 'Xiaomi', 'POCO M2 Pro', 'Redmi Note 9S, Redmi Note 9 Pro (Global), Redmi Note 9 Pro (India), Redmi Note 9 Pro Max, Redmi Note 10 Lite', 'Snapdragon 720G', '2020-07-14', 'O'),
	'surya'		=> new LosBuild('surya', 'Xiaomi', 'POCO X3 NFC', '', 'Snapdragon 732G', '2020-09-08', 'O'),
	'vayu'		=> new LosBuild('vayu', 'Xiaomi', 'POCO X3 Pro', '', 'Snapdragon 860', '2021-03-01', 'O'),
	'earth'		=> new LosBuild('earth', 'Xiaomi', 'Redmi 12C', 'Redmi 12C NFC, POCO C55', 'Helio G85', '2023-01-01', 'O'),
	'armani'		=> new LosBuild('armani', 'Xiaomi', 'Redmi 1S', '', 'Snapdragon 400', '2014-05-01', 'D'),
	'ido'		=> new LosBuild('ido', 'Xiaomi', 'Redmi 3', 'Redmi 3 Prime', 'Snapdragon 616', '2016-01-01', 'D'),
	'Mi8937'		=> new LosBuild('Mi8937', 'Xiaomi', 'Redmi 3S', 'Redmi 3X, Redmi 4 (India), Redmi 4X, Redmi Note 5A Prime, Redmi Y1 Prime', 'Snapdragon 430', '2016-06-14', 'O'),
	'land'		=> new LosBuild('land', 'Xiaomi', 'Redmi 3S', 'Redmi 3X', 'Snapdragon 430', '2016-06-01', 'D'),
	'santoni'		=> new LosBuild('santoni', 'Xiaomi', 'Redmi 4(X)', '', 'Snapdragon 435', '2017-05-01', 'D'),
	'Mi8917'		=> new LosBuild('Mi8917', 'Xiaomi', 'Redmi 4A', 'Redmi 5A, Redmi Note 5A Lite, Redmi Y1 Lite', 'Snapdragon 425', '2016-11-04', 'O'),
	'Mi8937_4_19'		=> new LosBuild('Mi8937_4_19', 'Xiaomi', 'Redmi 4X', '', 'Snapdragon 435', '2017-02-28', 'U'),
	'vince'		=> new LosBuild('vince', 'Xiaomi', 'Redmi 5 Plus', '', 'Snapdragon 625', '2017-12-07', 'U'),
	'certus'		=> new LosBuild('certus', 'Xiaomi', 'Redmi 6 / 6A', '', 'Helio A22 ', '2018-06-01', 'U'),
	'cactus'		=> new LosBuild('cactus', 'Xiaomi', 'Redmi 6A', '', 'Helio A22 ', '2018-06-15', 'U'),
	'onclite'		=> new LosBuild('onclite', 'Xiaomi', 'Redmi 7', 'Redmi Y3', 'Snapdragon 632', '2019-03-01', 'O'),
	'Mi439'		=> new LosBuild('Mi439', 'Xiaomi', 'Redmi 7A', 'Redmi 8, Redmi 8A, Redmi 8A Dual', 'Snapdragon 439', '2019-05-28', 'O'),
	'lancelot'		=> new LosBuild('lancelot', 'Xiaomi', 'Redmi 9', '', 'Helio G85', '2020-06-01', 'D'),
	'garden'		=> new LosBuild('garden', 'Xiaomi', 'Redmi 9A', 'Redmi 9C', 'Helio G25', '2020-07-07', 'U'),
	'blossom'		=> new LosBuild('blossom', 'Xiaomi', 'Redmi 9A', 'Redmi 9C, Redmi 10A', 'Helio G25 / G35', '2020-07-07', 'U'),
	'socrates'		=> new LosBuild('socrates', 'Xiaomi', 'Redmi K60 Pro', '', 'Snapdragon 8 Gen2', '2022-12-27', 'O'),
	'sweet'		=> new LosBuild('sweet', 'Xiaomi', 'Redmi Note 10 Pro', 'Redmi Note 10 Pro (India), Redmi Note 10 Pro Max (India)', 'Snapdragon 732G', '2021-03-01', 'O'),
	'rosemary'		=> new LosBuild('rosemary', 'Xiaomi', 'Redmi Note 10S', 'Redmi Note 10S NFC, Redmi Note 10S Latin America, POCO M5s', 'Helio G95', '2021-04-01', 'O'),
	'hermes'		=> new LosBuild('hermes', 'Xiaomi', 'Redmi Note 2', '', 'Helio X10 ', '2015-08-14', 'U'),
	'kenzo'		=> new LosBuild('kenzo', 'Xiaomi', 'Redmi Note 3', '', 'Snapdragon 650', '2016-02-01', 'D'),
	'mido'		=> new LosBuild('mido', 'Xiaomi', 'Redmi Note 4', '', 'Snapdragon 625', '2017-01-01', 'D'),
	'whyred'		=> new LosBuild('whyred', 'Xiaomi', 'Redmi Note 5 Pro', '', 'Snapdragon 636', '2018-02-01', 'D'),
	'ugg'		=> new LosBuild('ugg', 'Xiaomi', 'Redmi Note 5A Prime', 'Redmi Y1', 'Snapdragon 435', '2017-11-01', 'U'),
	'twolip'		=> new LosBuild('twolip', 'Xiaomi', 'Redmi Note 6 Pro', '', 'Snapdragon 636', '2018-10-01', 'D'),
	'lavender'		=> new LosBuild('lavender', 'Xiaomi', 'Redmi Note 7', '', 'Snapdragon 660', '2019-01-01', 'D'),
	'violet'		=> new LosBuild('violet', 'Xiaomi', 'Redmi Note 7 Pro', '', 'Snapdragon 675', '2019-03-13', 'O'),
	'ginkgo'		=> new LosBuild('ginkgo', 'Xiaomi', 'Redmi Note 8', 'Redmi Note 8T', 'Snapdragon 665', '2019-08-01', 'O'),
	'merlinx'		=> new LosBuild('merlinx', 'Xiaomi', 'Redmi Note 9', '', 'Helio G85', '2020-05-01', 'D'),
	'ysl'		=> new LosBuild('ysl', 'Xiaomi', 'Redmi S2', 'Redmi Y2', 'Snapdragon 625', '2018-05-01', 'U'),
	'lisa'		=> new LosBuild('lisa', 'Xiaomi', 'Xiaomi 11 Lite 5G NE', 'Xiaomi 11 Lite NE 5G, Mi 11 LE', 'Snapdragon 778G 5G', '2021-09-01', 'O'),
	'cupid'		=> new LosBuild('cupid', 'Xiaomi', 'Xiaomi 12', '', 'Snapdragon 8 Gen1', '2021-12-31', 'O'),
	'zeus'		=> new LosBuild('zeus', 'Xiaomi', 'Xiaomi 12 Pro', '', 'Snapdragon 8 Gen1', '2021-12-31', 'O'),
	'mayfly'		=> new LosBuild('mayfly', 'Xiaomi', 'Xiaomi 12S', '', 'Snapdragon 8+ Gen1', '2022-07-01', 'O'),
	'unicorn'		=> new LosBuild('unicorn', 'Xiaomi', 'Xiaomi 12S Pro', '', 'Snapdragon 8+ Gen1', '2022-07-04', 'O'),
	'thor'		=> new LosBuild('thor', 'Xiaomi', 'Xiaomi 12S Ultra', '', 'Snapdragon 8+ Gen1', '2022-07-09', 'O'),
	'diting'		=> new LosBuild('diting', 'Xiaomi', 'Xiaomi 12T Pro', 'Redmi K50 Ultra', 'Snapdragon 8+ Gen1', '2022-10-06', 'O'),
	'fuxi'		=> new LosBuild('fuxi', 'Xiaomi', 'Xiaomi 13', '', 'Snapdragon 8 Gen2', '2022-12-11', 'O'),
	'nuwa'		=> new LosBuild('nuwa', 'Xiaomi', 'Xiaomi 13 Pro', '', 'Snapdragon 8 Gen2', '2022-12-11', 'O'),
	'clover'		=> new LosBuild('clover', 'Xiaomi', 'Xiaomi Mi Pad 4', '', 'Snapdragon 660', '2018-06-25', 'U'),
	'Amber'		=> new LosBuild('Amber', 'Yandex', 'Phone', '', 'Snapdragon 630', '2018-12-01', 'D'),
	'jalebi'		=> new LosBuild('jalebi', 'YU', 'Yunique', '', 'Snapdragon 410', '2015-09-01', 'D'),
	'lettuce'		=> new LosBuild('lettuce', 'YU', 'Yuphoria', '', 'Snapdragon 410', '2015-05-12', 'D'),
	'tomato'		=> new LosBuild('tomato', 'YU', 'Yureka', 'Yureka Plus', 'Snapdragon 615', '2014-12-18', 'D'),
	'jasmine'		=> new LosBuild('jasmine', 'ZTE', 'AT&T Trek 2 HD', '', 'Snapdragon 617', '2016-08-01', 'D'),
	'axon7'		=> new LosBuild('axon7', 'ZTE', 'Axon 7', '', 'Snapdragon 820', '2016-06-01', 'D'),
	'tulip'		=> new LosBuild('tulip', 'ZTE', 'Axon 7 Mini', '', 'Snapdragon 617', '2016-09-01', 'D'),
	'akershus'		=> new LosBuild('akershus', 'ZTE', 'Axon 9 Pro', '', 'Snapdragon 845', '2018-11-01', 'O'),
	'ham'		=> new LosBuild('ham', 'ZUK', 'Z1', '', 'Snapdragon 801', '2015-10-14', 'D'),
	'z2_plus'		=> new LosBuild('z2_plus', 'ZUK', 'Z2 Plus', '', 'Snapdragon 820', '2016-06-01', 'D'),
	'waydroid_arm64'		=> new LosBuild('waydroid_arm64', '', 'Waydroid on ARM64', '', '', '2021-07-01', 'U'),
	'waydroid_x86'		=> new LosBuild('waydroid_x86', '', 'Waydroid on i386', '', '', '2021-07-01', 'U'),
	'waydroid_x86_64'		=> new LosBuild('waydroid_x86_64', '', 'Waydroid on x86_64', '', '', '2021-07-01', 'U'),
	'android_x86_64'		=> new LosBuild('android_x86_64', '', 'Android on x86_64', '', '', '', 'U'),
	'x86_64_tv'		=> new LosBuild('x86_64_tv', '', 'Android TV on x86_64', '', '', '', 'U'),
	'android_x86'		=> new LosBuild('android_x86', '', 'Android on x86', '', '', '', 'U'),
	'D22AP'		=> new LosBuild('D22AP', '', 'Android 12 (API 22)', '', '', '', 'U') 
];

//class to tally the number of builds and installs by LOS version, device processor type, manufacturer and statuses
class Tally {
	public $aBuilds      = [];
	public $aVersions    = [];
	public $aCountries   = [];
	public $aMakers      = ['unknown' => ['builds' => 0, 'installs' => 0]];
	public $aProcessors  = ['unknown' => ['builds' => 0, 'installs' => 0]];
	public $aStatuses    = [
		'O' => ['builds' => 0, 'installs' => 0], //active official builds
		'D' => ['builds' => 0, 'installs' => 0], //discontinued official builds
		'U' => ['builds' => 0, 'installs' => 0]  //unofficial builds
	];
	//years when devices were originally released
	public $aYears       = [
		'unknown' => ['U' => ['builds' => 0, 'installs' => 0] ] //unofficial builds
	];
	public $totalBuilds = 0;
	public $totalInstalls = 0;
	public $unknownInstalls = null; //installs that weren't counting by script
	
	//add a build to the tally
	public function addBuild(LosBuild $oBuild) {
		$this->totalBuilds++;
		$this->totalInstalls += $oBuild->installs;
		$this->aBuilds[$oBuild->codename] = $oBuild->installs;
		
		if (!empty($oBuild->aVersions)) {
			foreach ($oBuild->aVersions as $versionNo => $versionInstalls) {
				if (!isset($this->aVersions[$versionNo])) {
					$this->aVersions[$versionNo] = ['builds' => 0, 'installs' => 0];
				}
				
				$this->aVersions[$versionNo]['builds']++;
				$this->aVersions[$versionNo]['installs'] += $versionInstalls;
			}
		}
		
		if (!empty($oBuild->aCountries)) {
			foreach ($oBuild->aCountries as $country => $countryInstalls) {
				if (!isset($this->aCountries[$country])) {
					$this->aCountries[$country] = ['builds' => 0, 'installs' => 0];
				}
				
				$this->aCountries[$country]['builds']++;
				$this->aCountries[$country]['installs'] += $countryInstalls;
			}
		}
		
		if (empty($oBuild->maker)) {
			$this->aMakers['unknown']['builds']++;
			$this->aMakers['unknown']['installs'] += $oBuild->installs;
		} else {
			if (!isset($this->aMakers[$oBuild->maker])) {
				$this->aMakers[$oBuild->maker] = ['builds' => 0, 'installs' => 0];
			}
			
			$this->aMakers[$oBuild->maker]['builds']++;
			$this->aMakers[$oBuild->maker]['installs'] += $oBuild->installs;
		}
		
		if (empty($oBuild->processor)) {
			$this->aProcessors['unknown']['builds']++;
			$this->aProcessors['unknown']['installs'] += $oBuild->installs;
		} else {
			//Add array index as first letter upperclass and other letters as lowercase. Ex: "OMAP" -> "Omap"
			if (preg_match('/Snapdragon ([24678S])/i', $oBuild->processor, $match)) {
				$processorType = "Snapdragon ".$match[1];
			} else {
				$processorType = ucwords(strtolower(explode(' ', $oBuild->processor)[0]));
			}
			
			if (!isset($this->aProcessors[$processorType])) {
				$this->aProcessors[$processorType] = ['builds' => 0, 'installs' => 0];
			}
			
			$this->aProcessors[$processorType]['builds']++;
			$this->aProcessors[$processorType]['installs'] += $oBuild->installs;
		}
		
		$status = empty($oBuild->status) ? 'U' : $oBuild->status;
		$this->aStatuses[$status]['builds']++;
		$this->aStatuses[$status]['installs'] += $oBuild->installs;
		
		if (empty($oBuild->modelReleaseDate)) {
			$this->aYears['unknown'][$status]['builds']++;
			$this->aYears['unknown'][$status]['installs'] += $oBuild->installs;
		} else {
			$year = substr($oBuild->modelReleaseDate, 0, 4);
			
			if (!isset($this->aYears[$year])) {
				$this->aYears[$year] = [
					'O' => ['builds' => 0, 'installs' => 0],
					'D' => ['builds' => 0, 'installs' => 0],
					'U' => ['builds' => 0, 'installs' => 0]
				];
			}
			
			$this->aYears[$year][$status]['builds']++;
			$this->aYears[$year][$status]['installs'] += $oBuild->installs;
		}
	}
	
	//finalize the tally by calculating the percentages of the different categories, plus the number of unknown installs
	public function finalize($worldInstalls=null) {
		if ($worldInstalls) {
			$this->unknownInstalls = $worldInstalls - $this->totalInstalls;
		}
		
		$sumBuilds = $sumInstalls = 0;
		foreach ($this->aMakers as $makerName => $aMaker) {
			$this->aMakers[$makerName]['percentBuilds'] = 
				percentString($this->aMakers[$makerName]['builds'] / $this->totalBuilds, 1);
			$this->aMakers[$makerName]['percentInstalls'] = 
				percentString( $this->aMakers[$makerName]['installs'] / $this->totalInstalls);
		}
		
		//if ($this->unknownInstalls) {
		//	$this->aMakers["others"] = ['builds' = null, 'percentBuilds' = null, "installs" = $this->unknownInstalls];
		//}  
		
		$this->aMakers["Total"] = ['maker'=> 'Total', 'builds' => $this->totalBuilds, 'percentBuilds' => '100%', 
			'installs' => $this->totalInstalls, 'percentInstalls' => '100%'];
		
		foreach ($this->aProcessors as $processorType => $aProcessor) {
			$this->aProcessors[$processorType]['percentBuilds'] = 
				percentString($this->aProcessors[$processorType]['builds'] / $this->totalBuilds, 1);
			$this->aProcessors[$processorType]['percentInstalls'] = 
				percentString( $this->aProcessors[$processorType]['installs'] / $this->totalInstalls );
		}
		
		$this->aProcessors["Total"] = ['name' => 'Total', 'builds' => $this->totalBuilds, 'percentBuilds' => '100%', 
			'installs' => $this->totalInstalls, 'percentInstalls' => '100%'];
		
		foreach ($this->aStatuses as $statusCode => $aStatus) {
			$this->aStatuses[$statusCode]['percentBuilds'] = 
				percentString($this->aStatuses[$statusCode]['builds'] / $this->totalBuilds, 1);
			$this->aStatuses[$statusCode]['percentInstalls'] = 
				percentString( $this->aStatuses[$statusCode]['installs'] / $this->totalInstalls );
		}
		
		foreach ($this->aVersions as $version => $aVersion) {
			$this->aVersions[$version]['percentBuilds'] = 
				percentString($this->aVersions[$version]['builds'] / $this->totalBuilds, 1);
			$this->aVersions[$version]['percentInstalls'] = 
				percentString( $this->aVersions[$version]['installs'] / $this->totalInstalls );
		}
		
		foreach ($this->aYears as $year => $aYear) {
			$yearBuilds = $yearInstalls = 0; //sum totals for year
			 
			foreach ($this->aYears[$year] as $status => $aStatus) {
				$this->aYears[$year][$status]['percentBuilds'] = 
					percentString( $this->aYears[$year][$status]['builds'] / $this->totalBuilds, 1);
				$this->aYears[$year][$status]['percentInstalls'] = 
					percentString( $this->aYears[$year][$status]['installs'] / $this->totalInstalls );
				$yearBuilds += $this->aYears[$year][$status]['builds'];
				$yearInstalls += $this->aYears[$year][$status]['installs'];
			}
			
			$this->aYears[$year]['Total']['builds'] = $yearBuilds;
			$this->aYears[$year]['Total']['percentBuilds'] = 
				percentString($yearBuilds / $this->totalBuilds);
			$this->aYears[$year]['Total']['installs'] = $yearInstalls;
			$this->aYears[$year]['Total']['percentInstalls'] = 
				percentString($yearInstalls / $this->totalInstalls);
		}
	}
	
	public function showMakers($orderBy="installs", $order="descending") {
		$aSort = [];
		
		foreach ($this->aMakers as $makerName => $aMaker) {
			if ($makerName == 'Total') {
				continue;
			}
			$aMaker["maker"] = $makerName;
			$idx = $orderBy ? $aMaker[$orderBy] : $makerName; 
			$aSort[$idx] = $aMaker;
		}
		
		if ($order == "descending") {
			krsort($aSort);
		} else {
			ksort($aSort);
		}
		$aSort['Total'] = $this->aMakers['Total'];
		
		print "+++==== Manufacturers of devices that run LineageOS ====+++\n";
		print "Rank\tMaker\tBuilds\t" . 
			($GLOBALS['onlyShowInstalls'] ? "Installs" : "% Builds\tInstalls\t% Installs")."\n";
		$rank = 0;
		
		foreach ($aSort as $aMaker) {	
			$rank++;
			print ($aMaker['maker']=='Total' ? '' : $rank) . "\t{$aMaker['maker']}\t{$aMaker['builds']}\t". 
				($GLOBALS['onlyShowInstalls'] ? "{$aMaker['installs']}\n" :
				"{$aMaker['percentBuilds']}\t{$aMaker['installs']}\t{$aMaker['percentInstalls']}\n");
		}
		print "\n";
	}
	
	public function showProcessors($orderBy="installs", $order="descending") {
		$aSort = [];
		
		foreach ($this->aProcessors as $processorType => $aProcessor) {
			if ($processorType == 'Total') {
				continue;
			}
			$aProcessor["name"] = $processorType;
			$idx = $orderBy ? $aProcessor[$orderBy] : $processorType; 
			$aSort[$idx] = $aProcessor;
		}
		
		if ($order == "descending") {
			krsort($aSort);
		} else {
			ksort($aSort);
		}
		
		print "+++==== Processors of devices that run LineageOS ====+++\n";
		print "Rank\tProcessor\tBuilds\t" . 
			($GLOBALS['onlyShowInstalls'] ? "Installs" : "% Builds\tInstalls\t% Installs")."\n";
		$rank = 0;
		
		foreach ($aSort as $aItem) {
			$rank++;
			print "$rank\t{$aItem['name']}\t{$aItem['builds']}\t". 
				($GLOBALS['onlyShowInstalls'] ? "{$aItem['installs']}\n" :
				"{$aItem['percentBuilds']}\t{$aItem['installs']}\t{$aItem['percentInstalls']}\n");
		}
		
		print "\n";
	}
	
	public function showStatuses() {
		print "+++==== Statuses of LineageOS builds ====+++\n";
		print "Status\tBuilds\t" . ($GLOBALS['onlyShowInstalls'] ? "Installs" : "% Builds\tInstalls\t% Installs")."\n";
		
		foreach ($this->aStatuses as $status => $aItem) {
			print "{$status}\t{$aItem['builds']}\t". 
				($GLOBALS['onlyShowInstalls'] ? "{$aItem['installs']}\n" :
				"{$aItem['percentBuilds']}\t{$aItem['installs']}\t{$aItem['percentInstalls']}\n");
		}
		
		print "\n";
	}
	
	public function showVersions($orderBy="installs", $order="descending") {
		$aSort = [];
		
		foreach ($this->aVersions as $versionNo => $aItem) {
			$aItem["name"] = $versionNo;
			$idx = $orderBy ? $aItem[$orderBy] : $versionNo; 
			$aSort[$idx] = $aItem;
		}
		
		if ($order == "descending") {
			krsort($aSort);
		} else {
			ksort($aSort);
		}
		
		print "+++==== LineageOS versions in active installs ====+++\n";
		
		print "Rank\tVersion\tBuilds\t" . 
			($GLOBALS['onlyShowInstalls'] ? "Installs" : "% Builds\tInstalls\t% Installs") . "\n";
		$rank = 0;
		
		foreach ($aSort as $aItem) {
			$rank++;
			print "$rank\t{$aItem['name']}\t{$aItem['builds']}\t". 
				($GLOBALS['onlyShowInstalls'] ? "{$aItem['installs']}\n" :
				"{$aItem['percentBuilds']}\t{$aItem['installs']}\t{$aItem['percentInstalls']}\n");
		}
		
		print "\n";
	}
	
	//show years when devices running LineageOS were released
	//sort by year
	public function showYears() {
		$aSort = $this->aYears;
		ksort($aSort);
		
		print "+++==== Years when devices running LineageOS were released ====+++\n";
		
		print "Year\tStatus\tBuilds\t" . 
			($GLOBALS['onlyShowInstalls'] ? 'Installs' : "% Builds\tInstalls\t% Installs")."\n";
		
		foreach ($aSort as $year => $aYear) {
			foreach ($aYear as $status => $aStatus) {
				print "$year\t$status\t{$aStatus['builds']}\t". 
					($GLOBALS['onlyShowInstalls'] ? "{$aStatus['installs']}\n" :
					"{$aStatus['percentBuilds']}\t{$aStatus['installs']}\t{$aStatus['percentInstalls']}\n");
			}
		}
		
		print "\n";
	}
}

if ($showCountry) {
	if ($showCountry == 'default') {
		showCountryList();
	} else {
		showOneCountry($showCountry);
	}
}

if ($showBuild) {
	if ($showBuild == 'default')
		showBuildList();
	else
		showOneBuild($showBuild);
}

if (date_default_timezone_get() == 'UTC' and $GLOBALS['OS'] == 'unix-like') {
	print "Reported on ". trim(shell_exec('date')) .".\n";
} else {
	print "Reported on ".date("Y-m-d H:i:s").".\n";
}

$endTime = microtime(true);
$executionTime = ($endTime - $startTime);
$minutes = (int) ($executionTime / 60);
$seconds = $executionTime % 60;
echo "Script execution time = ". 
	($minutes ? "$minutes minutes $seconds" : $executionTime) . " seconds\n";
	
 

function showBuildList() {
	global $countryData, $buildData, $verbose, $onlyShowInstalls;
	
	$aBuilds = array();
	$tally = new Tally();
	$ctryCount = 0;
	
	//set up stdin to receive key presses:
	$breakDownloads = false;
	$stdin = fopen('php://stdin', 'r');
	stream_set_blocking($stdin, false);
	system('stty cbreak -echo');
	
	$html = new simple_html_dom();
	$html->load_file('https://stats.lineageos.org/');
	$worldDownloads = $html->find('div[id=total-download]', 0)->find('div.aside-value', 0)->innertext();
	$aDivCountries  = $html->find('div[id=top-countries]', 0)->find('div.leaderboard-row');
	
	print "Downloading builds from http://stats.lineageos.org" .
		($GLOBALS['OS'] == "unix-like" ? ". Press 'b' to break downloads.\n": "...\n");
	
	foreach($aDivCountries as $divCountry) {
		if ($GLOBALS['OS'] == "unix-like") {
			//check if user presses "b" to break downloading
			$char = fgetc($stdin);
			if ($breakDownloads or $char == 'b') {
				print "Breaking downloads and showing results for ".count($aBuilds)." builds...\n";
				system('stty sane');
				fclose($stdin);
				break;
			}
		}
		$ctryCount++;
		$countryCode = $divCountry->find("span.leaderboard-left a", 0)->innertext();
		$countryInstalls = $divCountry->find("span.leaderboard-right", 0)->innertext();
		$idx = sprintf("%07d", $countryInstalls) ."-". $countryCode;
		
		if (isset($countryData[$countryCode])) {
			$countryPop = $countryData[$countryCode][1];
			$installsPerMillion = ($countryPop) ? round($countryInstalls/($countryPop/1000)) : '';  
			$aCountries[$idx] = [$countryCode, $countryData[$countryCode][0], $countryPop, $installsPerMillion];
		}
		else {
			$aCountries[$idx] = [$countryCode, '', '', ''];
		}
		
		if ($verbose) {
			print("Get country #$ctryCount $countryCode:\t");
		}
		
		$ctryPage = new simple_html_dom();
		$ctryPage->load_file('https://stats.lineageos.org/country/' . $countryCode);
		
		if ($verbose) {
			print $countryInstalls."\n";
		}
		
		$aDivBuilds = $ctryPage->find('div[id=top-devices]', 0)->find('div.leaderboard-row');
		
		foreach ($aDivBuilds as $divBuild) {
			if ($GLOBALS['OS'] == "unix-like") {
				//check if user presses "b" to break downloading
				$char = fgetc($stdin);
				if ($char == 'b') {
					$breakDownloads = true;
					break;
				}
			}
			
			$buildCodeName = $divBuild->find("span.leaderboard-left a", 0)->innertext();
			
			if (isset($aBuilds[$buildCodeName])) {
				continue;
			}
			if ($verbose) {
				print "Get build #".(count($aBuilds)+1)." $buildCodeName:\t";
			}
			
			$aBuilds[$buildCodeName] = new LosBuild($buildCodeName);
			$aBuilds[$buildCodeName]->downloadInfo($buildCodeName, $buildData);
			$tally->addBuild($aBuilds[$buildCodeName]);
			
			if ($verbose) {
				print $aBuilds[$buildCodeName]->installs . "\n";
			}
		}
	}
	
	$tally->finalize($worldDownloads);
	$aSortBuilds = array();

	foreach ($aBuilds as $codename => $oBuild) {
		$index = sprintf("%07d", $oBuild->installs) ."-". $codename;
		$percentInstalls = percentString($oBuild->installs/$worldDownloads);
		
		$aSortBuilds[$index] = 
			$oBuild->codename . "\t" .
			$oBuild->maker ."\t". 
			$oBuild->modelName .
			($oBuild->altModelNames ? ', '.$oBuild->altModelNames : '') ."\t".
			($onlyShowInstalls ? $oBuild->installs : 
			$oBuild->processor ."\t".
			$oBuild->modelReleaseDate ."\t".
			$oBuild->status ."\t".
			$oBuild->installs ."\t".
			$percentInstalls);
	}
	
	krsort($aSortBuilds);
	
	if ($tally->unknownInstalls) {
		$percentOfTotal = percentString($tally->unknownInstalls/$worldDownloads);
		$aSortBuilds[' Others'] = "Other builds\t\t\t" . 
			($onlyShowInstalls ? $tally->unknownInstalls : "\t\t\t".$tally->unknownInstalls."\t".$percentOfTotal);
	}
	
	$aSortBuilds[' World'] = "World\t\t\t". ($onlyShowInstalls ? $worldDownloads : "\t\t\t$worldDownloads\t100%");
	$buildRank = 0;
	print "+++==== LineageOS builds - global ranking by installs ====+++\n"; 
	print "Rank\tCodename\tMaker\tModel\t" . ($onlyShowInstalls ? $Installs."\n" : 
		"Processor\tModel released\tStatus\tInstalls\t% of total\n");
	
	foreach ($aSortBuilds as $build) {
		$buildRank++;
		print $buildRank.".\t".$build."\n";
	}
	
	if (!$onlyShowInstalls) {
		print "\nstatus codes: O=active official build, D=discontinued official build, U=unofficial build\n";
	} 
	
	print "\n";
	$tally->showMakers();
	$tally->showProcessors();
	$tally->showStatuses();
	$tally->showVersions();
	$tally->showYears();
}

function showCountryList() {
	$countryData = $GLOBALS['countryData'];
	$onlyShowInstalls = $GLOBALS['onlyShowInstalls'];
	
	$aCountries = array(); 
	
	$html = new simple_html_dom();
	$html->load_file('https://stats.lineageos.org/');
	$worldDownloads = $html->find('div[id=total-download]', 0)->find('div.aside-value', 0)->innertext();
	$aDivCountries = $html->find('div[id=top-countries]', 0)->find('div.leaderboard-row');
	
	foreach($aDivCountries as $divCountry) {
		$countryCode = $divCountry->find("span.leaderboard-left a", 0)->innertext();
		$countryInstalls = $divCountry->find("span.leaderboard-right", 0)->innertext();
		
		$idx = sprintf("%07d", $countryInstalls) ."-". $countryCode;
		$percentOfTotal = percentString($countryInstalls/$worldDownloads);
		
		if (isset($countryData[$countryCode])) {
			$countryPop = $countryData[$countryCode][1];
			$installsPerMillion = ($countryPop) ? round($countryInstalls/($countryPop/1000)) : '';  
			$aCountries[$idx] = [$countryCode, $countryData[$countryCode][0], $countryInstalls, 
				$percentOfTotal, $installsPerMillion, $countryPop];
		}
		else {
			$aCountries[$idx] = [$countryCode,'', $countryInstalls, $percentOfTotal, '', ''];
		}
	}
	
	//Add world total:
	$worldInstallsPerMillion = round($worldDownloads/($countryData['World'][1]/1000));
	$aCountries[' World'] = ['World', 'World', $worldDownloads, '100%', $worldInstallsPerMillion, 
		$countryData['World'][1]];
	
	//stats.lineageos.org uses multiple codes for 4 countries, so add both 
	//codes for those countries and eliminate the non-standard ISO codes
	mergeTwoCountries('IS', 'IC', $aCountries);
	mergeTwoCountries('GB', 'UK', $aCountries);
	mergeTwoCountries('BJ', 'DY', $aCountries);
	mergeTwoCountries('CZ', 'XC', $aCountries);  
	
	krsort($aCountries);
	
	print "CC\tCountry\tInstalls" . ($onlyShowInstalls ? "\n" : 
		"\t% of total\tInstalls/million\tPopulation (000)\n");
	
	foreach ($aCountries as $key=>$country) {
		if (!is_array($country) or count($country) < 6) {
			print("Bad key: ".$key);
			var_dump($country);
		}
		else {
			print "{$country[0]}\t{$country[1]}\t{$country[2]}" . 
				($onlyShowInstalls ? "\n" : "\t{$country[3]}\t{$country[4]}\t{$country[5]}\n");
		}
	}
	print "\n";
}

//function to merge the records of two countries, because LineageOS uses two country codes for the same country
function mergeTwoCountries($countryToKeep, $countryToErase, &$aCountries) {
	$aCountryKeys = array_keys($aCountries);
	
	$keepKey  = preg_grep('/'.$countryToKeep.'$/',  $aCountryKeys);
	$eraseKey = preg_grep('/'.$countryToErase.'$/', $aCountryKeys);
	
	if (empty($keepKey) or empty($eraseKey)) {
		throw new Exception("Unable to find the country keys '$countryToKeep' and '$countryToErase' in mergeTwoCountries().");
	}
	//get first element in an associative array:
	$keepKey  = array_values($keepKey)[0];
	$eraseKey = array_values($eraseKey)[0];
	
	$aCountryInfo = $aCountries[$keepKey];
	$aCountryInfo[2] = $aCountryInfo[2] + $aCountries[$eraseKey][2]; //sum installs from two country codes 
	$idx = sprintf("%07d", $aCountryInfo[2]) ."-". $countryToKeep;
	$percentOfTotal = sprintf("%.2f", ($aCountryInfo[2]/$aCountries[' World'][2])*100) . "%"; 
	$aCountryInfo[5] = ($aCountryInfo[5]) ? round($aCountryInfo[2]/($aCountryInfo[5]/1000)) : '';
	
	unset($aCountries[$keepKey]);
	unset($aCountries[$eraseKey]);
	$aCountries[$idx] = $aCountryInfo;
}

function showOneCountry($country) {
	global $countryData, $buildData, $onlyShowInstalls;
	$aProcessors = [];
	$aMakers = [];
	$aBuilds = [];
	$tally = new Tally();
	$country = trim($country);
	
	//if not a 2 letter country code, then search to see if in list of countries. 
	if (strlen($country) != 2) {
		$foundKey = false;
		
		foreach ($countryData as $ctryCode => $ctry) {
			if (strcasecmp($country, $ctry[0]) == 0) {
				$foundKey = $ctryCode;
				break;
			}
		}
		
		if (!$foundKey) {
			print "Unable to find code for country \"$country\".\n";
			return;
		}
		$country = $foundKey;
	}
	
	$country = strtoupper($country);
	$ctryPage = new simple_html_dom();
	$ctryPage->load_file('https://stats.lineageos.org/country/' . $country);
	
	$countryInstalls = $ctryPage->find('div[id=total-download]', 0)->find('div.aside-value', 0)->innertext();
	$aDivBuilds = $ctryPage->find('div[id=top-devices]', 0)->find('div.leaderboard-row');
	$runningTotal = 0;
	
	if (isset($countryData[$country])) {
		$installsPerMillion = round($countryInstalls/($countryData[$country][1]/1000));  
		print "Report for {$countryData[$country][0]} ($country)\nInstalls:\t$countryInstalls\t" .
			"Installs/million people:\t$installsPerMillion\n\n"; 
	}
	else {
		print "Report for $country\nInstalls:\t$countryInstalls\n\n";
	}
	
	if ($onlyShowInstalls) {
		print "Build\tMaker\tModel\tInstalls\n";
	} else {
		print "Build\tMaker\tModel\tProcessor\tModel released\tStatus\tInstalls\t% of installs\n";
	}
	
	foreach ($aDivBuilds as $divBuild) {
		$codename = $divBuild->find("span.leaderboard-left a", 0)->innertext();
		$installs = $divBuild->find("span.leaderboard-right", 0)->innertext();
		$runningTotal += $installs;
		$percentInstalls = percentString($installs/$countryInstalls, 2);
		
		if (isset($buildData[$codename])) {
			$maker = $buildData[$codename]->maker;
			$processor = $buildData[$codename]->processor;
			
			print $codename ."\t". $maker ."\t". $buildData[$codename]->modelName .
				($buildData[$codename]->altModelNames ? 
				', '.$buildData[$codename]->altModelNames : '') ."\t".
				($onlyShowInstalls ? $installs ."\n" :
				$processor ."\t". $buildData[$codename]->modelReleaseDate ."\t".
				$buildData[$codename]->status ."\t". $installs ."\t". $percentInstalls ."\n");
			
			if (!isset($aMakers[$maker])) {
				$aMakers[$maker] = array('builds' => 0, 'installs'=> 0);
			}
			
			$aMakers[$maker]['builds']++;
			$aMakers[$maker]['installs'] += $installs;
			
			$aBuilds[$codename] = new LosBuild($codename);
			$aBuildInfo = ['codename' => $codename, 'installs' => $installs];
			$aBuilds[$codename]->setInfo($aBuildInfo);
			$tally->addBuild($aBuilds[$codename]);
			/*
			if (empty($processor)) {
				$procesfsorKey = null;
			}
			elseif (preg_match('/Snapdragon ([24678S])/i', $processor, $match)) {
				$processorKey = "Snapdragon ".$match[1];
			}
			else {
				$processorKey = ucwords(strtolower(explode(' ', $processor)[0]));
			}
			
			if ($processorKey) {
				if (!isset($aProcessors[$processorKey])) 
					$aProcessors[$processorKey] = array('builds' => 0, 'installs' => 0);
				
				$aProcessors[$processorKey]['builds']++;
				$aProcessors[$processorKey]['installs'] += $installs;
			}*/
		}
		else {
			print $codename."\t\t\t". ($onlyShowInstalls ? $installs."\n" : 
				"\t\t\t".$installs."\t".$percentInstalls."\n");
		}
	} 
	 
	$otherBuilds = $countryInstalls - $runningTotal;
	
	if ($otherBuilds > 0) {
		$percentInstalls = sprintf('%.2f', ($otherBuilds/$countryInstalls)*100) .'%';
		
		print "Other builds\t\t\t". ($onlyShowInstalls ? $otherBuilds."\n" :
			"\t\t\t".$otherBuilds."\t".$percentInstalls."\n");
	}
	
	if ($onlyShowInstalls) {
		print "Total\t\t\t$countryInstalls\n\n";
	} else {
		print "Total\t\t\t\t\t\t$countryInstalls\t100%\n\n";
	} 
	
	$tally->finalize($countryInstalls);
	$tally->showMakers();
	$tally->showProcessors();
	$tally->showStatuses();
	$tally->showYears();
	
	/*
	foreach ($aMakers as $key => $maker) {
		$percentInstalls = percentString($maker['installs']/$countryInstalls);
		
		print $key ."\t". $maker['builds'] ."\t". $maker['installs'] . 
			($onlyShowInstalls ? "\n" : "\t$percentInstalls\n");
	}
	
	print "\nProcessor\tBuilds\tInstalls" . ($onlyShowInstalls ? "\n" : "\t% of installs\n");
		
	foreach ($aProcessors as $key => $processor) {
		$percentInstalls = percentString($processor['installs']/$countryInstalls);

		print $key ."\t". $processor['builds'] ."\t". $processor['installs'] .
			($onlyShowInstalls ? "\n" : "\t". $percentInstalls ."\n");
	} */
}


function showOneBuild($buildCode) {
	global $countryData, $buildData, $onlyShowInstalls;
	$buildCode = preg_replace('/\s+/', ' ', trim($buildCode)); //turn all whitespace into single space
	
	$aStatusCodes = [
		'O' => 'O (active official build)',
		'D' => 'D (discontinued official build)', 
		'U' => 'U (unofficial build)'
	];
	
	$buildPage = new simple_html_dom();
	$found = null;
	
	//if build code only contains letters, numbers, underscores and dashes, 
	//then load page and see if downloads are greater than zero
	if (preg_match('/^[-_a-zA-Z0-9]+$/', $buildCode)) {
		$buildPage->load_file('https://stats.lineageos.org/model/' . $buildCode);
		$buildInstalls = $buildPage->find('div[id=total-download]', 0)->find('div.aside-value', 0)->innertext();
		
		if ($buildInstalls > 0)
			$found = $buildCode;
	}
	
	//if build code is not found, then do a case insensitive search for the build code and 
	//then search through the device model names to find the build
	if (!$found and !isset($buildData[$buildCode])) {
		$aBuildCodes = array_keys($buildData);
		
		foreach ($aBuildCodes as $code) {
			if (strcasecmp($code, $buildCode) == 0) {
				$found = $code;
				break;
			}
		}
		
		//do case insensitive search for model name or maker + model name 
		if (!$found) {
			foreach ($buildData as $oBuild) {
				$aModels      = [$oBuild->modelName];
				$aMakerModels = [$oBuild->maker .' '. $oBuild->modelName];
				
				foreach (preg_split('/\s*,\s*/', $oBuild->altModelNames) as $model) {
					$aModels[]      = $model;
					$aMakerModels[] = $oBuild->maker .' '. $model;
				}
				
				if (preg_grep('/^'.$buildCode.'$/i', $aMakerModels) or preg_grep('/^'.$buildCode.'$/i', $aModels)) {
					$found = $oBuild->codename;
					break;
				}
			}
		}
		
		//redo search for partial string match
		if (!$found) {
			foreach ($buildData as $oBuild) {
				$aModels      = [$oBuild->modelName];
				$aMakerModels = [$oBuild->maker .' '. $oBuild->modelName];
				
				foreach (preg_split('/\s*,\s*/', $oBuild->altModelNames) as $model) {
					$aModels[]      = $model;
					$aMakerModels[] = $oBuild->maker .' '. $model;
				}
				
				if (preg_grep('/'.$buildCode.'/i', $aMakerModels) or preg_grep('/'.$buildCode.'/i', $aModels)) {
					$found = $oBuild->codename;
				}
			}
		}
		
		if ($found) {
			$buildCode = $found;
		}
	}
	
	$buildPage->load_file('https://stats.lineageos.org/model/' . $buildCode);
	$buildInstalls = $buildPage->find('div[id=total-download]', 0)->find('div.aside-value', 0)->innertext();
	$installsPerMillion = sprintf('%.2f', $buildInstalls/($countryData['World'][1]/1000));
	
	if ($buildInstalls == 0) {
		print "There are 0 installs for build '$buildCode'. Check if build name is correct.\n";
		return; 
	}
	
	$aDivBuilds = $buildPage->find('div[id=top-countries]', 0)->find('div.leaderboard-row');
	$runningTotal = 0;$buildPage = new simple_html_dom();
	$buildPage->load_file('https://stats.lineageos.org/model/' . $buildCode);
	
	$buildInstalls = $buildPage->find('div[id=total-download]', 0)->find('div.aside-value', 0)->innertext();
	$installsPerMillion = sprintf('%.2f', $buildInstalls/($countryData['World'][1]/1000));
	
	$aDivBuilds = $buildPage->find('div[id=top-countries]', 0)->find('div.leaderboard-row');
	
	if (isset($buildData[$buildCode])) { 
		$status = $aStatusCodes[ $buildData[$buildCode]->status ]; 
		
		print "Build: $buildCode\tDevice: " . $buildData[$buildCode]->maker ."\t". 
			$buildData[$buildCode]->modelName . ($buildData[$buildCode]->altModelNames ? 
			', '.$buildData[$buildCode]->altModelNames : '') ."\n".
			($onlyShowInstalls ? "Installs: " . $buildInstalls ."\n\n":
			"Processsor: ". $buildData[$buildCode]->processor .
			"\tReleased: ". $buildData[$buildCode]->modelReleaseDate .
			"\tStatus: ". $status ."\n". 
			"Installs: " . $buildInstalls . 
			"\tGlobal installs / million persons: ". $installsPerMillion ."\n\n");
	}
	else {
		print "Report for $buildCode\tInstalls:\t$buildInstalls\n\n";
	}
	
	print "CC\tCountry\tInstalls". ($onlyShowInstalls ? "\n" : "\t% of installs\tInstalls/million\n");
	
	foreach ($aDivBuilds as $divBuild) {
		$countryCode = $divBuild->find("span.leaderboard-left a", 0)->innertext();
		$installs = $divBuild->find("span.leaderboard-right", 0)->innertext();
		$runningTotal += $installs;
		$percentInstalls = percentString($installs/$buildInstalls);
		
		if (isset($countryData[$countryCode])) {
			$countryName = $countryData[$countryCode][0];
			$installsPerMillion = sprintf('%.2f', $installs/($countryData[$countryCode][1]/1000));
			
			print $countryCode . "\t" . 
				$countryName . "\t" . 
				$installs . "\t" .
				($onlyShowInstalls ? "\n" : $percentInstalls."\t".$installsPerMillion."\n");
		}
		else {
			print $countryCode ."\t\t". $installs . 
				($onlyShowInstalls ? "\n" : "\t". $percentInstalls ."\n");
		}
	} 
	print "\n";
}

//make string of a percent with the number of decimal digits depending on the number. 
//If not a very small number, the defult number of decimal digits is set by $precision. 
function percentString($percent, $precision = 2) {
	if ($percent == 0) {
		return '0%';  
	}
	
	$aMinNumbers = [
		0 => 1,
		1 => 0.1,
		2 => 0.01, 
		3 => 0.001, 
		4 => 0.0001, 
		5 => 0.00001, 
		6 => 0.000001, 
		7 => 0.0000001,
		8 => 0.00000001,
		9 => 0.000000001
	];
	$percent = $percent * 100;
	
	while ($percent < $aMinNumbers[$precision] and $precision < 10) {
		$precision++;
	}
	 
	return sprintf('%.'.$precision.'f', $percent) .'%';
}

?>

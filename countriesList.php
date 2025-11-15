<?php
/*In a later version, I plan to change this so it gets downloaded from internet */

class Country {
	public $code;       //ISO 3166-1 country code
	public $enName;     //English name
	public $population; //population
	public $altNames;   //array of alternative names for the country
	public $restName;   //country name for REST service 
	public $notes;
	
	public function __construct($code, $enName, $population=null, $altNames=[], $restName, $notes=null) {
		$this->code = $code;
		$this->enName = $enName;
		$this->population = $population;
		$this->altNames = $altNames;
		$this->restName = $restName;
		$this->notes = $notes;
	}
}

$countriesFilename = 'countriesList.txt';

//data in buildList.txt is separated by tabs and first line contains the column headers
$aCountriesTabs = file($countriesFilename, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES) or 
	die ("Error: Unable to open file '$countriesFilename'.".PHP_EOL);

foreach ($aCountriesTabs as $countryLine) {
	$aData = preg_split("/ *\t */", $countryLine);
	
	//if not the right number of data columns in line:
	if (count($aData) < 4) {
		throw new Exception("Error in following line in countriesFilename:".PHP_EOL.$countryLine.PHP_EOL);
	}
	
	$countryData[ $aData[0] ] = new Country(
		$aData[0],
		$aData[1], 
		$aData[2],
		json_decode($aData[3]),
		$aData[4],
		$aData[5]
	); 
}

if (VERBOSE) {
	print count($countryData)." countries imported from the $countriesFilename file.".PHP_EOL;
}

$GLOBALS['countryData'] = $countryData;

if (UPDATE_POP) {
	$cntUpdatedPop = 0;
	$ch = curl_init();
	
	foreach ($countryData as $ctryCode => $ctry) {
		if (empty($ctry->restName)) {
			continue;
		}
		 
		$curYear = date('Y');
		$popRestUrl = 'https://d6wn6bmjj722w.population.io:443/1.0/population/'.
			rawurlencode($ctry->restName).'/'.$curYear.'-07-01/';
		
		curl_setopt($ch, CURLOPT_URL, $popRestUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$response = curl_exec($ch);
		
		if (curl_errno($ch)) {
			$error_msg = curl_error($ch);
			// Handle the error
			echo "cURL Error: " . $error_msg;
		} else {
			// Process the $response (e.g., json_decode if it's JSON)
			$aResponse = json_decode($response, true);
			$pop = $aResponse['total_population']['population'] / 1000;
			$countryData[$ctryCode]->population = $pop;
			$cntUpdatedPop++;
			//print_r($decoded_response);
		}
	}
	
	curl_close($ch);
	$fCountries = fopen('countriesList.txt', 'w');
	
	foreach ($countryData as $ctryCode => $ctry) {
		$line = $ctry->code."\t".$ctry->enName."\t".
			decimalString($ctry->population, 2)."\t".
			json_encode($ctry->altNames, JSON_UNESCAPED_UNICODE)."\t".
			$ctry->restName."\t".$ctry->notes."\n";
		fwrite($fCountries, $line);
	}
	
	fclose($fCountries);
	
	if (VERBOSE) {
		print "The population of $cntUpdatedPop countries was updated and ".
			"written to the countriesList.txt file.".PHP_EOL.PHP_EOL; 
	}
}

/*
$GLOBALS['countryData'] = $countryData = [
	'AF' => ['Afghanistan', 43844.11, ['Afghanestan', 'افغانستان']],
	'AX' => ['Åland Islands', '', []],
	'AL' => ['Albania', 2771.51, ['Shqipëria']],
	'DZ' => ['Algeria', 47435.31, ['Dzayer']],
	'AS' => ['American Samoa', 46.03, []],
	'AD' => ['Andorra', 82.9, []],
	'AO' => ['Angola', 39040.04, []],
	'AI' => ['Anguilla', 14.73, []],
	'AG' => ['Antigua and Barbuda', 94.21, []],
	'AR' => ['Argentina', 45851.38, []],
	'AM' => ['Armenia', 2952.37, ['Hayastán']],
	'AW' => ['Aruba', 108.15, []],
	'AU' => ['Australia', 26974.03, []],
	'AT' => ['Austria', 9113.57, ['Österreich']],
	'AZ' => ['Azerbaijan', 10397.71, ['Azərbaycan']],
	'BS' => ['Bahamas', 403.03, []],
	'BH' => ['Bahrain', 1643.33, ['Al-Bahrayn', 'البحرين']],
	'BD' => ['Bangladesh', 175686.9, ['বাংলাদেশ']],
	'BB' => ['Barbados', 282.62, []],
	'BY' => ['Belarus', 8997.6, ['Bielaruś', 'Беларусь']],
	'BE' => ['Belgium', 11758.6, ['België', 'Belgique', 'Belgien']],
	'BZ' => ['Belize', 422.92, ['Belice']],
	'BJ' => ['Benin', 14814.46, ['Bénin']],      //LOS also uses "DY" (Dahomey) for the same country
	'DY' => ['Benin', 14814.46, ['Bénin']],
	'BM' => ['Bermuda', 64.56, []],
	'BT' => ['Bhutan', 796.68, ['Druk Yul', 'འབྲུག་ཡུལ']],
	'BO' => ['Bolivia', 12581.84, ['Wuliwya','Volívia', 'Estado Plurinacional de Bolivia']],
	'BQ' => ['Bonaire, Sint Eustatius and Saba', 31.34, []],
	'BA' => ['Bosnia and Herzegovina', 3140.1, ['Bosnia', 'Bosnia I Hercegovína', 'Босна и Херцеговина']],
	'BW' => ['Botswana', 2562.12, []],
	'BV' => ['Bouvet Island', '', []],
	'BR' => ['Brazil', 212812.41, ['Brasil']],
	'IO' => ['British Indian Ocean Territory', 39.73, []],
	'BN' => ['Brunei', 466.33, ['بروني', 'Brunei Darussalam']],
	'BG' => ['Bulgaria', 6714.56, ['Bulgariya', 'България']],
	'BF' => ['Burkina Faso', 24074.58, []],
	'BI' => ['Burundi', 14390, ['Uburundi']],
	'CV' => ['Cape Verde', 527.33, ['Cabo Verde']],
	'KH' => ['Cambodia', 17847.98, ['Kampuchea', 'កម្ពុជា']],
	'CM' => ['Cameroon', 29879.34, ['Cameroun']],
	'CA' => ['Canada', 40126.72, []],
	'KY' => ['Cayman Islands', 75.84, []],
	'CF' => ['Central African Republic', 5513.28, ['République Centrafricaine', 'Ködörösêse tî Bêafrîka']],
	'TD' => ['Chad', 21003.71, ['Tchad', 'تشاد']],
	'CL' => ['Chile', 19859.92, []],
	'CN' => ['China', 1416096.09, ['Zhōngguó', '中国']],
	'CX' => ['Christmas Island', '', []],
	'CC' => ['Cocos (Keeling) Islands', '', []],
	'CO' => ['Colombia', 53425.64, []],
	'KM' => ['Comoros', 882.85, ['Comores', 'Koromi', 'جزر القمر']],
	'CG' => ['Congo', 6484.44, ['Republic of the Congo', 'République du Congo', 'Republíki ya Kongó']],
	'CD' => ['Congo, Democratic Republic', 112832.47, ['Democratic Republic of the Congo', 'DRC', 'République du Congo', 'Republíki ya Kongó']],
	'CK' => ['Cook Islands', 13.26, []],
	'CR' => ['Costa Rica', 5152.95, []],
	'CI' => ["Côte d'Ivoire", 32711.55, []],
	'HR' => ['Croatia', 3848.16, ['Hrvatska']],
	'CU' => ['Cuba', 10937.2, []],
	'CW' => ['Curaçao', 185.49, []],
	'CY' => ['Cyprus', 1370.75, ['Κύπρος Kıbrıs']],
	'CZ' => ['Czech Republic', 10609.24, ['Česko']],  //LOS also uses 'XC' for the same country
	'XC' => ['Czech Republic', 10609.24, ['Česko']],
	'DK' => ['Denmark', 6002.51, ['Danmark']],
	'DJ' => ['Djibouti', 1184.08, ['Djibouti', 'جيبوتي']],
	'DM' => ['Dominica', 65.87, []],
	'DO' => ['Dominican Republic', 11520.49, ['República Dominicana']],
	'EC' => ['Ecuador', 18289.9, []],
	'EG' => ['Egypt', 118366, [' مصرMisr']],
	'SV' => ['El Salvador', 6365.5, []],
	'GQ' => ['Equatorial Guinea', 1938.43, ['Guinea Ecuatorial']],
	'ER' => ['Eritrea', 3607, ['Iritriya', 'إرتريا Ertra']],
	'EE' => ['Estonia', 1344.23, ['Eesti']],
	'SZ' => ['Eswatini', 1256.17, ['Eswatini', 'eSwatini']],
	'ET' => ['Ethiopia', 135472.05, ["Ityop'ia", 'ኢትዮጵያ']],
	'FK' => ['Falkland Islands (Malvinas)', 3.47, []],
	'FO' => ['Faroe Islands', 56, []],
	'FJ' => ['Fiji', 933.15, ['Fiji', 'Viti', 'फ़िजी']],
	'FI' => ['Finland', 5623.33, ['Suomi']],
	'FR' => ['France', 66650.8, []],
	'GF' => ['French Guiana', 313.67, []],
	'PF' => ['French Polynesia', 282.47, []],
	'TF' => ['French Southern Territories', '', []],
	'GA' => ['Gabon', 2593.13, ['République gabonaise']],
	'GM' => ['Gambia', 2822.09, ['The Gambia']],
	'GE' => ['Georgia', 3806.67, ['საქართველო', "Sak'art'velo"]],
	'DE' => ['Germany', 84075.08, ['Deutschland']],
	'GH' => ['Ghana', 35064.27, ['Gaana', 'Gana']],
	'GI' => ['Gibraltar', 40.13, []],
	'GR' => ['Greece', 9938.84, ['Hellas', 'Ελλάς']],
	'GL' => ['Greenland', 55.75, []],
	'GD' => ['Grenada', 117.3, []],
	'GP' => ['Guadeloupe', 373.79, []],
	'GU' => ['Guam', 169, []],
	'GT' => ['Guatemala', 18687.88, []],
	'GG' => ['Guernsey', 64.48, []],
	'GN' => ['Guinea', 15099.73, ['Guinée', 'Gine', 'Gine']],
	'GW' => ['Guinea-Bissau', 2249.52, ['Guiné-Bissau']],
	'GY' => ['Guyana', 835.99, []],
	'HT' => ['Haiti', 11906.1, ['Haïti', 'Ayiti']],
	'HM' => ['Heard Island and McDonald Islands', '', []],
	'VA' => ['Vatican City', 0.5, ['Holy See', 'Città del Vaticano', 'Civitas Vaticana']],
	'HN' => ['Honduras', 11005.85, []],
	'HK' => ['Hong Kong', 7396.08, ['Heung Gong', '香港']],
	'HU' => ['Hungary', 9632.29, ['Magyarország']],
	'IS' => ['Iceland', 398.27, ['Ísland']],        //LOS also uses "IC" for the same country
	'IC' => ['Iceland', 398.27, ['Ísland']],
	'IN' => ['India', 1463865.53, ['Bharôt', ' ভাৰত', 'Bharôt', 'ভারত', 'Bhārat', 'ભારત', 'भारत', 'Bhārata', 'ಭಾರತ', 'Bhāratam', 'ഭാരതം', 'Bharôtô', 'ଭାରତ', 'भारतम्', 'Bārata', 'பாரதம்', 'Bhāratadēsam', 'భారత దేశం']],
	'ID' => ['Indonesia', 285721.24, []],
	'IR' => ['Iran', 92417.68, ['Īrān', 'ایران']],
	'IQ' => ['Iraq', 47020.77, ["Al-'Iraq", 'العراق']],
	'IE' => ['Ireland', 5308.04, ['Éire']],
	'IM' => ['Isle of Man', 84.12, []],
	'IL' => ['Israel', 9517.18, ['Israʼiyl', 'إسرائيل', "Yisra'el", 'ישראל']],
	'IT' => ['Italy', 59146.26, ['Italia']],
	'JM' => ['Jamaica', 2837.08, []],
	'JP' => ['Japan', 123103.48, ['Nippon', '日本']],
	'JE' => ['Jersey', 103.99, []],
	'JO' => ['Jordan', 11520.68, ["Al-'Urdun", 'الأردن']],
	'KZ' => ['Kazakhstan', 20843.75, ['Qazaqstan', 'Қазақстан', 'Kazakhstán', 'Казахстан']],
	'KE' => ['Kenya', 57532.49, []],
	'KI' => ['Kiribati', 136.49, ['Tungaru']],
	'KR' => ['South Korea', 51667.03, ['Hanguk', '한국', 'Namhan', '남한']],
	'XK' => ['Kosovo', 1674.13, ['Kosova', 'Косово']],
	'KW' => ['Kuwait', 5026.08, ['Dawlat ul-Kuwayt', 'دولة الكويت']],
	'KG' => ['Kyrgyzstan', 7295.03, ['Кыргызстан', 'Kirgizija', 'Киргизия']],
	'LA' => ['Laos', 7873.05, ['Lao', 'ປະເທດລາວ']],
	'LV' => ['Latvia', 1853.56, ['Latvija']],
	'LB' => ['Lebanon', 5849.42, ['Lubnān', 'Liban', 'لبنان']],
	'LS' => ['Lesotho', 2363.33, []],
	'LR' => ['Liberia', 5731.21, []],
	'LY' => ['Libya', 7458.56, ['Lībiyā', 'ليبيا']],
	'LI' => ['Liechtenstein', 40.13, []],
	'LT' => ['Lithuania', 2830.14, ['Lietuva']],
	'LU' => ['Luxembourg', 680.45, ['Luxemburg', 'Lëtezebuerg']],
	'MO' => ['Macao', 722, []],
	'MK' => ['Macedonia', 1813.79, []],
	'MG' => ['Madagascar', 32740.68, ['Madagasikara']],
	'MW' => ['Malawi', 22216.12, ['Malaŵi']],
	'MY' => ['Malaysia', 35977.84, ['Mǎláixīyà', '马来西亚', ' மலேசியா']],
	'MV' => ['Maldives', 529.68, ['Dhivehi Raajje']],
	'ML' => ['Mali', 25198.82, []],
	'MT' => ['Malta', 545.41, []],
	'MH' => ['Marshall Islands', 36.28, ['Aorōkin M̧ajeļ']],
	'MQ' => ['Martinique', 340.44, []],
	'MR' => ['Mauritania', 5315.07, ['Muritan', 'Agawec', 'Mūrītānyā', 'موريتانيا']],
	'MU' => ['Mauritius', 1268.28, ['Maurice', 'Moris']],
	'YT' => ['Mayotte', 337.01, []],
	'MX' => ['Mexico', 131946.9, ['Mēxihco', 'México']],
	'FM' => ['Micronesia', 528.68, ['Federated States of Micronesia']],
	'MD' => ['Moldova', 113.68, []],
	'MC' => ['Monaco', 38.34, ['Monaca', 'Múnegu']],
	'MN' => ['Mongolia', 3517.1, ['Mongol Uls', 'Монгол Улс']],
	'ME' => ['Montenegro', 632.73, ['Crna Gora', 'Црна Гора']],
	'MS' => ['Montserrat', 4.36, []],
	'MA' => ['Morocco', 38430.77, ['Al-maɣréb', 'المغرب', 'Amerruk', 'Elmeɣrib']],
	'MZ' => ['Mozambique', 35631.65, ['Moçambique']],
	'MM' => ['Myanmar', 54850.65, ['Myanma', 'မြန်မာ']],
	'NA' => ['Namibia', 3092.82, []],
	'NR' => ['Nauru', 12.03, ['Naoero']],
	'NP' => ['Nepal', 29618.12, ['Nepāl', 'नेपाल']],
	'NL' => ['Netherlands', 18346.82, ['The Netherlands', 'Nederland', 'Nederlân']],
	'NC' => ['New Caledonia', 295.33, []],
	'NZ' => ['New Zealand', 5251.9, ['Aotearoa']],
	'NI' => ['Nicaragua', 7007.5, []],
	'NE' => ['Niger', 27917.83, []],
	'NG' => ['Nigeria', 237527.78, ['Nijeriya', 'Naigeria', 'Nàìjíríà']],
	'NU' => ['Niue', 1.82, []],
	'KP' => ['North Korea', 26571, ['Chosŏn', '조선', 'Bukchosŏn', '북조선']],
	'NF' => ['Norfolk Island', '', []],
	'MP' => ['Northern Mariana Islands', 43.54, []],
	'NO' => ['Norway', 5623.07, ['Norge']],
	'OM' => ['Oman', 5494.69, ["‘Umān", 'عُمان']],
	'PK' => ['Pakistan', 255219.55, ['Pākistān', 'پاکستان']],
	'PW' => ['Palau', 17.66, ['Belau']],
	'PS' => ['Palestine', 5589.62, ['Filasṭīn', 'فلسطين']],
	'PA' => ['Panama', 4571.19, ['Panamá']],
	'PG' => ['Papua New Guinea', 10762.82, ['Papua Niugini', 'Papua Giugini']],
	'PY' => ['Paraguay', 7013.08, ['Paraguái']],
	'PE' => ['Peru', 34576.67, ['Piruw', 'Perú']],
	'PH' => ['Philippines', 116786.96, ['Pilipinas']],
	'PN' => ['Pitcairn', '', []],
	'PL' => ['Poland', 38140.91, ['Polska']],
	'PT' => ['Portugual', 10411.83, ['Portugal']],
	'PR' => ['Puerto Rico', 3235.29, []],
	'QA' => ['Qatar', 3115.89, ['Qaṭar', 'قطر']],
	'MD' => ['Moldova', 2996.11, []],
	'RE' => ['Réunion', 882.41, []],
	'RO' => ['Romania', 18908.65, ['România']],
	'RU' => ['Russian Federation', 143997.39, ['Rossiâ', 'Россия']],
	'RW' => ['Rwanda', 14569.34, []],
	'BL' => ['Saint Barthélemy', 11.41, []],
	'SH' => ['Saint Helena, Ascension and Tristan da Cunha', 5.2, []],
	'KN' => ['Saint Kitts and Nevis', 46.92, []],
	'LC' => ['Saint Lucia', 180.15, []],
	'MF' => ['Saint Martin (French part)', 24.94, []],
	'PM' => ['Saint Pierre and Miquelon', 5.57, []],
	'VC' => ['Saint Vincent and the Grenadines', 99.92, []],
	'WS' => ['Samoa', 219.31, ['Sāmoa']],
	'SM' => ['San Marino', 33.57, []],
	'ST' => ['Sao Tome and Principe', 240.25, ['São Tomé e Principe']],
	'SA' => ['Saudi Arabia', 34566.33, ['Al-‘Arabiyyah as Sa‘ūdiyyah', 'المملكة العربية السعودية']],
	'SN' => ['Senegal', 18931.97, ['Sénégal']],
	'RS' => ['Serbia', 6689.04, ['Srbija', 'Србија']],
	'SC' => ['Seychelles', 132.78, ['Sesel']],
	'SL' => ['Sierra Leone', 8819.79, []],
	'SG' => ['Singapore', 5870.75, ['Singapura', '新加坡', "சிங்கப்பூர்'"]],
	'NN' => ['Sint Maarten (Dutch part)', 43.92, []], //Really "SX", but LOS uses "NN"
	'SX' => ['Sint Maarten (Dutch part)', 43.92, []],
	'SK' => ['Slovakia', 5474.88, ['Slovensko']],
	'SI' => ['Slovenia', 2117.07, ['Slovenija']],
	'SB' => ['Solomon Islands', 838.65, ['Solomon Aelan', 'الصومال']],
	'SO' => ['Somalia', 19654.74, ['Soomaaliya aş-Şūmāl']],
	'ZA' => ['South Africa', 64747.32, ['Suid-Afrika', 'iNingizimu Afrika', 'uMzantsi Afrika', 'Afrika-Borwa', 'Aforika Borwa', 'Afurika Tshipembe', 'Afrika Dzonga', 'iNingizimu Afrika', 'iSewula Afrika']],
	'GS' => ['South Georgia and the South Sandwich Islands', '', []],
	'SS' => ['South Sudan', 12188.79, ['Paguot Thudän', 'Sudan Kusini']],
	'ES' => ['Spain', 47889.96, ['España', 'Espanya', 'Espainia']],
	'LK' => ['Sri Lanka', 23229.47, ['Sri Lankā', 'ශ්‍රී ලංකාව', ' இலங்கை']],
	'SD' => ['Sudan', 51662.15, ['As-Sudan', 'السودان']],
	'SR' => ['Suriname', 639.85, ['Surinam']],
	'SJ' => ['Svalbard and Jan Mayen', '', []],
	'SE' => ['Sweden', 10656.63, ['Sverige']],
	'CH' => ['Switzerland', 8967.41, ['Suisse', 'Schweiz', 'Svizzera', 'Svizra']],
	'SY' => ['Syrian Arab Republic', 25620.43, ['Suriyah', 'سورية']],
	'TW' => ['Taiwan', 23112.79, []],
	'TJ' => ['Tajikistan', 10786.73, ['Tojikistan', 'Тоҷикистон']],
	'TZ' => ['Tanzania', 70546, []],
	'TH' => ['Thailand', 71619.86, ['Mueang Thai', 'Prathet Thai', 'Ratcha-anachak Thai', 'เมืองไทย, ประเทศไทย', 'ราชอาณาจักรไทย']],
	'TL' => ['Timor-Leste', 1418.52, []],
	'TG' => ['Togo', 9721.61, []],
	'TK' => ['Tokelau', 2.61, []],
	'TO' => ['Tonga', 103.74, []],
	'TT' => ['Trinidad and Tobago', 1511.16, []],
	'TN' => ['Tunisia', 12348.57, ['Tunes', 'تونس']],
	'TR' => ['Turkey', 87685.43, ['Türkiye']],
	'TM' => ['Turkmenistan', 7618.85, ['Türkmenistan']],
	'TC' => ['Turks and Caicos Islands', 46.86, []],
	'TV' => ['Tuvalu', 9.49, []],
	'UG' => ['Uganda', 51384.89, []],
	'UA' => ['Ukraine', 38980.38, ['Ukraїna', 'Україна']],
	'AE' => ['United Arab Emirates', 11346, ['UAE', 'Al-’Imārat Al-‘Arabiyyah Al-Muttaḥidah', 'الإمارات العربيّة المتّحدة']],
	'GB' => ['United Kingdom', 69551.33, ['Y Deyrnas Unedig', 'Rìoghachd Aonaichte', 'Ríocht Aontaithe']],     //LOS also uses "UK" for same country
	'UK' => ['United Kingdom', 69551.33, ['Y Deyrnas Unedig', 'Rìoghachd Aonaichte', 'Ríocht Aontaithe']],
	'US' => ['United States', 347275.81, ['Estados Unidos', 'USA', 'United States of America']],
	'UM' => ['United States Minor Outlying Islands', 84.14, []],
	'UY' => ['Uruguay', 3384.69, []],
	'UZ' => ['Uzbekistan', 37053.43, ['O‘zbekiston', 'Ўзбекистон']],
	'VU' => ['Vanuatu', 335.17, []],
	'VE' => ['Venezuela', 28516.9, []],
	'VN' => ['Vietnam', 101598.53, ['Viet Nam', 'Việt Nam']],
	'VG' => ['Virgin Islands, British', '', []],
	'VI' => ['Virgin Islands, U.S.', '', []],
	'WF' => ['Wallis and Futuna', 11.19, []],
	'EH' => ['Western Sahara', 600.9, []],
	'YE' => ['Yemen', 41773.88, ['Al-Yaman', 'اليمن']],
	'ZM' => ['Zambia', 21913.87, []],
	'ZW' => ['Zimbabwe', 16950.8, []],
	'World' => ['World', 8231613.07, ['Mundo']]
	
	//world population data from United Nations, medium variant projection for July 1, 2025
	//https://population.un.org/wpp/assets/Excel%20Files/1_Indicator%20(Standard)/EXCEL_FILES/1_General/WPP2024_GEN_F01_DEMOGRAPHIC_INDICATORS_COMPACT.xlsx
];
*/
?>

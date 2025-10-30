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
 
Getting the country list is fast, but getting the build list is
very slow because the script has to download roughly 1500 web pages to
get all the builds for each country to construct the build list, and 
there are some less popular builds that it won't find because LineageOS 
only provides the top 250 builds for each country. LineageOS doesn't 
provide a complete list of builds, but it does provide a total installs 
number, so any installs that aren't found are tallied at the end of the 
list under "Unlisted". 

The status codes for the builds are: O=active official build, 
D=discontinued official build, U=unofficial build 
Note that many of the installs labeled as "O" are for versions that are
now discontinued, since they are no longer getting security updates.
 
INSTALLATION:   
1. Install the command line interface for PHP 7 or later.
2. Install the php-mbstring extension. 
3. Download this script from https://github.com/amosbatto/lineageos_stats
   If the ZIP file was downloaded, then decompress it. 
  
In a Debian/Ubuntu/Mint terminal, these commands should work:  
  sudo apt install php php-mbstring
  wget -O lineageos_stats.zip https://github.com/amosbatto/lineageos_stats/archive/refs/heads/main.zip
  unzip lineageos_stats.zip -d lineageos_stats
  
EXECUTION:  
To run the script in a terminal:  
  php lineageos_stats.php
  
Depending on how you installed PHP, you may have to include the path to 
execute it. For example in Windows:  
  C:\users\bob\php8.3\php.exe lineageos_stats.php 

Command line options:  
-c , --country    Display the country list.   
                  Ex: php lineageos_stats.php -c  
                  
-cXX              Can specify an optional two letter country code or a
--country=XX      country name to display stats for a single country.  
                  Ex: php lineageos_stats.php -cUS  
                  Ex: php lineageos_stats.php --country=BR  
                  Ex: php lineageos_stats.php -c"United Arab Emirates"  
                  
-b , --build      Display the build list.  
                  Ex: php lineageos_stats.php -b  
  
-bCODENAME        Can specify a build codename or a device model name to  
--build=CODENAME  display stats for a single build.  
                  Ex: php lineageos_stats.php -blavender  
                  Ex: php lineageos_stats.php --build=lavender  
                  Ex: php lineageos_stats.php -b"Xiaomi Redmi Note 7"  
                  Ex: php lineageos_stats.php --build="nOtE 7"  
                  The search is case insensitive and can find partial   
                  strings.
                   
-sSEP             The field separator for tables, which can be any 
--separator=SEP   string and is " | " by default. It is recommended to 
                  set to "\t" (tab) if copying into a spreadsheet and
                  to ',' (comma) or ';' (semicolon) if copying into a
                  a CSV (comma separated value) file.
                  Ex: php lineageos_stats.php -s"\t"                   
                  Ex: php lineageos_stats.php -separator="; "          
                  
-v , --verbose    Show information about what countries are being  
                  downloaded and what builds were found. Recommended for
                  progress on how script is progressing when getting the
                  build list.  

Author:  Amos Batto (amosbatto[AT]yahoo.com, https://amosbbatto.wordpress.com)
License: MIT license (for the lineageos_stats script and the included 
         SimpleHtmlDom (https://sourceforge.net/projects/simplehtmldom)
Updated: 2025-10-28 (version 0.3)

HELP;

$startTime = microtime(true);
mb_internal_encoding("UTF-8");

include './simple_html_dom/simple_html_dom.php';
include 'devicesList.php';
include 'countriesList.php';

$GLOBALS["OS"] = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? "windows" : "unix-like";

$shortOpts = 'hvs:c::b::';
$longOpts  = array('help', 'verbose', 'separator:', 'country::', 'build::');
$options = getopt($shortOpts, $longOpts);

if (isset($options['h']) || isset($options['help'])) {
	echo $help;
	exit(0);
}

$GLOBALS['verbose'] = $verbose = (isset($options['v']) || isset($options['verbose'])) ? true : false;
$GLOBALS['onlyShowInstalls'] = $onlyShowInstalls = 
	(isset($options['i']) || isset($options['installs'])) ? true : false;

$GLOBALS['separator'] = ' | ';

if (isset($options['s'])) { 
	$GLOBALS['separator'] = $options['s'];
} elseif (isset($options['separator'])) { 
	$GLOBALS['separator'] = $options['separator'];
}

$GLOBALS['separator'] = str_replace(['\t', '\n', '\r'], ["\t", "\n", "\r"], $GLOBALS['separator']); 

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


//Class to hold info about each LingeageOS build
class LosBuild {
	public $codename;   //codename of the LOS build
	//info about device(s) supported by the build:
	public $maker, $modelName, $altModelNames, $processor, $modelReleaseDate;
	public $status;     //status codes: O=active official build, D=discontinued official build, U=unofficial build 
	public $installs;   //installs for all the different versions of the build
	public $aVersions; 
	public $aCountries;
	
	public function __construct($codename=null, $maker=null, $modelName=null, $altModelNames=null, 
			$processor=null, $modelReleaseDate=null, $status=null) 
	{
		$this->codename         = $codename;    
		$this->maker            = $maker; 
		$this->modelName        = $modelName . ($altModelNames ? ', '.$altModelNames : '');
		$this->altModelNames    = null; //added to modelName, so variable is no longer used
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
		
		retryDownload:
		$buildPage = new simple_html_dom();
		$buildPage->load_file('https://stats.lineageos.org/model/'.$buildCode);
		
		try {
			$this->installs = $buildPage->find('div[id=total-download]', 0)->find('div.aside-value', 0)->innertext();
			$aVersionDivs = $buildPage->find('div[id=top-devices]', 0)->find('div.leaderboard-row');
		}
		catch (Exception $e) {
			print $e->getMessage() .PHP_EOL.'Retrying download...'.PHP_EOL;
			goto retryDownload;
		}
		
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
			//$this->altModelNames  = $buildData[$buildCode]->altModelNames;
			$this->processor        = $buildData[$buildCode]->processor; 
			$this->modelReleaseDate = $buildData[$buildCode]->modelReleaseDate; 
			$this->status           = $buildData[$buildCode]->status;
		}
	}
}

//Plain text column to include in TextTable in a terminal  
class TextCol {
	public $name;                //name of the column used in the associative array
	public $colTitle;            //title of the column to display in header
	public $width = 'adjust';    //width property of column, which can be: 
	                             // "none":   don't keep the column aligned with same width for every row
	                             // "adjust": automatically adjust the column width to longest string,
	                             //           up to the max numer of characters set by the maxWidth property.
	                             // "fixed":  column width in characters is set by maxWidth property
	public $maxWidth = -1;       //max width in characters of column at which it is truncated. 
	                             //Set to negative number for no trunctation.
	public $align = 'left';      //The column alignment can be: "left", "right" or "center"
	                             //The align property is ignored if $width is set to "none". 
	public $dataType = 'string'; //can be 'string', 'decimal', 'integer' or 'percent'
	public $decimalDigits = -1;  //set the number of decimal digits to display. 
	                             //Set to negative number to not round the decimal digits.
	public $hide = false;        //Set to true to hide the column
	
	public function __construct($name=null, $colTitle=null, $width='adjust', $maxWidth=-1, $align='left', $dataType='string', $decimalDigits=-1) {
		$this->name             = $name;
		$this->colTitle         = $colTitle; 
		$this->width            = $width;
		$this->maxWidth         = $maxWidth;
		$this->align            = $align;
		$this->dataType         = $dataType;
		$this->decimalDigits    = $decimalDigits;
	}
}

//class to display a plain text table in a terminal 
class TextTable {
	public $aRows = [];        //two dimensional array to hold table's data
	public $title;             //title to display above the table
	public $aCols = [];        //an array of TextCol objects for each column in the table
	public $colSep = ' | ';    //character(s) to separate table columns
	public $leftBorder = '| '; //left border character(s) to display the left border of table;
	                           //set to empty string to not have a left border.
	public $rightBorder = ' |'; //right border character(s) to display the right border of table;
	                           //set to empty string to not have a right border.
	public $hBorderChar = '-'; //horizontal border character to display top and bottom borders and separate header from body
	                           //set to empty string to not have horizontal borders.                            
	public $showHeader = true; //display the table header row
	
	public function __construct($aRows=[], $title=null, $aCols=[], $colSep=' | ', $leftBorder='| ', $rightBorder=' |', $hBorderChar='-', $showHeader=true) {
		$this->aRows       = $aRows; 
		$this->title       = $title;
		$this->aCols       = $aCols;
		$this->colSep      = $colSep;
		$this->leftBorder  = $leftBorder;
		$this->rightBorder = $rightBorder;
		$this->hBorderChar = $hBorderChar;
		$this->showHeader  = $showHeader;
	}
	
	//output the table to stdout. Need to set this up for output to file or buffer.
	public function output() {
		$colIdx = 0;     //index number of column
		$aRowsOut = [];  //two dimensional array of strings with table content to output
		$rowCnt = 0;
		$aColWidths = [];
		$aHeaders = [];
		
		//set initial table column widths:
		foreach ($this->aCols as $oCol) {
			$aColWidths[] = ($oCol->width == 'fixed') ? $oCol->maxWidth : 0;
		}

		if ($this->showHeader) {
			$cnt = 0;
			for ($i = 0; $i < count($this->aCols); $i++) {
				$oCol = $this->aCols[$i];
				$colHeader = $oCol->colTitle;
				
				if ($oCol->width != 'none' and $oCol->maxWidth > 0 and 
					mb_strlen($oCol->colTitle) > $oCol->maxWidth) 
				{
					$colHeader = mb_substr($oCol->colTitle, 0, $oCol->maxWidth-1) .'…';
				}
				
				$aColWidths[$i] = max(mb_strlen($colHeader), $aColWidths[$i]);
				$aHeaders[] = $colHeader;
			}
		}
		
		//convert table content to strings to get the widths of each column
		foreach ($this->aRows as $aRow) {
			$aRowOut = [];
			
			for ($colCnt = 0; $colCnt < count($aRow); $colCnt++) {
				$oCol = $this->aCols[$colCnt];
				
				//if (!isset($aRow[$oCol->name])) 
				//	var_dump($aRow);
				
				$cell = $aRow[ $oCol->name ];
				$sCell = (string) $cell;
				
				if (is_numeric($cell)) {
					if ($oCol->dataType == "decimal") {
						if ($oCol->decimalDigits >= 0) {
							$sCell = decimalString($cell, $oCol->decimalDigits);
						} else {
							$sCell = (string) $cell;
						}
					}
					elseif ($oCol->dataType == "percent") {
						if ($oCol->decimalDigits >= 0) {
							$sCell = percentString( $cell, $oCol->decimalDigits);
						} else {
							$sCell = ($cell*100).'%';
						}
					}
					elseif ($oCol->dataType == "integer") {
						$sCell = sprintf('%.0f', $cell);
					}
					
					$sCell = trim($sCell);
					$cellWidth = mb_strlen($sCell);
					
					if ($oCol->width != 'none' and $oCol->maxWidth > $cellWidth) {
						//if number has decimal digits, then reduce the number of decimal digits to fit max width
						if (preg_match('/^(\d*)(\.)(\d*)/', $sCell, $aMatch, PREG_OFFSET_CAPTURE)) {
							$nDecimals = mb_strlen($aMatch[1][0]); //get number of decimal digits
							
							//if whole digits greater than max length, then just return the integer
							if ($aMatch[2][1]+1 >= $oCol->maxWidth) {
								$sCell = sprintf('%.0f', $cell);
							} else {
								$allowedDecimals = $oCol->maxWidth - ($aMatch[2][1] + 1);
								$sCell = sprintf('%.'.$allowedDecimals.'f', $cell);
							}
						} else {
							$sCell = sprintf('%.0f', $cell);
						}
					}
				}
				//if a non-numeric string and longer than column's max width then truncate the string
				elseif ($oCol->width != 'none' and $oCol->maxWidth > 0 and mb_strlen($sCell) > $oCol->maxWidth) {
					$sCell = mb_substr($sCell, 0, $oCol->maxWidth-1) .'…';
				} 
				
				$aRowOut[$colCnt] = $sCell;
				$cellWidth = mb_strlen($sCell);
				
				if ($cellWidth > $aColWidths[$colCnt]) {
					$aColWidths[$colCnt] = $cellWidth;
				}
			}
			
			$aRowsOut[$rowCnt] = $aRowOut; 
			$rowCnt++;
		}
		
		//print table:
		if ($this->title) {
			echo $this->title, PHP_EOL;
		} 
		
		$tableWidth = mb_strlen($this->leftBorder) + mb_strlen($this->rightBorder); 
		
		if (count($this->aCols) > 0) {
			//add the column separators
			$tableWidth += (count($this->aCols)-1) * mb_strlen($this->colSep);
		}
		
		for ($i = 0; $i < count($this->aCols); $i++) {
			$tableWidth += $aColWidths[$i];
		}
		
		if ($this->hBorderChar) {
			echo mb_str_pad('', $tableWidth, $this->hBorderChar, STR_PAD_LEFT), PHP_EOL;
		} 
		
		if ($this->showHeader) {
			for ($i = 0; $i < count($aHeaders); $i++) {
				if ($GLOBALS['separator'] != ' | ')
					$aHeaders[$i] = $aHeaders[$i];
				else
					$aHeaders[$i] = mb_str_pad($aHeaders[$i], $aColWidths[$i], ' ', STR_PAD_BOTH);
			} 
			
			echo $this->leftBorder, implode($this->colSep, $aHeaders), $this->rightBorder, PHP_EOL;
			
			if ($this->hBorderChar) {
				echo mb_str_pad('', $tableWidth, $this->hBorderChar, STR_PAD_LEFT), PHP_EOL;
			} 
		}
		
		foreach ($aRowsOut as $aRowPrint) {
			for ($i = 0; $i < count($aRowPrint); $i++) {
				if ($GLOBALS['separator'] == ' | ' and $this->aCols[$i]->width != 'none') {
					$padding = STR_PAD_RIGHT;   //left aligned
					if ($this->aCols[$i]->align == 'center') {
						$padding = STR_PAD_BOTH;
					} elseif ($this->aCols[$i]->align == 'right') {
						$padding = STR_PAD_LEFT; //right aligned
					}
					$aRowPrint[$i] = mb_str_pad($aRowPrint[$i], $aColWidths[$i], ' ', $padding);
				}
			}
			echo $this->leftBorder, implode($this->colSep, $aRowPrint), $this->rightBorder, PHP_EOL;
		}
		
		if ($this->hBorderChar) {
				echo mb_str_pad('', $tableWidth, $this->hBorderChar, STR_PAD_LEFT), PHP_EOL;
		}
	} 
}



//class to tally the number of builds and installs by LOS version, device processor type, manufacturer and statuses
class Tally {
	public $aBuilds      = [];
	public $aVersions    = [];
	public $aCountries   = [];
	public $aMakers      = [];
	public $aProcessors  = [];
	public $aStatuses    = [
		'O' => ['builds' => 0, 'installs' => 0], //active official builds
		'D' => ['builds' => 0, 'installs' => 0], //discontinued official builds
		'U' => ['builds' => 0, 'installs' => 0]  //unofficial builds
	];
	public $aYears       = [];  //years when devices were originally released
	public $sumBuilds = 0;      //running total of builds
	public $sumInstalls = 0;    //running total of installs
	public $unlistedInstalls;   //installs that aren't listed on stats.lineageos.org pages
	public $totalInstalls;      //total installs shown on stats.lineageos.org pages
	
	//add a build to the tally
	public function addBuild(LosBuild $oBuild) {
		$this->sumBuilds++;
		$this->sumInstalls += $oBuild->installs;
		$this->aBuilds[$oBuild->codename] = $oBuild;
		
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
			if (!isset($this->aMakers['unknown'])) {
				$this->aMakers['unknown'] = ['builds' => 0, 'installs' => 0];
			}
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
			if (!isset($this->aProcessors['unknown'])) {
				$this->aProcessors['unknown'] = ['builds' => 0, 'installs' => 0];
			}
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
			if (!isset($this->aYears['unknown'])) {
				$this->aYears['unknown'] = [$status => ['builds' => 0, 'installs' => 0]];
			}
			$this->aYears['unknown'][$status]['builds']++;
			$this->aYears['unknown'][$status]['installs'] += $oBuild->installs;
		} else {
			$year = mb_substr($oBuild->modelReleaseDate, 0, 4);
			
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
	
	//finalize the tally by calculating the percentages of the different categories, plus the number of unlisted installs
	public function finalize($totalInstalls = null) {
		
		if ($totalInstalls) {
			$this->totalInstalls = $totalInstalls;
			$this->unlistedInstalls = $totalInstalls - $this->sumInstalls;
		} else {
			$this->totalInstalls = $this->sumInstalls;
			$this->unlistedInstalls = 0;
		}
		
		foreach ($this->aMakers as $makerName => $aMaker) {
			$this->aMakers[$makerName]['percentBuilds']   = $this->aMakers[$makerName]['builds'] / $this->sumBuilds;
			$this->aMakers[$makerName]['percentInstalls'] = $this->aMakers[$makerName]['installs'] / $this->totalInstalls;
		}
		
		if ($this->unlistedInstalls) {
			$this->aMakers["Unlisted"] = [
				'maker' => 'Unlisted', 'builds' => '?', 'percentBuilds' => '?', 'installs' => $this->unlistedInstalls, 
				'percentInstalls' => $this->unlistedInstalls / $this->totalInstalls
			];
		}  
		
		$this->aMakers["Total"] = ['maker'=> 'Total', 'builds' => $this->sumBuilds, 'percentBuilds' => 1.0, 
			'installs' => $this->totalInstalls, 'percentInstalls' => 1.0];
		
		foreach ($this->aProcessors as $processorType => $aProcessor) {
			$this->aProcessors[$processorType]['percentBuilds']   = $this->aProcessors[$processorType]['builds'] / $this->sumBuilds;
			$this->aProcessors[$processorType]['percentInstalls'] = $this->aProcessors[$processorType]['installs'] / $this->totalInstalls;
		}
		
		if ($this->unlistedInstalls) {
			$this->aProcessors["Unlisted"] = [
				'name' => 'Unlisted', 'builds' => '?', 'percentBuilds' => '?', 'installs' => $this->unlistedInstalls, 
				'percentInstalls' => $this->unlistedInstalls / $this->totalInstalls
			];
		}  
		
		$this->aProcessors["Total"] = ['name' => 'Total', 'builds' => $this->sumBuilds, 'percentBuilds' => 1.0, 
			'installs' => $this->totalInstalls, 'percentInstalls' => 1.0];
		
		foreach ($this->aStatuses as $statusCode => $aStatus) {
			$this->aStatuses[$statusCode]['percentBuilds']   = $this->aStatuses[$statusCode]['builds'] / $this->sumBuilds;
			$this->aStatuses[$statusCode]['percentInstalls'] = $this->aStatuses[$statusCode]['installs'] / $this->totalInstalls;
		}
		
		if ($this->unlistedInstalls) {
			$this->aStatuses["Unlisted"] = [
				'name' => 'Unlisted', 'builds' => '?', 'percentBuilds' => '?', 'installs' => $this->unlistedInstalls, 
				'percentInstalls' => $this->unlistedInstalls / $this->totalInstalls
			];
		}  
		
		$this->aStatuses["Total"] = ['name' => 'Total', 'builds' => $this->sumBuilds, 'percentBuilds' => 1.0, 
			'installs' => $this->totalInstalls, 'percentInstalls' => 1.0];
		$totalVersions = count($this->aVersions);
		
		foreach ($this->aVersions as $version => $aVersion) {
			$this->aVersions[$version]['percentBuilds']   = $this->aVersions[$version]['builds'] / $this->sumBuilds;
			$this->aVersions[$version]['percentInstalls'] = $this->aVersions[$version]['installs'] / $this->totalInstalls;
		}
		
		if ($this->unlistedInstalls) {
			$this->aVersions["Unlisted"] = [
				'name' => 'Unlisted', 'builds' => '?', 'percentBuilds' => '?', 'installs' => $this->unlistedInstalls, 
				'percentInstalls' => $this->unlistedInstalls / $this->totalInstalls
			];
		}  
		
		$this->aVersions["Total"] = ['name' => 'Total', 'builds' => $this->sumBuilds, 'percentBuilds' => 1.0, 
			'installs' => $this->totalInstalls, 'percentInstalls' => 1.0];
		
		foreach ($this->aYears as $year => $aYear) {
			$yearBuilds = $yearInstalls = 0; //sum totals for year
			 
			foreach ($this->aYears[$year] as $status => $aStatus) {
				$this->aYears[$year][$status]['percentBuilds'] = 
					percentString( $this->aYears[$year][$status]['builds'] / $this->sumBuilds, 1);
				$this->aYears[$year][$status]['percentInstalls'] = 
					percentString( $this->aYears[$year][$status]['installs'] / $this->totalInstalls );
				$yearBuilds   += $this->aYears[$year][$status]['builds'];
				$yearInstalls += $this->aYears[$year][$status]['installs'];
			}
			
			$this->aYears[$year]['Total']['builds']          = $yearBuilds;
			$this->aYears[$year]['Total']['percentBuilds']   = $yearBuilds / $this->sumBuilds;
			$this->aYears[$year]['Total']['installs']        = $yearInstalls;
			$this->aYears[$year]['Total']['percentInstalls'] = $yearInstalls / $this->totalInstalls;
		}
		
		if ($this->unlistedInstalls) {
			$this->aYears['Unlisted'] = ['Unlisted' =>
				['builds' => '?', 'percentBuilds' => '?', 'installs' => $this->unlistedInstalls, 
				'percentInstalls' => $this->unlistedInstalls/$this->totalInstalls]
			];
		}  
		
		$this->aYears["Total"] = ['Total' => 
			['builds' => $this->sumBuilds, 'percentBuilds' => '100%', 
			'installs' => $this->totalInstalls, 'percentInstalls' => '100%']
		];
	}
	
	public function showBuilds($orderBy="installs", $order="descending") {
		$onlyShowInstalls = $GLOBALS['onlyShowInstalls'];
		$aSortBuilds = array();

		foreach ($this->aBuilds as $codename => $oBuild) {
			$index = sprintf("%07d", $oBuild->installs) ."-". $codename;
			
			$aSortBuilds[$index] = [
				'buildName'       => $oBuild->codename,
				'maker'           => $oBuild->maker, 
				'modelName'       => $oBuild->modelName,
				'processor'       => $oBuild->processor,
				'modelReleaseDate'=> $oBuild->modelReleaseDate,
				'status'          => $oBuild->status,
				'installs'        => $oBuild->installs,
				'percentInstalls' => $oBuild->installs / $this->totalInstalls
			];
		}
		
		krsort($aSortBuilds);
		
		if ($this->unlistedInstalls) {
			$aSortBuilds['Unlisted'] = [
				'buildName' => 'Unlisted', 'maker' => '', 'modelName' => '','processor' => '',
				'modelReleaseDate'=> '', 'status' => '', 'installs' => $this->unlistedInstalls,
				'percentInstalls' => $this->unlistedInstalls / $this->totalInstalls
			];
		}
		
		$aSortBuilds['Total'] = [
			'buildName' => 'Total', 'maker' => '', 'modelName' => '', 'processor' => '', 'modelReleaseDate'=> '', 
			'status' => '', 'installs' => $this->totalInstalls, 'percentInstalls' => 1.0
		];
		
		/*//add "Rank" column
		$rank = 1;
		foreach ($aSortBuilds as $key => $build) {
			$aSortBuilds[$key]['rank'] = (in_array($key, ['Unlisted', 'Total']) ? '' : $rank++); 
		}*/
		
		//add "Rank" column, but account for multiple countries having same No. of installs, so same rank  
		$rankSameNo = $rank = 1;
		$prevRankInstalls = 0;
		
		foreach ($aSortBuilds as $key => $build) { 
			//if same number of installs as the previous rank, then don't change rank number
			if ($build['installs'] != $prevRankInstalls) {
				$rankSameNo = $rank;
				$prevRankInstalls = $build['installs'];
			}
			$aSortBuilds[$key]['rank'] = (in_array($key, ['Unlisted', 'Total']) ? '' : $rankSameNo);
			$rank++;
		}
		
		$aColumns = [
			new TextCol('rank',             'Rank',         'fixed',   4, 'left',  'integer'),
			new TextCol('buildName',        'Build',        'adjust', 16, 'left',  'string' ),
			new TextCol('maker',            'Maker',        'adjust', 18, 'left',  'string' ),
			new TextCol('modelName',        'Model',        'adjust', 25, 'left',  'string' ),
			new TextCol('processor',        'Processor',    'adjust', 18, 'left',  'string' ),
			new TextCol('modelReleaseDate', 'Mod.Released', 'fixed',  12, 'left',  'string' ),
			new TextCol('status',           'Status',       'fixed',   6, 'left',  'string' ),
			new TextCol('installs',         'Installs',     'adjust',  8, 'right', 'integer'),
			new TextCol('percentInstalls',  '% Installs',   'adjust', -1, 'right', 'percent', 2)
		];
		
		if ($GLOBALS['separator'] != ' | ') {
			//if non-standard data separator, then eliminate the table borders.
			$table = new TextTable($aSortBuilds, 'LineageOS builds by number of installs', 
				$aColumns, $GLOBALS['separator'], '', '', '');
		} else {
			$table = new TextTable($aSortBuilds, 'LineageOS builds by number of installs', $aColumns);
		}
		$table->output();
		
		if (!$onlyShowInstalls) {
			print "\nStatus codes: O=active official build, D=discontinued official build, U=unofficial build\n";
		} 
		
		print PHP_EOL;
	}
	
	public function showMakers($orderBy="installs", $order="descending") {
		$aSort = [];
		
		foreach ($this->aMakers as $makerName => $aMaker) {
			if ($makerName == 'Total' or $makerName == 'Unlisted') {
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
		
		if (isset($this->aMakers['Unlisted'])) {
			$aSort['Unlisted'] = $this->aMakers['Unlisted'];
		}
		
		$aSort['Total'] = $this->aMakers['Total'];
		
		/*//add "Rank" column
		$rank = 1;
		foreach ($aSort as $key => $aMaker) {
			$aSort[$key]['rank'] = (in_array($key, ['Unlisted', 'Total']) ? '' : $rank++); 
		}*/
		
		//add "Rank" column, but account for multiple countries having same No. of installs, so same rank  
		$rankSameNo = $rank = 1;
		$prevRankInstalls = 0;
		
		foreach ($aSort as $key => $aMaker) { 
			//if same number of installs as the previous rank, then don't change rank number
			if ($aMaker['installs'] != $prevRankInstalls) {
				$rankSameNo = $rank;
				$prevRankInstalls = $aMaker['installs'];
			}
			$aSort[$key]['rank'] = (in_array($key, ['Unlisted', 'Total']) ? '' : $rankSameNo);
			$rank++;
		}
		
		$aColumns = [
			new TextCol('rank',   'Rank',  'fixed',   4, 'left',  'integer'),
			new TextCol('maker',  'Maker', 'adjust', 20, 'left',  'string' ),
			new TextCol('builds', 'Builds','adjust',  6, 'right', 'integer')
		];
		
		if ($GLOBALS['onlyShowInstalls']) {
			$aColumns[] = new TextCol('installs', 'Installs', 'adjust',  8, 'right', 'integer');
		} else {
			$aColumns[] = new TextCol('percentBuilds',  '% Builds',  'adjust', -1, 'right', 'percent', 1);
			$aColumns[] = new TextCol('installs',       'Installs',  'adjust',  8, 'right', 'integer');
			$aColumns[] = new TextCol('percentInstalls','% Installs','adjust', -1, 'right', 'percent', 2);
		}
		
		if ($GLOBALS['separator'] != ' | ') {
			//if non-standard data separator, then eliminate the table borders.
			$table = new TextTable($aSort, 'Manufacturers of devices that run LineageOS', $aColumns,
				$GLOBALS['separator'], '', '', '');
		} else {
			$table = new TextTable($aSort, 'Manufacturers of devices that run LineageOS', $aColumns);
		}
		$table->output();
		
		echo PHP_EOL;
	}
	
	public function showProcessors($orderBy="installs", $order="descending") {
		$aSort = [];
		
		foreach ($this->aProcessors as $processorType => $aProcessor) {
			if ($processorType == 'Total' or $processorType == 'Unlisted') {
				continue;
			}
			$aProcessor["name"] = $processorType;
			$idx = $orderBy ? $aProcessor[$orderBy] : $processorType; 
			
			$aSort[$idx] = [
				'name'            => $processorType,
				'builds'          => $aProcessor['builds'], 
				'percentBuilds'   => $aProcessor['percentBuilds'],
				'installs'        => $aProcessor['installs'],
				'percentInstalls' => $aProcessor['percentInstalls']
			];
		}
		
		if ($order == "descending") {
			krsort($aSort);
		} else {
			ksort($aSort);
		}
		
		if (isset($this->aProcessors['Unlisted'])) {
			$aSort['Unlisted'] = $this->aProcessors['Unlisted'];
		}
		$aSort['Total'] = $this->aProcessors['Total'];
		
		/*//add "Rank" column
		$rank = 1;
		foreach ($aSort as $key => $aMaker) {
			$aSort[$key]['rank'] = (in_array($key, ['Unlisted', 'Total']) ? '' : $rank++); 
		}*/
		
		//add "Rank" column, but account for multiple processors having same No. of installs, so same rank  
		$rankSameNo = $rank = 1;
		$prevRankInstalls = 0;
		
		foreach ($aSort as $key => $aMaker) { 
			//if same number of installs as the previous rank, then don't change rank number
			if ($aMaker['installs'] != $prevRankInstalls) {
				$rankSameNo = $rank;
				$prevRankInstalls = $aMaker['installs'];
			}
			$aSort[$key]['rank'] = (in_array($key, ['Unlisted', 'Total']) ? '' : $rankSameNo);
			$rank++;
		}
		
		$aColumns = [
			new TextCol('rank',   'Rank',           'fixed',   4, 'left',  'integer'),
			new TextCol('name',   'Processor Type', 'adjust', 20, 'left',  'string' ),
			new TextCol('builds', 'Builds',         'adjust',  6, 'right', 'integer')
		];
		
		if ($GLOBALS['onlyShowInstalls']) {
			$aColumns[] = new TextCol('installs', 'Installs', 'adjust',  8, 'right', 'integer');
		} else {
			$aColumns[] = new TextCol('percentBuilds',  '% Builds',  'adjust', -1, 'right', 'percent', 1);
			$aColumns[] = new TextCol('installs',       'Installs',  'adjust',  8, 'right', 'integer');
			$aColumns[] = new TextCol('percentInstalls','% Installs','adjust', -1, 'right', 'percent', 2);
		}
		
		if ($GLOBALS['separator'] != ' | ') {
			//if non-standard data separator, then eliminate the table borders.
			$table = new TextTable($aSort, 'Processors of devices that run LineageOS', $aColumns,
				$GLOBALS['separator'], '', '', '');
		} else {
			$table = new TextTable($aSort, 'Processors of devices that run LineageOS', $aColumns);
		}
		$table->output();
		
		echo PHP_EOL;
	}
	
	public function showStatuses() {
		foreach ($this->aStatuses as $status => $aItem) {
			$this->aStatuses[$status]['name'] = $status;
		}
		
		$aColumns = [
			new TextCol('name',   'Status', 'adjust', -1, 'left',  'string' ),
			new TextCol('builds', 'Builds', 'adjust',  6, 'right', 'integer')
		];
		
		if ($GLOBALS['onlyShowInstalls']) {
			$aColumns[] = new TextCol('installs', 'Installs', 'adjust',  8, 'right', 'integer');
		} else {
			$aColumns[] = new TextCol('percentBuilds',  '% Builds',  'adjust', -1, 'right', 'percent', 1);
			$aColumns[] = new TextCol('installs',       'Installs',  'adjust',  8, 'right', 'integer');
			$aColumns[] = new TextCol('percentInstalls','% Installs','adjust', -1, 'right', 'percent', 2);
		}
		
		if ($GLOBALS['separator'] != ' | ') {
			//if non-standard data separator, then eliminate the table borders.
			$table = new TextTable($this->aStatuses, 'Status of LineageOS builds', $aColumns,
				$GLOBALS['separator'], '', '', '');
		} else {
			$table = new TextTable($this->aStatuses, 'Status of LineageOS builds', $aColumns);
		}
		$table->output();
		
		echo PHP_EOL;
	}
	
	public function showVersions($orderBy="installs", $order="descending") {
		$aSort = [];
		
		foreach ($this->aVersions as $versionNo => $aItem) {
			if ($versionNo == 'Total' or $versionNo == 'Unlisted') {
				continue;
			}
			$idx = $orderBy ? $aItem[$orderBy] : $versionNo; 
			$aSort[$idx] = [
				'name'            => $versionNo,
				'builds'          => $aItem['builds'], 
				'percentBuilds'   => $aItem['percentBuilds'],
				'installs'        => $aItem['installs'],
				'percentInstalls' => $aItem['percentInstalls']
			];
		}
		
		if ($order == "descending") {
			krsort($aSort);
		} else {
			ksort($aSort);
		}
		
		if (isset($this->aVersions['Unlisted'])) {
			$aSort['Unlisted'] = $this->aVersions['Unlisted'];
		}
		$aSort['Total'] = $this->aVersions['Total'];
		
		/*//add "Rank" column
		$rank = 1;
		foreach ($aSort as $key => $aItem) {
			$aSort[$key]['rank'] = (in_array($key, ['Unlisted', 'Total']) ? '' : $rank++); 
		}*/
		
		//add "Rank" column, but account for multiple items having same No. of installs, so same rank  
		$rankSameNo = $rank = 1;
		$prevRankInstalls = 0;
		
		foreach ($aSort as $key => $aItem) { 
			//if same number of installs as the previous rank, then don't change rank number
			if ($aItem['installs'] != $prevRankInstalls) {
				$rankSameNo = $rank;
				$prevRankInstalls = $aItem['installs'];
			}
			$aSort[$key]['rank'] = (in_array($key, ['Unlisted', 'Total']) ? '' : $rankSameNo);
			$rank++;
		}
		
		$aColumns = [
			new TextCol('rank',   'Rank',    'fixed',   4, 'left',  'integer'),
			new TextCol('name',   'Version', 'adjust', -1, 'left',  'string' ),
			new TextCol('builds', 'Builds',  'adjust',  6, 'right', 'integer')
		];
		
		if ($GLOBALS['onlyShowInstalls']) {
			$aColumns[] = new TextCol('installs', 'Installs', 'adjust',  8, 'right', 'integer');
		} else {
			$aColumns[] = new TextCol('percentBuilds',  '% Builds',  'adjust', -1, 'right', 'percent', 0);
			$aColumns[] = new TextCol('installs',       'Installs',  'adjust',  8, 'right', 'integer');
			$aColumns[] = new TextCol('percentInstalls','% Installs','adjust', -1, 'right', 'percent', 2);
		}
		
		if ($GLOBALS['separator'] != ' | ') {
			//if non-standard data separator, then eliminate the table borders.
			$table = new TextTable($aSort, 'LineageOS versions in active installs', $aColumns,
				$GLOBALS['separator'], '', '', '');
		} else {
			$table = new TextTable($aSort, 'LineageOS versions in active installs', $aColumns);
		}
		$table->output();
		
		echo PHP_EOL;
	}
	
	//show years when devices running LineageOS were released
	//sort by year
	public function showYears() {
		$aSort = $this->aYears;
		foreach ($this->aYears as $key => $aYear) {
			if (!is_numeric($key)) {
				unset($aSort[$key]);
			}
		}
		
		ksort($aSort);
		
		if (isset($this->aYears['unknown'])) {
			$aSort['unknown'] = $this->aYears['unknown'];
		}
		if (isset($this->aYears['Unlisted'])) {
			$aSort['Unlisted'] = $this->aYears['Unlisted'];
		}
		$aSort['Total'] = $this->aYears['Total'];
		
		$aOutput = [];
		
		foreach ($aSort as $year => $aYear) {
			foreach ($aYear as $status => $aStatus) {
				$aOutput[] = [
					'year'           => $year,
					'status'         => $status,
					'builds'         => $aStatus['builds'],
					'percentBuilds'  => $aStatus['percentBuilds'],
					'installs'       => $aStatus['installs'],
					'percentInstalls'=> $aStatus['percentInstalls']
				];
			}
		}
		
		$aColumns = [
			new TextCol('year',   'Year',    'adjust',  -1, 'left',  'integer'),
			new TextCol('status', 'Status',  'adjust', -1,  'left',  'string' ),
			new TextCol('builds', 'Builds',  'adjust',  6,  'right', 'integer')
		];
		
		if ($GLOBALS['onlyShowInstalls']) {
			$aColumns[] = new TextCol('installs', 'Installs', 'adjust',  8, 'right', 'integer');
		} else {
			$aColumns[] = new TextCol('percentBuilds',  '% Builds',  'adjust', -1, 'right', 'percent', 1);
			$aColumns[] = new TextCol('installs',       'Installs',  'adjust',  8, 'right', 'integer');
			$aColumns[] = new TextCol('percentInstalls','% Installs','adjust', -1, 'right', 'percent', 2);
		}
		
		if ($GLOBALS['separator'] != ' | ') {
			//if non-standard data separator, then eliminate the table borders.
			$table = new TextTable($aOutput, 'Years when devices running LineageOS were released', $aColumns,
				$GLOBALS['separator'], '', '', '');
		} else {
			$table = new TextTable($aOutput, 'Years when devices running LineageOS were released', $aColumns);
		}
		$table->output();
		
		echo PHP_EOL;
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
	global $countryData, $buildData, $verbose;
	
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
		($GLOBALS['OS'] == "unix-like" ? ". Press 'b' to break downloads.\n\n": '...'.PHP_EOL.PHP_EOL);
	
	foreach($aDivCountries as $divCountry) {
		if ($GLOBALS['OS'] == "unix-like") {
			//check if user presses "b" to break downloading
			$char = fgetc($stdin);
			if ($breakDownloads or $char == 'b') {
				print "Breaking downloads and showing results for ".count($tally->aBuilds).
					" builds.".PHP_EOL.PHP_EOL;
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
		
		$ctryPage = new simple_html_dom();
		$url = 'https://stats.lineageos.org/country/' . $countryCode;
		
		if ($verbose) {
			print sprintf('%-32s', "Get country #$ctryCount $countryCode:");
		}
		
		$ctryPage->load_file($url);
		
		if ($verbose) {
			print sprintf('%8d', $countryInstalls).PHP_EOL;
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
			
			$buildCode = $divBuild->find("span.leaderboard-left a", 0)->innertext();
			
			if (isset($tally->aBuilds[$buildCode])) {
				continue;
			}
			
			if ($verbose) {  
				print sprintf('%-32s', "Get build #". (count($tally->aBuilds)+1) ." $buildCode:");
			}
			
			$oBuild = new LosBuild($buildCode);
			
			retry:
			try {
				$oBuild->downloadInfo();
				$tally->addBuild($oBuild);
				
				if ($verbose) {
					print sprintf('%8d', $oBuild->installs) . "\n";
				}
			}
			catch (Exception $e) {
				print "Unable to download web page for build '$buildCode'.".PHP_EOL.
				"Press 'd' to continue downloading or 'b' to break downloads and generate report.".PHP_EOL;
				
				while (true) {
					usleep(200000);
					$char = fgetc($stdin);
					//check if user presses "b" to break downloading
					if ($char == 'b' or $char == 'B') {
						$breakDownloads = true;
						break;
					} 
					elseif ($char == 'd' or $char == 'D') {
						goto retry;
					}
				}
			}
		}
	}
	//reset the terminal to function normally:
	system('stty sane');
	fclose($stdin);
	
	$tally->finalize($worldDownloads);
	$tally->showBuilds();
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
			$installsPerMillion = ($countryPop) ? $countryInstalls/($countryPop/1000) : '';  
			
			$aCountries[$idx] = [
				'countryCode'       => $countryCode, 
				'countryName'       => $countryData[$countryCode][0], 
				'installs'          => $countryInstalls,
				'percentInstalls'   => $countryInstalls/$worldDownloads, 
				'installsPerMillion'=> $installsPerMillion, 
				'countryPop'        => $countryPop
			];
		}
		else {
			$aCountries[$idx] = [
				'countryCode'       => $countryCode, 
				'countryName'       => '', 
				'installs'          => $countryInstalls,
				'percentInstalls'   => $countryInstalls/$worldDownloads, 
				'installsPerMillion'=> '', 
				'countryPop'        => ''
			];	
		}
	}
	
	//Add world total:
	$worldInstallsPerMillion = $worldDownloads/($countryData['World'][1]/1000);
	$aCountries[' World'] = [
		'countryCode'       => 'World', 
		'countryName'       => 'World', 
		'installs'          => $worldDownloads, 
		'percentInstalls'   => '100%', 
		'installsPerMillion'=> $worldInstallsPerMillion, 
		'countryPop'        => $countryData['World'][1]
	];
	
	//stats.lineageos.org uses multiple codes for 4 countries, so add both 
	//codes for those countries and eliminate the non-standard ISO codes
	mergeTwoCountries('IS', 'IC', $aCountries);
	mergeTwoCountries('GB', 'UK', $aCountries);
	mergeTwoCountries('BJ', 'DY', $aCountries);
	mergeTwoCountries('CZ', 'XC', $aCountries);  
	
	krsort($aCountries);
	
	//add "Rank" column, but account for multiple countries having same No. of installs, so same rank  
	$rankSameNo = $rank = 1;
	$prevRankInstalls = 0;
	 
	foreach ($aCountries as $i => $aCountry) {
		//if same number of installs as the previous rank, then don't change rank number
		if ($aCountry['installs'] != $prevRankInstalls) {
			$rankSameNo = $rank;
			$prevRankInstalls = $aCountry['installs'];
		}
		$aCountries[$i]['rank'] = ($aCountry['countryCode'] =='World') ? '' : $rankSameNo;
		$rank++; 
	}
	
	$aColumns = [
		new TextCol('rank',              'Rank',       'fixed',   4, 'left',  'integer'),
		new TextCol('countryCode',       'CC',         'adjust', -1, 'left',  'string' ),
		new TextCol('countryName',       'Country',    'adjust', 22, 'left',  'string' ),
		new TextCol('installs',          'Installs',   'adjust',  8, 'right', 'integer'),
		new TextCol('percentInstalls',   '% Installs', 'adjust', -1, 'right', 'percent', 2),
		new TextCol('installsPerMillion','Installs/M', 'adjust', -1, 'right', 'decimal', 0),
		new TextCol('countryPop',        'Pop. (000)', 'adjust', -1, 'right', 'decimal', 2)
	];
	
	if ($GLOBALS['separator'] != ' | ') {
		//if non-standard data separator, then eliminate the table borders.
		$table = new TextTable($aCountries, 'Countries by number of LineageOS installs', $aColumns,
			$GLOBALS['separator'], '', '', '');
		/*/don't truncate data if using non-standard separator:
		foreach ($table->aCols as $key=> $oCol) {
			$table->aCols[$key]->maxWidth = -1;
		}*/
	} else {
		$table = new TextTable($aCountries, 'Countries by number of LineageOS installs', $aColumns);
	}
	
	$table->output();
	echo PHP_EOL;
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
	$aCountryInfo['installs'] = $aCountryInfo['installs'] + $aCountries[$eraseKey]['installs']; //sum installs from two country codes 
	$idx = sprintf("%07d", $aCountryInfo['installs']) ."-". $countryToKeep;
	$percentOfTotal = sprintf("%.2f", ($aCountryInfo['installs']/$aCountries[' World']['installs'])*100) . "%"; 
	$aCountryInfo['installsPerMillion'] = ($aCountryInfo['countryPop']) ? round($aCountryInfo['installs']/($aCountryInfo['countryPop']/1000)) : '';
	
	unset($aCountries[$keepKey]);
	unset($aCountries[$eraseKey]);
	$aCountries[$idx] = $aCountryInfo;
}

function showOneCountry($country) {
	global $countryData, $buildData, $onlyShowInstalls;
	$aProcessors = [];
	$aMakers = [];
	$aBuilds = [];
	$aBuildList = [];
	$tally = new Tally();
	$country = trim($country);
	
	//if not a 2 letter country code, then search to see if in list of countries. 
	if (mb_strlen($country) != 2) {
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
	
	foreach ($aDivBuilds as $divBuild) {
		$codename = $divBuild->find("span.leaderboard-left a", 0)->innertext();
		$installs = $divBuild->find("span.leaderboard-right", 0)->innertext();
		$runningTotal += $installs;
		
		if (isset($buildData[$codename])) {
			$maker = $buildData[$codename]->maker;
			
			$aBuildList[] = [
				'buildName'       => $codename,
				'maker'           => $buildData[$codename]->maker,
				'modelName'       => $buildData[$codename]->modelName,
				'processor'       => $buildData[$codename]->processor,
				'modelReleaseDate'=> $buildData[$codename]->modelReleaseDate,
				'status'          => $buildData[$codename]->status,
				'installs'        => $installs,
				'percentInstalls' => $installs/$countryInstalls
			]; 
			
			if (!isset($aMakers[$maker])) {
				$aMakers[$maker] = array('builds' => 0, 'installs'=> 0);
			}
			
			$aMakers[$maker]['builds']++;
			$aMakers[$maker]['installs'] += $installs;
			
			$aBuilds[$codename] = new LosBuild($codename);
			$aBuildInfo = ['codename' => $codename, 'installs' => $installs];
			$aBuilds[$codename]->setInfo($aBuildInfo);
			$tally->addBuild($aBuilds[$codename]);
		}
		else {
			$aBuildList[] = [
				'buildName'       => $codename,
				'maker'           => null,
				'modelName'       => null,
				'processor'       => null,
				'modelReleaseDate'=> null,
				'status'          => 'U',
				'installs'        => $installs,
				'percentInstalls' => $installs/$countryInstalls
			];
		}
	} 
	 
	$otherBuilds = $countryInstalls - $runningTotal;
	
	if ($otherBuilds > 0) {
		$aBuildList[] = [
			'buildName'       => 'Unlisted',
			'maker'           => null,
			'modelName'       => null,
			'processor'       => null,
			'modelReleaseDate'=> null,
			'status'          => '',
			'installs'        => $otherBuilds,
			'percentInstalls' => $otherBuilds/$countryInstalls
		];
	}
	
	$aBuildList[] = [
		'buildName'       => 'Total',
		'maker'           => null,
		'modelName'       => null,
		'processor'       => null,
		'modelReleaseDate'=> null,
		'status'          => '',
		'installs'        => $countryInstalls,
		'percentInstalls' => 1.0
	];
	
	//add "Rank" column
	/*$rank = 1;
	foreach ($aBuildList as $i => $aItem) {
		$aBuildList[$i]['rank'] = (in_array($aItem['buildName'], ['Unlisted', 'Total']) ? '' : $rank++); 
	}*/
	
	//add "Rank" column, but account for multiple items having same No. of installs, so same rank  
	$rankSameNo = $rank = 1;
	$prevRankInstalls = 0;
	
	foreach ($aBuildList as $i => $aItem) { 
		//if same number of installs as the previous rank, then don't change rank number
		if ($aItem['installs'] != $prevRankInstalls) {
			$rankSameNo = $rank;
			$prevRankInstalls = $aItem['installs'];
		}
		$aBuildList[$i]['rank'] = (in_array($aItem['buildName'], ['Unlisted', 'Total']) ? '' : $rankSameNo);
		$rank++;
	}
	
	$aColumns = [
		new TextCol('rank',             'Rank',         'fixed',   4, 'left',  'integer'),
		new TextCol('buildName',        'Build',        'adjust', 16, 'left',  'string' ),
		new TextCol('maker',            'Maker',        'adjust', 18, 'left',  'string' ),
		new TextCol('modelName',        'Model',        'adjust', 25, 'left',  'string' ),
		new TextCol('processor',        'Processor',    'adjust', 18, 'left',  'string' ),
		new TextCol('modelReleaseDate', 'Mod.Released', 'fixed',  12, 'left',  'string' ),
		new TextCol('status',           'Status',       'fixed',   6, 'left',  'string' ),
		new TextCol('installs',         'Installs',     'adjust',  8, 'right', 'integer'),
		new TextCol('percentInstalls',  '% Installs',   'adjust', -1, 'right', 'percent', 2)
	];
		
	if ($GLOBALS['separator'] != ' | ') {
		//if non-standard data separator, then eliminate the table borders.
		$table = new TextTable($aBuildList, 'LineageOS builds by number of installs', 
			$aColumns, $GLOBALS['separator'], '', '', '');
	} else {
		$table = new TextTable($aBuildList, 'LineageOS builds by number of installs', $aColumns);
	}
	$table->output();
	
	echo PHP_EOL, 'Status codes: O=active official build, D=discontinued official build, U=unofficial build', 
		PHP_EOL, PHP_EOL;
	
	$tally->finalize($countryInstalls);
	$tally->showMakers();
	$tally->showProcessors();
	$tally->showStatuses();
	$tally->showYears();
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
	$aCountries = [];
	
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
				$aModels = [];
				$aMakerModels = [];
				
				foreach (preg_split('/\s*,\s*/', $oBuild->modelName) as $model) {
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
				$aModels = [];
				$aMakerModels = [];
				
				foreach (preg_split('/\s*,\s*/', $oBuild->modelName) as $model) {
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
			$buildData[$buildCode]->modelName ."\n".
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
	
	foreach ($aDivBuilds as $divBuild) {
		$countryCode = $divBuild->find("span.leaderboard-left a", 0)->innertext();
		$installs = $divBuild->find("span.leaderboard-right", 0)->innertext();
		$runningTotal += $installs;
		$percentInstalls = percentString($installs/$buildInstalls);
		
		if (isset($countryData[$countryCode])) {
			$countryName = $countryData[$countryCode][0];
			
			$aCountries[] = [
				'countryCode'       => $countryCode,
				'countryName'       => $countryName,
				'installs'          => $installs,
				'percentInstalls'   => $installs/$buildInstalls, 
				'installsPerMillion'=> $installs/($countryData[$countryCode][1]/1000)
			];
		}
		else {
			$aCountries[] = [
				'countryCode'       => $countryCode,
				'countryName'       => '',
				'installs'          => $installs,
				'percentInstalls'   => $installs/$buildInstalls, 
				'installsPerMillion'=> ''
			];
		}
	}
	
	//add "Rank" column, but account for multiple countries having same No. of installs, so same rank  
	$rankSameNo = $rank = 1;
	$prevRankInstalls = 0;
	 
	foreach ($aCountries as $i => $aCountry) {
		//if same number of installs as the previous rank, then don't change rank number
		if ($aCountry['installs'] != $prevRankInstalls) {
			$rankSameNo = $rank;
			$prevRankInstalls = $aCountry['installs'];
		}
		$aCountries[$i]['rank'] = $rankSameNo;
		$rank++; 
	}
	
	$aColumns = [
		new TextCol('rank',               'Rank',      'fixed',   4, 'left',  'integer'),
		new TextCol('countryCode',        'CC',        'adjust', -1, 'left',  'string' ),
		new TextCol('countryName',        'Country',   'adjust', 18, 'left',  'string' ),
		new TextCol('installs',           'Installs',  'adjust',  8, 'right', 'integer'),
		new TextCol('percentInstalls',    '% Installs','adjust', -1, 'right', 'percent', 2),
		new TextCol('installsPerMillion', 'Installs/M','adjust', -1, 'right', 'decimal', 1)
	];
		
	if ($GLOBALS['separator'] != ' | ') {
		//if non-standard data separator, then eliminate the table borders.
		$table = new TextTable($aCountries, 'LineageOS installs for the build per country', 
			$aColumns, $GLOBALS['separator'], '', '', '');
	} else {
		$table = new TextTable($aCountries, 'LineageOS installs for the build per country', $aColumns);
	}
	$table->output();
	
	echo PHP_EOL;
}

//make string of a percent with the number of decimal digits depending on the number. 
//If not a very small number, the default number of decimal digits is set by $precision. 
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

//make string of a number where the number of decimal digits depends on the number. 
//If not a very small number, the default number of decimal digits is set by $precision. 
function decimalString($num, $precision = 2) {
	if ($num == 0) {
		return '0';  
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
	
	while ($num < $aMinNumbers[$precision] and $precision < 10) {
		$precision++;
	}
	 
	return sprintf('%.'.$precision.'f', $num);
}



?>

<?php
$buildData = [];
$buildsFilename = 'buildsList.txt'; 
$aBuildCols = ['codename', 'maker', 'modelName', 'processor', 'modelReleaseDate', 
	'status', 'installs', 'percentInstalls', 'links', 'notes'];
$cntImports = 0; //count imported builds
$cntLines = 0;   //count lines in buildList.txt


//data in buildList.txt is separated by tabs and first line contains the column headers
$aBuildsTabs = file($buildsFilename, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES) or 
	die ("Error: Unable to open file '$buildsFilename'.".PHP_EOL);

foreach ($aBuildsTabs as $buildLine) {
	//skip the first line
	if ($cntLines++ == 0) {
		continue;
	}
	$aData = preg_split("/ *\t */", $buildLine);
	
	//if not 10 data columns
	if (count($aData) !=  10) {
		print "Error in build line $cntLine:".PHP_EOL.$buildLine.PHP_EOL;
		continue;
	}
	$aBuild = array_combine($aBuildCols, $aData);
	
	if ($aBuild['maker'] or $aBuild['modelName'] or $aBuild['processor']) {
		$buildData[ $aBuild['codename'] ] = new LosBuild(
			$aBuild['codename'],
			$aBuild['maker'], 
			$aBuild['modelName'],
			$aBuild['processor'],
			$aBuild['modelReleaseDate'],
			$aBuild['status']
		);
		$cntImports++;
	}
}

if ($GLOBALS['verbose']) {
	print "Imported $cntImports builds.".PHP_EOL;
}

$GLOBALS['buildData'] = $buildData;

?>

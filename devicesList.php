<?php
/* devicesList.php gets the list of builds/devices from the buildsList.txt file, 
 * which is a tab separated value file.
 * If the --update-devices option was selected, it updates the list of
 * of LineageOS builds/devices from the
 * https://github.com/LineageOS/lineage_wiki/tree/master/_data/devices
 * directory, so their information can be used by the lineageos_stats.php 
 * script. 
 * 
 * Author: Amos Batto (amosbatto[AT]yahoo.com)
 * License: MIT (c) 2025 Amos Becker Batto
*/

$buildData = [];
$buildsFilename = 'buildsList.txt'; 
$aBuildCols = ['codename', 'maker', 'modelName', 'processor', 'modelReleaseDate', 
	'status', 'installs', 'officialVersions', 'links', 'notes'];
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
	
	//if not the right number of data columns in line in buildsList.txt file:
	if (count($aData) != count($aBuildCols)) {
		throw new Exception("Error in build line $cntLine:".PHP_EOL.$buildLine.PHP_EOL);
	}
	
	$aBuild = array_combine($aBuildCols, $aData);
	
	//if ($aBuild['maker'] or $aBuild['modelName'] or $aBuild['processor']) {
		$buildData[ $aBuild['codename'] ] = new LosBuild(
			$aBuild['codename'],
			$aBuild['maker'], 
			$aBuild['modelName'],
			$aBuild['processor'],
			$aBuild['modelReleaseDate'],
			$aBuild['status'],
			json_decode($aBuild['officialVersions']),
			$aBuild['links'],
			$aBuild['notes']
		);
		$cntImports++;
	//}
}

if (VERBOSE) {
	print "Imported $cntImports builds.".PHP_EOL;
}

$GLOBALS['buildData'] = $buildData;

/* There are three discrepancies in the build variants, so the update builds uses
 * the more common variant. 
 * 1. alphaplus_variant1 (G8 ThinQ [LM-G820UM, LM-G820QM]) supports versions 20 and 21, 
 *    but alphaplus_variant2 (G8 ThinQ (Korea)) only supports versions 21.
 * 2. lmi_variant1 (POCO F2 Pro) and lmi_variant2 (Redmi K30 Pro) 
 *    are active builds with a maintainer (versions 18.1, 19.1, 20, 21, 22.1, 22.2),
 *    whereas lmi_variant3 (Redmi K30 Pro Zoom Edition) is discontinued 
 *    and only versions 18.1, 19.1 and 20 were official.
 * 3. quill_tab_variant1 (Jetson TX2 [Tablet]) supports versions 17.1, 21, 22.1, 22.2, 
 *    but quill_tab_variant2 (Jetson TX2 NX [Tablet]) supports versions 17.1, 20, 21, 22.1, 22.2.
 */ 
if (UPDATE_BUILDS) {
	$devicesDirUrl = 'https://github.com/LineageOS/lineage_wiki/tree/3d8f6bec90670564163254b5e065f52245b5539a/_data/devices';
	$aBuildsDir = [];
	$aSkipBuilds = ['alphaplus_variant1.yml', 'alphaplus_variant2.yml', 'quill_tab_variant1.yml', 'lmi_variant3.yml'];
	
	$devicesDirPage = new simple_html_dom();
	
	retryDownload:
	while ($devicesDirPage->load_file($devicesDirUrl) === false) {
		continue;
	}
	
	try {
		$data  = $devicesDirPage->find('script[data-target=react-app.embeddedData]', 0);
		$aFiles = json_decode($data->innertext)->payload->tree->items;
	}
	catch (Exception $e) {
		print $e->getMessage() .PHP_EOL.'Retrying download...'.PHP_EOL;
		goto retryDownload;
	}
	
	foreach ($aFiles as $oFile) {
		$filename = $oFile->name;
		$isVariant = false;
		
		if (in_array($filename, $aSkipBuilds)) {
			continue;
		}
		
		if (preg_match('/^(.+?)_variant(\d).yml$/', $filename, $match)) {
			$buildCode = $match[1];
			$isVariant = true;
		}
		elseif (preg_match('/^(.+?).yml$/', $filename, $match)) {
			$buildCode = $match[1];
		}
		else {
			throw new Exception('Bad filename: '. $filename .PHP_EOL);
		}
		
		$buildFileUrl = 'https://raw.githubusercontent.com/LineageOS/lineage_wiki/refs/heads/main/_data/devices/'.$filename;
		
		do {
			$buildYaml = file_get_contents($buildFileUrl);
		} while ($buildYaml === false);
		
		$aBuildInfo = yaml_parse($buildYaml);
		
		$status = empty($aBuildInfo['maintainers']) ? 'D' : 'O';
		
		$releaseDate = $aBuildInfo['release'];
		
		if (is_array($releaseDate)) {
			$aDates = [];
			
			foreach ($releaseDate as $date) {
				$aDates[] = reset($date);
			}
			$releaseDate = min($aDates);
		}
		
		if (preg_match('/^\d{4}\-\d{2}$/', $releaseDate)) {
			$releaseDate .= '-01';
		}
		
		if (!isset($buildData[$buildCode])) {
			if (preg_match('/^\d{4}$/', $releaseDate)) {
				$releaseDate .= '-06-01';
				print "Need to manually change the model release date '$releaseDate' ".
					"for build '$buildCode' ({$aBuildInfo['vendor']} {$aBuildInfo['name']}) ".
					"in the buildsList.txt file.".PHP_EOL;
			}
			
			$buildData[$buildCode] = new LosBuild(
				$buildCode,
				$aBuildInfo['vendor'], 
				$aBuildInfo['name'],
				$aBuildInfo['soc'],
				$releaseDate,
				$status,
				$aBuildInfo['versions']
			);
			
			if (VERBOSE) {
				print "Added new build '$buildCode' for {$aBuildInfo['vendor']} {$aBuildInfo['name']}.".PHP_EOL; 
			}
		}
		
		if (!isset($buildData[$buildCode]->officialVersions) or empty($buildData[$buildCode]->officialVersions)) {
			$buildData[$buildCode]->officialVersions = $aBuildInfo['versions'];
			if (VERBOSE) {
				print "Added official versions to build '$buildCode'.".PHP_EOL; 
			}
		}
		elseif ($buildData[$buildCode]->officialVersions != $aBuildInfo['versions']) {
			$buildData[$buildCode]->officialVersions = $aBuildInfo['versions'];
			if (VERBOSE) {
				print "Changed official versions for build '$buildCode'.".PHP_EOL; 
			}
		}
		
		if ($buildData[$buildCode]->status != $status) {
			if (VERBOSE) {
				print "Changed status from {$buildData[$buildCode]->status} to $status for build '$buildCode'.".PHP_EOL; 
			}
			$buildData[$buildCode]->status = $status;
		}
		
		if ($isVariant) {
			// add the variant model name to the end of the modelName if not already in the modelName
			if (stripos($buildData[$buildCode]->modelName, $aBuildInfo['name']) === false) {
				$buildData[$buildCode]->modelName .= ', '.$aBuildInfo['name'];
				if (VERBOSE) {
					print "Added model variant '{$aBuildInfo['name']}' to build '$buildCode'." . PHP_EOL; 
				}
			}
			// update the model release date if variant was released earlier
			if ($buildData[$buildCode]->modelReleaseDate > $releaseDate) {
				$buildData[$buildCode]->modelReleaseDate = $releaseDate;
				
				if (VERBOSE) {
					print "Updated model release date to '$releaseDate' for build '$buildCode'." . PHP_EOL; 
				}
			}
		}
	}
	
	$GLOBALS['buildData'] = $buildData;
}



//write updated build info to text file with data separated by tabs
function writeBuildsToFile($filename) {
	//rewrite buildsList.txt file with updated data:
	$headers = "Build\tMaker\tModel\tProcessor\tModel Released\tStatus\tInstalls\tOffical Versions\tLinks\tNotes\n";
	
	$fileBuildsList = fopen($filename, 'w') or 
		die("Error: Unable to open file '$filename' for writing.".PHP_EOL);
	
	fwrite($fileBuildsList, $headers);
	$cntBuilds = 0;
	$aEmptyBuilds = [];
	
	foreach ($GLOBALS['buildData'] as $build) {
		$versionsJson = empty($build->officialVersions) ? '' : json_encode($build->officialVersions);
		$line = $build->codename."\t".$build->maker."\t".$build->modelName."\t".
			$build->processor."\t".$build->modelReleaseDate."\t".$build->status."\t".
			$build->installs."\t".$versionsJson."\t".$build->links."\t".$build->notes."\n";
		fwrite($fileBuildsList, $line);
		$cntBuilds++;
		
		if (empty($build->maker) and empty($build->modelName) and empty($build->processor)) {
			$aEmptyBuilds[] = $build->codename;
		}
	}
	
	fclose($fileBuildsList);
	
	if (VERBOSE) {
		print "Wrote $cntBuilds builds to the buildsList.txt file.".PHP_EOL;
		if (!empty($aEmptyBuilds)) {
			print "The following ".count($aEmptyBuilds)." builds are empty:".PHP_EOL;
			foreach ($aEmptyBuilds as $buildName) {
				print $buildName.PHP_EOL;
			}
		}
		print "Lookup build names in: https://storage.googleapis.com/play_public/supported_devices.html".PHP_EOL;
	}
}
?>

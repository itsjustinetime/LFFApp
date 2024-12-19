<?php 
include_once '../configuration.php';

function getPasscodesExpiry() {
	global $PATH_CONTENT;
	// read LFF passcodes into an array
	$lffCodes[]='';
	if (!empty(glob($PATH_CONTENT . '/lff-events/passcodes/*.json'))) {
			foreach (glob($PATH_CONTENT . '/lff-events/passcodes/*.json') as $key => $file) {
				$data = json_decode(file_get_contents($file));		  
				$lffCodes[]=$data; 
		}
	}
	return $lffCodes;
	
}

?>
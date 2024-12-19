<?php 
include_once '../configuration.php';

function getPasscodes() {
	$timeDate = date("Y-m-d H:i:s");
	global $PATH_CONTENT;
	// read non-expired LFF passcodes into an array
	$lffCodes[]='';
	if (!empty(glob($PATH_CONTENT . '/lff-events/passcodes/*.json'))) {
		//error_log("glob not empty");
			foreach (glob($PATH_CONTENT . '/lff-events/passcodes/*.json') as $key => $file) {
				$data = json_decode(file_get_contents($file));
					  $passcodevalue=$data->passcodevalue;
					  $passcodeexpires=str_replace("T"," ", $data->passcodeexpires);
			if ($passcodeexpires > $timeDate) { $lffCodes[]=$passcodevalue; }
		}
	}
	return $lffCodes;
	
}

?>
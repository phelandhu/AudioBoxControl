<?php
/***********************************************
* Created:            Thu 06 Sep 2012 10:10:28 AM PDT 
* Last Modified:      Thu 06 Sep 2012 10:10:28 AM PDT
*
* The PHP page of the AJAX test/demonstration, the part the HTML page talks to to get/
* send information from/to the server
*
* Mike Browne - phelandhu@gmail.com
***********************************************/
include_once("class/Util.class.php");
include_once("class/AjaxFunctions.class.php");
// read in from the url
$logFile = "/tmp/testOut.log";
file_put_contents ( $logFile, "Beginning\n");

$commandLineArgs = $_GET;
file_put_contents ( $logFile, file_get_contents($logFile) . "Command Line Arguments\n" . print_r($commandLineArgs, true) . "\n");
Util::logArray($commandLineArgs);

if(isset($commandLineArgs["method"])) {
	file_put_contents ( $logFile, file_get_contents($logFile) . "Command Line gotten\n");	
	$ajaxFunctions = new AjaxFunctions("", "/tmp");
	if($ajaxFunctions){
		file_put_contents ( $logFile, file_get_contents($logFile) . "Method: " . $commandLineArgs["method"] . "\n");
		switch ($commandLineArgs["method"]) {
			case "updateUI":
				$data = $ajaxFunctions->getCueSongData();
				echo "artist: " . $data["artist"] . "&song: " . $data["song"];
				break;
			case "updateStream":
//				Util::log($commandLineArgs["action"]);
				file_put_contents ( $logFile, file_get_contents($logFile) . "Action: " . $commandLineArgs["action"] . "\n");
				$ajaxFunctions->updateStream($commandLineArgs["action"], $commandLineArgs["file"]);
				break;
			case "setVolume":
				/*
				$response = $ajaxFunctions->setVolume($commandLineArgs["volume"]);
				echo "Volume set to " . $commandLineArgs["volume"] . "%";
				*/
				break;
			case "getVolume":
				/*
				$response = $ajaxFunctions->getVolume();
				echo "Volume set to " . $commandLineArgs["volume"] . "%";
				*/
				break;			
			default:
				break;
		}
	}
} else {
	echo "Test5";
	//header('Location: /index.php');
}
?>

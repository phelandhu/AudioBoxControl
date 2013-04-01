<?php
class AjaxFunctions {
	
	private $nonConverted = array(
			'loadfile',
			'loadlist',
			'pause',
			'quit'
	);
	

	
	public function __construct($binDir, $logDir) {

	}

	function getCueSongData() {
		// look in the logDir
		//read the file that is ices.cue
		//then grab the last two lines
		// should be the artist
		// and the track
		
		// such a cheezy way to do this, but I need this working until I can get the rest working.
		$file = fopen("/tmp/ices.cue", "r") or exit("Unable to open file!");
		//Output a line of the file until the end is reached
		$mp3Data = array();
		$i = 0;
		while(!feof($file))
		{
			
			$data = fgets($file);
			switch($i) {
				case 0:
					$mp3Data["path"] = $data;
					break;
				case 2:
					$mp3Data["bit_rate"] = $data;
					break;
				case 3:
					$mp3Data["time"] = $data;
					break;
				case 5:
					$mp3Data["track"] = $data;
					break;
				case 6:
					$mp3Data["artist"] = $data;
					break;
				case 7:
					$mp3Data["song"] = $data;
					break;
			}

			$i++;
		}
		fclose($file);
		return $mp3Data;
	}
	
	function updateStream($action, $file) {
		switch($action) {
			case "start":
				$command = "/bin/startStream " . $file;
				Util::log($command);
				file_put_contents ( "/tmp/testOut.log", file_get_contents("/tmp/testOut.log") . "Command: " . $command . "\n");
				$output = shell_exec($command);
				break;
			case "reStart":
				$output = shell_exec('/bin/stopStream');
				sleep(2);
				$command = "/bin/startStream " . $file;
				$output = shell_exec($command);
				break;
			case "stop":
				$output = shell_exec('/bin/stopStream');
				break;
			default:
				break;
		}
		return $result;
	}

	function getVolume() {
//		$result = $this->_mplayerControl->getVolume();
$result = 50;
		return $result;
	}
/*	
	function setVolume($volume) {
		$result = $this->_mplayerControl->setVolume($volume);
		return $result;
	}

	function convertCommand($pageCommand) {
		$mplayerCommand = "";
		if(in_array($pageCommand, $this->nonConverted)) {
			return $pageCommand;
		}
		if(isset($pageCommand)) {
			if($pageCommand == "pt_step-1") {
				$mplayerCommand = "pt_step -1";
			} else if ($pageCommand == "pt_step+1") {
				$mplayerCommand = "pt_step +1";
			} else if ($pageCommand == "seek-15") {
				$mplayerCommand = "seek -15";
			} else if ($pageCommand == "seek+15") {
				$mplayerCommand = "seek +15";
			} else if ($pageCommand == "volume-1") {
				$mplayerCommand = "volume -1";
			} else if ($pageCommand == "volume+1") {
				$mplayerCommand = "volume +1";
			} else if ($pageCommand == "mute1") {
				$mplayerCommand = "mute 1";
			} else if ($pageCommand == "mute0") {
				$mplayerCommand = "mute 0";
			}
		} else {
			$mplayerCommand = "";
		}
		return $mplayerCommand;
	}
*/
}
?>
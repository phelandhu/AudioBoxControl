<?php
// readFile.php
/***********************************************
* Created:            Mar 27, 2013 3:03:15 PM
* Last Modified:      Mar 27, 2013 3:03:15 PM
*
* Test file to read from the ices.cue file and give me output
*
* Mike Browne - mbrowne@cantorgaming.com
***********************************************/
include ("class/AjaxFunctions.class.php");
$ajaxFunctions = new AjaxFunctions("", "/tmp");

function mp3Data($mp3) {
	$filesize = filesize($mp3);
	$file = fopen($mp3, "r");

	fseek($file, -128, SEEK_END); // It reads the

	$tag = fread($file, 3);

	if($tag == "TAG")
	{
		$data["song"] = trim(fread($file, 30));
		$data["artist"] = trim(fread($file, 30));
		$data["album"] = trim(fread($file, 30));
		$data["year"] = trim(fread($file, 4));
		$data["comment"] = trim(fread($file, 30));
		$data["genre"] = trim(fread($file, 1));
			
	}
	else
		die("MP3 file does not have any ID3 tag!");

	fclose($file);

	while(list($key, $value) = each($data))
	{
		print("$key: $value<br>\r\n");
	}
}

$data = $ajaxFunctions->getCueSongData();
print_r($data);
echo "<br /><br />";
$mp3 = "/x/music/queen/a_kind_of_magic/queen-a_kind_of_magic-01-one_vision.mp3"; //The mp3 file.
mp3Data($mp3);
echo $data["path"] . "<br />";
mp3Data("/x/music/paul_oakenfold/resident/paul_oakenfold-resident-(disc_1)-04-shine_(full_vocal).mp3");
mp3Data($data["path"]);

mp3Data($mp3);

echo "hello";


/*
$file = fopen("/tmp/ices.cue", "r") or exit("Unable to open file!");
//Output a line of the file until the end is reached
$mp3Data = array();
while(!feof($file))
{
	$data = fgets($file); 
	echo $data . "<br>";
	$mp3Data[] = $data;
}
fclose($file);
if(isset($mp3Data[6])) {
	echo "Artist: " . $mp3Data[6] . "<br />";
}
if(isset($mp3Data[7])) {
	echo "Song: " . $mp3Data[7] . "<br />";
}
*/
<?php
// streamStart.php
/***********************************************
* Created:            Mar 26, 2013 3:36:04 PM
* Last Modified:      Mar 26, 2013 3:36:04 PM
*
* This will start the streaming server.
* Well the player of mp3 to the streaming server. That will be running all the time.
*
* Mike Browne - phelandhu@gmail.com
***********************************************/

// eventually all of this will become AJAX. Yay!
$playlist = "/x/playlists/papa_roach-lovehatetragedy.txt";
$command = "./startStream.sh " . $playlist;
$output = shell_exec($command);
?>

<?php
// index.php
/***********************************************
* Created:            Mar 26, 2013 4:44:43 PM
* Last Modified:      Mar 26, 2013 4:44:43 PM
*
* Index and main control for the Ice Control application.
*
* Mike Browne - phelandhu@gmail.com
***********************************************/
include "conf/iceControl.conf";
include "class/DisplayFunctions.class.php";
$submit='id=submit type=submit name="action"';
$displayFunctions = new DisplayFunctions();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>MyWebPlayer</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width; initial-scale=1.4; maximum-scale=1.4; user-scalable=1.4;" />
<link rel="apple-touch-icon" href="icon.png">
<meta name="apple-mobile-web-app-capable" content="yes">
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		var tid = setInterval(ajaxUpdateUI, 2000);
/*
		$("#slider").slider({ 
			max: 100,
			step: 5,
			value: 35,
			change: function(event, ui) {
				ajaxSetVolume(ui.value);
			}
		});
	
		var request = $("a").click(function(event){
	     	$.ajax({
				url: "test.php",
				type: "POST"
	 	  	});
	
			request.done(function(msg) {
				alert("Data Loaded: " + msg );
			});
			$.post("test.php", function(data) {
				alert("Data Loaded: " + data);
			})
		});
*/	
		$("#streamStart, #streamReStart, #streamStop").click(function() {
			handleClick(this);
		});
	
	 });
	function handleClick(btnObject) {
		var file = $("#fileSelection").val();

		switch(btnObject.id) {
			case "streamStart":
				ajaxUpdateStream("start", file);
				break;
			case "streamReStart":
				ajaxUpdateStream("reStart", file);
				break;
			case "streamStop":
				ajaxUpdateStream("stop", file);
				break;
			default:
				strText = "Default";
			alert(strText);
				break;			
		}

	}

	function ajaxUpdateUI(){ 
		$("#update_user").show();
		$.get("./ajax.php", {method : "updateUI"},
			function(data){
				$("#update_user").html(data);
		});
	} 
	
	/*
	function ajaxUpdateUI(){ 
		$("#update_user").show(); 
		var search_val=$("#search_term").val(); 
		$.post("./ajax.php?method=updateUI", {search_term : search_val}, function(data){
			if (data.length>0){ 
				$("#update_user").html(data); 
			}
		});
	} 
	*/
	function ajaxUpdateStream(action, file){ 
		$("#update_user").show();
		// little bit here to check and make sure that they've selected soemthing.
		var toPost = "./ajax.php?method=updateStream&action=" + action +"&file=" + file;
		$.post(toPost, function(data){
			if (data.length>0){ 
				$("#update_user").html(data); 
			}
		});
	}
</script>

</head>

<body>
<a href="#" id="streamStart">Start the playlist</a>
<br />
<a href="#" id="streamReStart">New playlist</a>
<br />
<a href="#" id="streamStop">Stop the playlist</a>
<br />

<table border="0"  align="center">
<tr><td>
<?php 

$dirList=$displayFunctions->scanDirectories($rootDir);
$mass=$displayFunctions->show_all_masks($dirList, $mask);
?>
<select id="fileSelection" name="file">
<?php
	echo $mass;
?>
</select>
</td>
</tr>
</table>
<div id="update_user"></div>
</body>
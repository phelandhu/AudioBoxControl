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

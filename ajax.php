<?php
	require_once("jate.php");
	if($_POST["action"]=="add") {
		$data = json_decode($_POST["data"],true);
		//check if exist
		$projects = subFolder("./projects");
		$success = false;
		foreach ($projects as $i)
			if($data["name"] == $i) {
				$success = true;
				break;
			}
		if(!$success) {
			//make folder
			mkdir("./projects/".$data["name"]);
			//make database
			//install JATE
				execInBackground("cd ./projects/".$data["name"]." & bower install JATE ");
			//set git
				execInBackground("cd ./projects/".$data["name"]." & git init ");
		}
		echo !$success? "true" : "false";
	}
	if($_POST["action"]=="openFolder") {
		$data = json_decode($_POST["data"],true);
		// echo $data["name"]."<br>";
		$logs = [];
		execInBackground("start ".$data["name"], $logs);
		// var_dump($logs);
		echo "true";
	}
	if($_POST["action"]=="openConsole") {
		$data = json_decode($_POST["data"],true);
		// echo $data["name"]."<br>";
		$logs = [];
		execInBackground("cd ".$data["name"]." & start ", $logs);
		// var_dump($logs);
		echo "true";
	}
	if($_POST["action"]=="execCheck") {
		if(exec('echo EXEC') == 'EXEC'){
			echo 'exec works';
		}
	}
function execInBackground( $_cmd ) {
	if (substr(php_uname(), 0, 7) == "Windows")
		pclose( popen( $_cmd, "r" ) );
	else
		exec($_cmd . " > /dev/null &");
}
?>

<?php
	$mysqli = false;

	//connect Data Base
	function connectDB(){
		global $mysqli;
		$mysqli = new mysqli("localhost", "root", "", "game");
	}

	//disconnect Data Base
	function closeDB(){
		global $mysqli;
		$mysqli->close();
	}
	
?>
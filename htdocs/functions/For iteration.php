<?php


	$mysqli = false;
	function connectDB(){ //connect Data Base
		global $mysqli;
		$mysqli = new mysqli("localhost", "root", "", "test");
	}

	function closeDB(){ //disconnect Data Base
		global $mysqli;
		$mysqli->close();
	}
	
	function getTable($table, $name_id){ //get datas from table
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `$table` ORDER BY `$name_id` DESC");
		closeDB();
		return resultToArray ($result);
	}

	function resultToArray($result){ //transform in assoc array for handy handle
		$array = array();
		while (($row = $result->fetch_assoc()) != null)
			$array[] = $row;
		return $array;
	}

	function checkReg($last_name, $first_name, $fathers_name, $birthdate, $login, $pass){} //check of registration (will be released in the future) returns an error message

	function insertUser($last_name, $first_name, $fathers_name, $birthdate, $login, $pass){//inserts datas in the table 'users'
		$textErr = checkReg($last_name, $first_name, $fathers_name, $birthdate, $login, $pass);//text of an error
		if ($textErr != ""){
			print_r($textErr);
			exit;
		}
		$pass = md5($pass); //incrypt
		connectDB();
		$mysqli->query("INSERT INTO `users` (`last_name`, `first_name`, `fathers_name`, `birthdate`, `login`, `pass`) 
			VALUES ('$last_name', '$first_name', '$fathers_name', '$birthdate', '$login', '$pass')");
		closeDB();
	}

	function logIn($login, $pass){
		$user = $mysqli->query("SELECT `user_id` FROM `users`
		WHERE `login` = '$login' AND `pass` = '$pass'");
		return $user;
	}

	function insertTournament($tournament_name, $start_date, $end_date){//inserts datas in the table 'users'
		connectDB();
		$mysqli->query("INSERT INTO `tournament` (`tournament_name`, `start_date`, `end_date`) 
			VALUES ('$tournament_name', '$start_date', '$end_date')");
		closeDB();
	}

	function insertFight($last_name_1, $first_name_1, $birthdate_1, $fight_score_1,
							$last_name_2, $first_name_2, $birthdate_2, $fight_score_2,
							$last_name_3, $first_name_3, $birthdate_3, $fight_score_3,
							 $theme_name, $tournament_name){
		connectDB();
		$fight_code = $mysqli->query("SELECT MAX(`fight_code`) FROM `fight`");
		for ($i = 1, $i <= 3, &i = &i + 1){
			echo "$dinamic_id_".$i." = $mysqli->query('SELECT `dynamics_id`
			FROM `tournament`
			JOIN `dynamics` USING(`tournament_id`)
			JOIN `rating` USING(`rating_id`)
			JOIN `theme` USING(`theme_id`)
			JOIN `users` USING(`user_id`)
			WHERE `last_name` = $last_name_".$i." AND `first_name` = $first_name_".$i." 
			AND `birthdate` = $birthdate_".$i." AND `theme_name` = $theme_name 
			AND `tournament_name` = $tournament_name');

			$mysqli->query('INSERT INTO `fight` (`fight_code`, `dynamics_id_".$i."`, `fight_score_".$i."`)
			VALUES ($fight_code, $dinamic_id, $fight_score)');"
		}
		closeDB();
	}

	function insertTheme($theme_name){
		connectDB();
		$mysqli->query("INSERT INTO `theme` (`theme_name`) VALUES ('$theme_name')");
		closeDB();
	}

	function rating($user_id){
		$rating = $mysqli->query("SELECT `theme_name`, `score`
		FROM `theme`
		JOIN `rating` USING(`theme_id`)
		JOIN `users` USING(`user_id`)
		WHERE `user_id` = '$user_id'");
		return $rating;
	}

	function getRatingDinamics(){
		$rating = $mysqli->query("SELECT `tournament_name`, `theme_name`, `first_name`, `last_name`, `fathers_name`, `score_dynamics`
		FROM `tournament`
		JOIN `dynamics` USING(`tournament_id`)
		JOIN `rating` USING(`rating_id`)
		JOIN `theme` USING(`theme_id`)
		JOIN `users` USING(`user_id`)
		");
		return $rating;
	}
?>
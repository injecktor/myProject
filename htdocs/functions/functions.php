<?php
	require_once "insertFunctions.php";

	//transform in assoc array for handy handle
	function resultToArray($result){
		$array = array();
		while (($row = $result->fetch_assoc()) != null)
			$array[] = $row;
		return $array;
	}

	//get datas from table
	function getTable($table, $table_id/*for order*/){
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `$table` ORDER BY `$table_id` DESC");
		closeDB();
		return resultToArray ($result);
	}

	//gets table `dynamics`
	function getDynamics($user_id, $theme_id, $tournament_id) {
		global $mysqli;
		$result = $mysqli->query("SELECT `dynamics_id`
			FROM `dynamics`
			JOIN `rating` USING(`rating_id`)
			WHERE `user_id` = $user_id AND `theme_id` = $theme_id
			AND `tournament_id` = $tournament_id");
		return resultToArray($result);
	}

	//gets table `request`
	function getRequests() {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT `request_id`, `user_id`, `first_name`, `last_name`, `birthdate`, `tournament_id`, 
			`tournament_name`, `request_status`
					FROM `request`
					JOIN `users` USING (`user_id`)
					JOIN `tournament` USING (`tournament_id`)
					WHERE `request_status` = '0'
					ORDER BY `tournament_id` DESC");
		closeDB();
		return resultToArray ($result);
	}

	function getRating($user_id) {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT `theme_name`, `score` FROM `theme`
									JOIN `rating` USING(`theme_id`)
									WHERE `user_id` = '$user_id'");
		closeDB();
		return resultToArray ($result);
	}

	function getRatingDinamics($tournament_id){
		global $mysqli;
		connectDB();
		$rating = $mysqli->query("SELECT `tournament_name`, `theme_name`, `first_name`, `last_name`, `fathers_name`,
		 `score`, `score_dynamics`, `dynamics_id` FROM `tournament`
		JOIN `dynamics` USING(`tournament_id`)
		JOIN `rating` USING(`rating_id`)
		JOIN `theme` USING(`theme_id`)
		JOIN `users` USING(`user_id`)
		WHERE `tournament_id` = $tournament_id
		ORDER BY `dynamics_id` DESC");
		closeDB();
		return resultToArray ($rating);
	}

	//check of registration, returns an error message
	function checkReg($last_name, $first_name, $fathers_name, $birthdate, $login, $pass){
		$mysqli = getTable('users', 'user_id');
		$textErr = "";//contains text of an error

		for ($i=0; $i < count($mysqli); $i++) { 
			if ($mysqli[$i]['login'] == $login) {
				$textErr = "Этот логин уже занят";
				return $textErr;
			}
		}
		if ($last_name == "") $textErr = "Введите фамилию";
		elseif ($first_name == "") $textErr = "Введите имя";
		elseif ($birthdate == "") $textErr = "Введите дату рождения";
		elseif ($login == "") $textErr = "Введите логин";
		elseif ($pass == "") $textErr = "Введите пароль";
		elseif (strlen($last_name) <= 2 || strlen($last_name) > 30) $textErr = "Фамилия должна быть больше 1, но меньше 31 символов";
		elseif (strlen($first_name) <= 2 || strlen($first_name) > 30) $textErr = "Имя должно быть больше 1, но меньше 31 символов";
		elseif (strlen($first_name) > 30) $textErr = "Отчество должно быть меньше 31 символа";
		elseif (strlen($login) < 4 || strlen($login) > 30) $textErr = "Логин должен быть больше 4, но меньше 31 символов";
		elseif (strlen($pass) < 4 || strlen($pass) > 30) $textErr = "Пароль должен быть больше 4, но меньше 31 символов";
		return $textErr;
	}

	//logIn account
	function logIn($login, $pass){
		global $mysqli;
		connectDB();
		$user = $mysqli->query("SELECT * FROM `users`
		WHERE `login` = '$login' AND `pass` = '$pass'");
		closeDB();
		$user = resultToArray($user);
		return $user;
	}

	function setRequestStatus($request_id) {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("UPDATE `request`
								SET `request_status` = 1
								WHERE `request_id` = '$request_id'");
		closeDB();
	}

	function deleteRequest($request_id) {
		global $mysqli;
		connectDB();
		$mysqli->query("DELETE FROM `request` WHERE `request_id` = '$request_id'");
		closeDB();
	}

?>
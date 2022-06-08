<?php
	require_once "connect.php";

	//inserts datas in the table 'users'
	function insertUser($last_name, $first_name, $fathers_name, $birthdate, $login, $pass){
		$textErr = checkReg($last_name, $first_name, $fathers_name, $birthdate, $login, $pass);//text of an error
		if ($textErr != ""){
			return $textErr;
		}
		else {
			$pass = md5($pass); //incrypt
			global $mysqli;
			connectDB();
			$mysqli->query("INSERT INTO `users` (`last_name`, `first_name`, `fathers_name`, `birthdate`, `login`, `pass`) 
				VALUES ('$last_name', '$first_name', '$fathers_name', '$birthdate::date', '$login', '$pass')");
			closeDB();
			$textErr = "Вы успешно зарегистрировались";
			return $textErr;
		}
	}

	//inserts theme
	function insertTheme($theme_name){
		global $mysqli;
		connectDB();
		$mysqli->query("INSERT INTO `theme` (`theme_name`) VALUES ('$theme_name')");
		closeDB();
	}

	//inserts tournament
	function insertTournament($tournament_name, $start_date, $end_date){//inserts datas in the table 'users'
		global $mysqli;
		connectDB();
		$mysqli->query("INSERT INTO `tournament` (`tournament_name`, `start_date`, `end_date`) 
			VALUES ('$tournament_name', '$start_date', '$end_date')");
		closeDB();
	}

	//inserts fight
	function insertFight($user_id_1, $fight_score_1, $user_id_2, $fight_score_2,
							$user_id_3, $fight_score_3,
							 $theme_id, $tournament_id){
		global $mysqli;
		connectDB();

		//finds unique code for fight
		$fight_code = resultToArray($mysqli->query("SELECT MAX(`fight_code`) as `MAX` FROM `fight`"));
		$fight_code = $fight_code[0]['MAX'] + 1;
		
		for ($i = 1; $i <= 3; $i = $i + 1) {

			//get arguments
			$user = ${"user_id_$i"};
			$fight_score = ${"fight_score_$i"};

			//if can't find a needful row $isRatingExist = 0 or $isDynamicsExist = 0
			$isRatingExist = resultToArray($mysqli->query("SELECT count(*) as `count`
													FROM `rating`
													WHERE `user_id` = $user AND `theme_id` = $theme_id"));
			$isRatingExist = $isRatingExist[0]['count'];

			$isDynamicsExist = getDynamics($user, $theme_id, $tournament_id);
			$isDynamicsExist = count($isDynamicsExist); 

			$rating = resultToArray($mysqli->query("SELECT `rating_id` FROM `rating`
						WHERE `user_id` = $user AND `theme_id` = $theme_id;"));//finds a rating

			$rating_id = (int)$rating[0]['rating_id'];//converts string to integer

			if ($i == 1) {
				$anotherPlayerFS_1 = 2;
				$anotherPlayerFS_2 = 3;
			}
			elseif ($i == 2) {
				$anotherPlayerFS_1 = 1;
				$anotherPlayerFS_2 = 3;
			}
			else {
				$anotherPlayerFS_1 = 1;
				$anotherPlayerFS_2 = 2;
			}

			$dynamics_1 = 1 + (1 / (1 + (abs($fight_score - ${'fight_score_$anotherPlayerFS_1'})) / 1000));
			$dynamics_2 = 1 + (1 / (1 + (abs($fight_score - ${'fight_score_$anotherPlayerFS_2'})) / 1000));
			$dynamics = $dynamics_1 * $dynamics_2 * $fight_score / 1000;


			//if can't find a needful row it will create row in `rating` and `dynamics`
			if (!$isRatingExist && !$isDynamicsExist) {
				$mysqli->query("INSERT INTO `rating` (`user_id`, `theme_id`, `score`)
						VALUES ($user, $theme_id, $dynamics + 100);");//100 is a default rating

				$rating = resultToArray($mysqli->query("SELECT `rating_id` FROM `rating`
						WHERE `user_id` = $user AND `theme_id` = $theme_id;"));//finds a row we created a moment ago

				$rating_id = (int)$rating[0]['rating_id'];//converts string to integer

				$mysqli->query("INSERT INTO `dynamics` (`tournament_id`, `rating_id`, `score_dynamics`)
									VALUES ($tournament_id, $rating_id, $dynamics)");
			} 
			elseif (!$isDynamicsExist) {
				$mysqli->query("UPDATE `rating`
								SET `score` = `score` + $dynamics
								WHERE `rating_id` = $rating_id");

				$mysqli->query("INSERT INTO `dynamics` (`tournament_id`, `rating_id`, `score_dynamics`)
									VALUES ($tournament_id, $rating_id, $dynamics)");
			}
			else {
				$mysqli->query("UPDATE `rating`
								SET `score` = `score` + $dynamics
								WHERE `rating_id` = $rating_id");

				$mysqli->query("UPDATE `dynamics`
								SET `score_dynamics` = score_dynamics + $dynamics
								WHERE `rating_id` = $rating_id AND `tournament_id` = $tournament_id");
			}
			$dynamic_id = getDynamics($user, $theme_id, $tournament_id);
			$dynamic_id = $dynamic_id[0]['dynamics_id'];
			$mysqli->query("INSERT INTO `fight` (`fight_code`, `dynamics_id`, `fight_score`)
				VALUES ($fight_code, $dynamic_id, $fight_score)");
		}
		closeDB();
	}

	//inserts request
	function insertRequest($user_id, $tournament_id) {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("INSERT INTO `request` (`user_id`, `tournament_id`)
						VALUES ('$user_id', '$tournament_id')");
		closeDB();
	}
?>
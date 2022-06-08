<?php
	require __DIR__ . "/../functions/functions.php";
	$user_id_1 = $_POST['user_id_1'];
	$fight_score_1 = $_POST['fight_score_1'];
	$user_id_2 = $_POST['user_id_2'];
	$fight_score_2 = $_POST['fight_score_2'];
	$user_id_3 = $_POST['user_id_3'];
	$fight_score_3 = $_POST['fight_score_3'];
	$theme_id = $_POST['theme_id'];
	$tournament_id = $_POST['tournament_id'];
	if ($user_id_1 != "" && $fight_score_1 != "" &&
		$user_id_2 != "" && $fight_score_2 != "" &&
		$user_id_3 != "" && $fight_score_3 != "") {
		insertFight($user_id_1, $fight_score_1, $user_id_2, $fight_score_2,
							$user_id_3, $fight_score_3,
							 $theme_id, $tournament_id);
		echo "<script>alert('Бой добавлен')</script>";
	}
	else echo "<script>alert('Бой небыл добавлен')</script>";
	echo "<script>window.location.href = '/control.php'</script>";
?>
<?php 
	require __DIR__ . "/../functions/functions.php";
	$tournament_name = $_POST['tournament_name'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	global $mysqli;
	$isEmpty = false;
	$isDateCorrect = true;
	$tournaments = getTable("tournament", "tournament_id");
	if ($tournament_name == "" || $start_date == "" || $end_date == "") {
		$isEmpty = true;
		echo "<script>alert('Введите все данные')</script>";
	}
	else {
		for ($i = 0; $i < count($tournaments); $i++) { 
			if ($end_date < $start_date || $start_date < date("Y-m-d")) $isDateCorrect = false;
		}
	}
	if (!$isDateCorrect) echo "<script>alert('Проверьте дату')</script>";
	if (!$isEmpty && $isDateCorrect) {
		insertTournament($tournament_name, $start_date, $end_date);
		echo "<script>alert('Турнир добавлен')</script>";
	}
	echo "<script>window.location.href = '/control.php'</script>";
?>
<?php 
	require __DIR__ . "/../functions/functions.php";
	$theme_name = $_POST['theme_name'];
	global $mysqli;
	$isCorrect = true;
	$themes = getTable("theme", "theme_id");
	if ($theme_name == "") {
		$isCorrect = false;
	}
	for ($i = 0; $i < count($themes); $i++) { 
		if ($themes[$i]['theme_name'] == $theme_name) {
			echo "<script>alert('Такая тема уже существует')</script>";
			$isCorrect = false;
		}
	}
	if ($isCorrect) {
		insertTheme($theme_name);
		echo "<script>alert('Тема добавлена')</script>";
	}
	echo "<script>window.location.href = '/control.php'</script>";
?>
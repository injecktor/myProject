
<?php
	$title = "CheckPage";
	$style_file = "style";
	require_once "../blocks/head.php";
	require_once "../functions/functions.php";
?>
<?php
	$last_name = $_POST['last_name'];
	$first_name = $_POST['first_name'];
	$fathers_name = $_POST['fathers_name'];
	$birthdate = $_POST['birthdate'];
	$login = $_POST['login'];
	$pass = $_POST['pass'];
	$textErr = insertUser($last_name, $first_name, $fathers_name, $birthdate, $login, $pass);
	echo "<script>alert('$textErr')</script>";
	echo "<script>window.location.href = '/regPage.php'</script>";
?>

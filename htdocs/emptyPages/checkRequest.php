<?php
	require __DIR__ . "/../functions/functions.php";
	$isRepeat = false;
	$isAuth = true;
	$user_id = -1;
	$tournament_id = $_POST['sendData'];
	if (!isset($_COOKIE['isAuth'])) {
		echo "<script>alert('Войдите в аккаунт')</script>";
		$isAuth = false;
	}
	else $user_id = $_COOKIE['user_id'];
	$requests = getRequests();
	for ($i=0; $i < count($requests); $i++) { 
		if ($requests[$i]['user_id'] == $user_id && $requests[$i]['tournament_id'] == $tournament_id){
			echo "<script>alert('Вы уже отправляли заявку на этот турнир')</script>";
			$isRepeat = true;
		}
	}
	if (!$isRepeat && $isAuth) {
		insertRequest($user_id, $tournament_id);
		echo "<script>alert('Ваша заявка была отправлена')</script>";
	}
	echo "<script>window.location.href = '/'</script>";
?>
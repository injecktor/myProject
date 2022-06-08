<?php
	$title = "checkPage";
	$style_file = "style";
	require_once "../blocks/head.php";
?>
<?php
	$login = $_POST['login'];
	$pass = md5($_POST['pass']);
	$user = logIn($login, $pass);
	if (!$user){
		echo "<script>alert('Пользователь не найден')</script>";
		echo "<script>window.location.href = '/authPage.php'</script>";
	}
	else {
		$user = $user[0];
		setcookie('isAuth', true, time() + 3600, "/");
		setcookie('user_id', $user['user_id'], time() + 3600, "/");
		setcookie('last_name', $user['last_name'], time() + 3600, "/");
		setcookie('first_name', $user['first_name'], time() + 3600, "/");
		setcookie('father_name', $user['fathers_name'], time() + 3600, "/");
		setcookie('birthdate', $user['birthdate'], time() + 3600, "/");
		setcookie('reg_date', $user['reg_date'], time() + 3600, "/");
		setcookie('part', $user['part'], time() + 3600, "/");
		echo "<script>alert('Вы успешно вошли')</script>";
		echo "<script>window.location.href = '/'</script>";
	}
?>

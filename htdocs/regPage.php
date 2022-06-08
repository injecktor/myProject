<!DOCTYPE html>
<html lang="ru">
<head>
	<?php
		$title = "Register";
		$style_file = "regPage";
		require_once "blocks/head.php";
	?>
</head>

<body>
	<?php
		require_once "blocks/header.php";
	?>
	<div class="container">
		<div class="form col-xl-3 col-lg-4 col-md-5 col-6">
			<form action="emptyPages/checkReg.php" method="post">
				<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Введите фамилию"><br>
				<input type="text" class="form-control" name="first_name" id="first_name" placeholder="Введите имя"><br>
				<input type="text" class="form-control" name="fathers_name" id="fathers_name" placeholder="Введите отчество"><br>
				<input type="text" class="form-control" name="birthdate" id="birthdate" 
					placeholder="Год рождения" onfocus="(this.type='date')"><br>
				<input type="text" class="form-control" name="login" id="login" placeholder="Придумайте логин"><br>
				<input type="password" class="form-control" name="pass" id="pass" placeholder="Придумайте пароль"><br>
				<button class="btn">Зарегистрироваться</button>
			</form>
		</div>
	</div>
	<?php
		require_once "blocks/footer.php";
	?>
</body>
</html>
<!DOCTYPE html>
<html lang="ru">
<head>
	<?php
		$title = "Profile";
		$style_file = "profile";
		require_once "blocks/head.php";
	?>
</head>

<body>
	<?php
		require_once "blocks/header.php";
	?>
	<div class="container mt-5">
		<div class="text">
			<div class="wrapper"></div>
			<span>Id: <?php print_r($_COOKIE['user_id'])?></span>
			<span>Фамилия: <?php print_r($_COOKIE['last_name'])?></span>
			<span>Имя: <?php print_r($_COOKIE['first_name'])?></span>
			<span>Отчество: <?php if (isset($_COOKIE['fathers_name'])) print_r($_COOKIE['fathers_name'])?></span>
			<span>Дата рождения: <?php print_r($_COOKIE['birthdate'])?></span>
			<span>Дата регистрации: <?php print_r($_COOKIE['reg_date'])?></span>
			<span>Роль: <?php print_r($_COOKIE['part'])?></span>
			<?php
				$rating = getRating($_COOKIE['user_id']);
				for ($i=0; $i < count($rating); $i++) { 
					echo "<span>Рейтинг ".$rating[$i]['theme_name'].": ".$rating[$i]['score']."</span>";
				}
			?>
		</div>
	</div>
	<?php
		require_once "blocks/footer.php";
	?>
</body>
</html>
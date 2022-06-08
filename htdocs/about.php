<!DOCTYPE html>
<html lang="ru">
<head>
	<?php
		$title = "Main";
		$style_file = "about";
		require_once "blocks/head.php";
	?>
</head>

<body>
	<?php
		require_once "blocks/header.php";
		$link = [
			"img/link_1.jpg", "img/link_2.jpg", "img/link_3.jpg", "img/link_4.png", "img/link_5.jpg"
		];
		$text = [
			"Полиехов Дмитрий Александрович", "Фрейдман Софья Евгеньевна", 
			"Туркин Семён Сергеевич", "Костарев Владислав Николаевич", "Гаврин Илья Сергеевич"
		];
		$role = [
			"FrontEnd Developer", "BackEnd Developer", "Designer", "Designer", "Tester"
		];
	?>
	<div class="container">
		<?php for ($i = 0; $i < 5; $i++) {
			echo "<div class='person'>
				<div class='person_wrapper'></div>
				<img src='".$link[$i]."' alt='photo'>
				<p>".$text[$i]."</p>
				<span>".$role[$i]."</span>
			</div>";
		}?>
	</div>
	<?php
		require_once "blocks/footer.php";
	?>
</body>
</html>
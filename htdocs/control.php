<!DOCTYPE html>
<html lang="ru">
<head>
	<?php
		$title = "Main";
		$style_file = "control";
		require_once "blocks/head.php";
	?>
</head>

<body>
	<?php
		require_once "blocks/header.php";
	?>
	<div class="container">
		<div class="wrapper_1 col-md-3">
			<div class="addTheme">
				<form action="/emptyPages/addTheme.php" method="POST">
					<input type="text" class="form-control" name="theme_name" id="theme_name" placeholder="Введите тему">
					<button class="btn">Добавить тему</button>
				</form>
			</div>
			<div class="addTournament">
				<form action="/emptyPages/addTournament.php" method="POST">
					<input type="text" class="form-control" name="tournament_name" id="tournament_name" placeholder="Название турнира">
					<input type="text" class="form-control" name="start_date" id="start_date" onfocus="(this.type='date')" placeholder="Начало турнира">
					<input type="text" class="form-control" name="end_date" id="end_date" onfocus="(this.type='date')" placeholder="Окончание турнира">
					<button class="btn">Добавить турнир</button>
				</form>
			</div>
		</div>
		<div class="wrapper_2 col-md-3">
			<div class="addFight">
				<form action="/emptyPages/addFight.php" method="POST">
					<input type="text" class="form-control" name="user_id_1" id="user_id_1" placeholder="Введите Id игрока">
					<input type="text" class="form-control" name="fight_score_1" id="fight_score_1" placeholder="Введите его счет"><br>
					<input type="text" class="form-control" name="user_id_2" id="user_id_2" placeholder="Введите Id игрока">
					<input type="text" class="form-control" name="fight_score_2" id="fight_score_2" placeholder="Введите его счет"><br>
					<input type="text" class="form-control" name="user_id_3" id="user_id_3" placeholder="Введите Id игрока">
					<input type="text" class="form-control" name="fight_score_3" id="fight_score_3" placeholder="Введите его счет"><br>
					<input type="text" class="form-control" name="tournament_id" id="tournament_id" placeholder="Введите Id турнира">
					<input type="text" class="form-control" name="theme_id" id="theme_id" placeholder="Введите Id темы">
					<button class="btn">Добавить бой</button>
				</form>
			</div>
		</div>
		<div class="wrapper_3 col-md-4">
			<div class="requests">
				<?php 
					$request = getRequests();
					for ($i=0; $i < count($request); $i++) { 
						echo "<div class='requests__block'>
								<div class='block_wrapper'></div>
								<div class='text'>
									<span>Фамилия: ".$request[$i]['last_name']."</span><br>
									<span>Имя: ".$request[$i]['first_name']."</span><br>
									<span>Дата рождения: ".$request[$i]['birthdate']."</span><br>
									<span>Турнир: ".$request[$i]['tournament_name']."</span><br>
								</div>
								<form class='form_block' action='/emptyPages/updateRequest.php' method='POST'>
									<button class='btn btn_accept' name='accept' 
									value='".$request[$i]['request_id']."'>Принять</button>
									<button class='btn btn_denied' name='denied' 
									value='".$request[$i]['request_id']."'>Отклонить</button>
								</form>
							</div>";
					}
				?>
			</div>
		</div>
	</div>
	<?php
		require_once "blocks/footer.php";
	?>
</body>
</html>
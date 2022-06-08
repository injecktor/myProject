<!DOCTYPE html>
<html lang="ru">
<head>
	<?php
		$title = "Main";
		$style_file = "index";
		require_once "blocks/head.php";
		$tournament = getTable('tournament', 'tournament_id');
	?>
</head>

<body>
	<?php
		require_once "blocks/header.php";
	?>
	<div class="container">
		<?php for ($i=0; $i < count($tournament); $i++) { 
			echo "<div class='tour col-xl-4 col-lg-6 col-md-8 col-10'>
				<div class='tour_wrapper'></div>
				<div class='text'>
					<h4><b>".$tournament[$i]['tournament_name']."</b></h4>
					<p> Начало: ".$tournament[$i]['start_date']."<br> Конец: ".$tournament[$i]['end_date']."</p>
				</div>
				<div class='form_block'>
					<form action='/showResult.php' method='POST'>
						<button class='btn btn-show' name='sendData' id='btn-show-".$i."'
						value='".$tournament[$i]['tournament_id']."'>Результаты</button>
					</form>
					<form action='/emptyPages/checkRequest.php' method='POST'>
						<button class='btn btn-send' name='sendData' id='btn-send-".$i."'
						value='".$tournament[$i]['tournament_id']."'>Подать заявку</button>
					</form>
				</div>
			</div>";
			$date = date("Y-m-d");
			if ($tournament[$i]['start_date'] <= $date) {
				echo "<script>document.getElementById('btn-send-".$i."').disabled = true</script>";
			}
			if ($tournament[$i]['end_date'] >= $date) {
				echo "<script>document.getElementById('btn-show-".$i."').disabled = true</script>";
			}
		}?>
	</div>
	<?php
		require_once "blocks/footer.php";
	?>
</body>
</html>
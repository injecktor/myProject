<!DOCTYPE html>
<html lang="ru">
<head>
	<?php
		$title = "Results";
		$style_file = "showResult";
		require_once "blocks/head.php";
		$rating = getRatingDinamics($_POST['sendData']);
	?>
</head>

<body>
	<?php
		require_once "blocks/header.php";
	?>
	<div class="container">
		<div class="info_block col-xl-5 col-lg-6 col-md-8 col-10">
			<h1><?php print_r($rating[0]['tournament_name'])?></h1>
			<?php for ($i=0; $i < count($rating); $i++) {
				if(((int)$rating[$i]['score_dynamics']) > 0){ 
					$char = '+';
					$color = "green";
				}
				else {
					$char = '';
					$color = "red";
				}
				echo "<div class='person'><p>
				".$rating[$i]['last_name']." 
				".$rating[$i]['first_name']." 
				".$rating[$i]['fathers_name']." 
				".$rating[$i]['theme_name']."</p> 
				<span class=".$color.">".$char, $rating[$i]['score_dynamics']." </span>
				<p>".$rating[$i]['score']." 
				</p></div>";
			}?>
		</div>
	</div>
	<?php
		require_once "blocks/footer.php";
	?>
</body>
</html>
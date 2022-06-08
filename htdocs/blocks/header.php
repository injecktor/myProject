<header>
	<div class="header_wrapper"></div>
	<div class="logo">
		<a href="/"><img src="/img/home.png" alt="picture"></a>
	</div>
	<div class="tools">
		<a class="about" href="about.php"><img src="/img/about.png" alt="picture"></a>
		<?php if (isset($_COOKIE['part'])):?>
			<?php if ($_COOKIE['part'] == "admin"):?>
				<a class="control" href="control.php"><img src="/img/control.png" alt="picture"></a>
			<?php endif?>
		<?php endif?>
	</div>
	<?php if (!isset($_COOKIE['isAuth'])):?>
		<div class="act">
			<a class = "log_in" href="authPage.php"><img src="/img/log_in.png" alt="picture"></a>
			<a class = "sign_up" href="regPage.php"><img src="/img/sign_up.png" alt="picture"></a>
		</div>
	<?php else:?>
		<div class="act">
			<a class = "log_out" href="emptyPages/logOut.php"><img src="/img/log_out.png" alt="picture"></a>
			<a class = "profile" href="profile.php"><img src="/img/profile.png" alt="picture"></a>
		</div>
	<?php endif?>
</header>
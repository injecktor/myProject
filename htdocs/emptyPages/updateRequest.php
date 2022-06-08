<?php
	require __DIR__ . "/../functions/functions.php";
	$isAccept = isset($_POST['accept']);

	if (isset($_POST['accept'])) {
		$request_id = $_POST['accept'];
		setRequestStatus($request_id);
	}
	else {
		$request_id = $_POST['denied'];
		deleteRequest($request_id);
	}
	echo "<script>window.location.href = '/control.php'</script>";
?>
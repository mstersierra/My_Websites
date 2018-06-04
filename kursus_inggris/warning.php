<?php 
	session_start();
	if(!isset($_SESSION["login"])) : 
		header("Location: login.php");
		exit;
	endif;
	
	header("refresh:3;url=logout.php");
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Di Luar Jangkauan</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<style type="text/css">
		#warning h1{
			font-size: 50px;
			color: red;
		}
	</style>
</head>
<body>
	<div id="warning" class="container-fluid">
		<div class="col-sm-8 col-sm-offset-2">
			<h1 class="text-center">JUMPING UNATHORIZED</h1>
		</div>	
	</div>
	
</body>
</html>
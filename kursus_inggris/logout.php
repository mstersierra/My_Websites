<?php 
	session_start();
	$_SESSION = [];
	session_unset();
	session_destroy();

	setcookie('asd','', time()-3600);
	setcookie('def','', time()-3600);

	header("Location: index.php");
	exit;
 ?>
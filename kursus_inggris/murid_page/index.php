<?php 
	session_start();
	if(isset($_SESSION["login"])) :
		if($_SESSION["status"] == "Admin") : 
			header("Location: ../admin_page/manajemen_users.php");
			exit;
		elseif($_SESSION["status"] == "Student") :
			header("Location: home_murid.php");
			exit;
		elseif($_SESSION["status"] == "Guest") :
			header("Location: ../guest_page/guest_page.php");
			exit;
		endif;
	else : 
		header('Location: ../index.php');
	endif;

 ?>
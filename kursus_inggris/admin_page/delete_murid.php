<?php 
	session_start();
    if(!isset($_SESSION["login"])) : 
        header("Location: ../login.php");
        exit;
    endif;

    if($_SESSION["status"] != "Admin") : 
        header("Location: ../warning.php");
        exit;
    endif;
	
	require '../functions/functions.php';

    //Databases
    $username = $_GET["username"];

	if(deletestudent($username) > 0) : 
		echo "
				<script>
					alert('Student has been deleted');
					document.location.href = 'manajemen_murid.php';
				</script>
			";
	else :
		echo "<script>
				alert('Deleting student is failed');
				document.location.href = 'manajemen_murid.php';
			</script>";
	endif;
 ?>
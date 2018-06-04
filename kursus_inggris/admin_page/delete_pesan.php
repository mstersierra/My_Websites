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
    $id_pesan = $_GET["id_pesan"];

	if(deletemessage($id_pesan) > 0) : 
		echo "
				<script>
					alert('Message has been deleted');
					document.location.href = 'manajemen_pesan.php';
				</script>
			";
	else :
		echo "<script>
				alert('Deleting message is failed');
				document.location.href = 'manajemen_pesan.php';
			</script>";
	endif;
 ?>
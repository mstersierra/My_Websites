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
    $id_materi = $_GET["id_materi"];

	if(deletematerial($id_materi) > 0) : 
		echo "
				<script>
					alert('Material has been deleted');
					document.location.href = 'manajemen_materi.php';
				</script>
			";
	else :
		echo "<script>
				alert('Deleting material is failed');
				document.location.href = 'manajemen_materi.php';
			</script>";
	endif;
 ?>
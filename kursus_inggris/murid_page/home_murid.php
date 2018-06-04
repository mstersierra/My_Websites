<?php 
  session_start();
    if(!isset($_SESSION["login"])) : 
      header("Location: ../login.php");
      exit;
    endif;

    if($_SESSION["status"] != "Student") : 
      header("Location: ../warning.php");
      exit;
    endif;
    
  require '../functions/functions.php';


  $username = $_SESSION["username"];
  $tables = query("SELECT * FROM login WHERE username = '$username'")[0];
  $tables_student = query("SELECT * FROM murid WHERE username = '$username'")[0];
  $_SESSION["class"] = $tables_student["id_kelas"];
  var_dump($_SESSION["class"]);

 ?>

<!DOCTYPE html>
<html lang="en">
<head id="HomeMurid">
  <title>Student Page: Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body id="indexbody">

<!-- Navigation Bar -->
  <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="">Welcome, <?= $tables["name"]; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
       
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a class="nav-link" href="home_murid.php" class="page-scroll">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="materi_murid.php" class="page-scroll">Material</a></li>
            <li class="nav-item"><a class="nav-link" href="../logout.php" class="page-scroll" onclick="return confirm('Are you sure to logout?')">Logout</a></li>
          </ul>
        </div>
   </nav>
   <!-- End of Navigation Bar -->

<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <img id="headerpict" src="img/cover.jpg">
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 offset-md-4">
        <h1 class="text-center">Welcome to Student Page</h1>
        <hr>
        <div class="form-group">
          <label class="badge badge-primary" for="name">Name :</label>
          <input class="form-control" type="text" name="name" id="name" disabled="" value="<?= $tables["name"]; ?>" style="background-color: white;">
        </div>
        <div class="form-group">
          <label class="badge badge-success" for="class">Class :</label>
          <input class="form-control" type="text" name="class" id="class" disabled="" value="<?= $tables_student["id_kelas"]; ?>" style="background-color: white;">
        </div>
        <hr>
        <p id="" class="text-center">Choose material for downloading material lesson. Keep study and be pro at English!</p>
      </div>     
    </div>
      </div> 
     
        
        <!-- <div class="row">
          <img id="gambarbuku" src="img/book.jpg">
        </div>
        <div class="row">
            <img class="col-md-12 text-center" id="gambarbuku" src="img/book.jpg">
        </div> -->
      </div>    
          
    </div> 
  </div>
</section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container text-center">
      <div class="row">
        <div class="col-sm">
          <p class="text-center" class="text-muted">© 2018 Copyright: ESJ English Course</p>
        </div>
      </div>
    </div>
  </footer>
    <!-- End of Footer -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../bootstrap/js/script.js"></script>
    <script src="../bootstrap/js/stylejs.js"></script>


</body>
</html>

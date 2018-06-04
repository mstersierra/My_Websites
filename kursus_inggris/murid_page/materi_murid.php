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

    $class = $_SESSION["class"];

    $tables = query("SELECT * FROM materi WHERE id_kelas = '$class'"); 

 ?>

<!DOCTYPE html>
<html lang="en">
<head id="HomeMurid">
  <title>Student Page: Material</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body id="indexbody">
<!-- Navigation Bar -->
  <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="">Welcome, Student</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
       
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="home_murid.php" class="page-scroll">Home</a></li>
            <li class="nav-item active"><a class="nav-link" href="materi_murid.php" class="page-scroll">Material</a></li>
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
      <div class="col-md-8 offset-md-2">
        <h1 class="text-center">Welcome to Student Page</h1>
        <hr>
        <div class="table table-responsive" style="width: 1000px; font-size: 14px;">
                  <table class="table table-sm table-hover table-bordered">
                    <thead class="">
                      <tr>
                        <th class="bg-primary text-center" scope="col">No</th>
                        <th class="bg-warning text-center" scope="col">Material Name</th>
                        <th class="bg-success text-center" scope="col">File Name</th>
                        <th class="text-center" scope="col">Download</th>
                      </tr>
                    </thead>
                    <?php $i=1; ?>
                    <?php foreach ($tables as $u) : ?>
                      <tr>
                        <td class="text-center"><?= $i; ?></td>
                        <td class="text-center"><?= $u["nama_materi"]; ?></td>
                        <td class="text-center"><?= $u["nama_file"]; ?></a></td>
                        <td class="text-center"><a class="badge badge-primary" href="../admin_page/materials/<?= $u["file_materi"]; ?>" download="<?= $u["nama_file"]; ?>" >Download here </td>
                                    
                      </tr> 
                    <?php $i++; endforeach; ?>
                    
                  </table>
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

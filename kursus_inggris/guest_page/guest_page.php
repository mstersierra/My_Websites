<?php 
    session_start();
    if(!isset($_SESSION["login"])) : 
      header("Location: ../login.php");
      exit;
    endif;

    if($_SESSION["status"] != "Guest") : 
      header("Location: ../warning.php");
      exit;
    endif;

    if($_POST) :
        require('functions/functions.php');

        $nama = trim($_POST["nama"]);
        $email = trim($_POST["email"]);
        $pesan = trim($_POST["pesan"]);
 
        if(isset($_POST["submit"]) && strlen($nama) != 0 && strlen($email) != 0 && strlen($pesan) != 0) :
          if (sendmessage($_POST) > 0) :
            echo "<script>
            alert('Selamat pesan anda terkirim!');
            </script>"; 
          endif;
        else  :
            echo "<script>
            alert('Pesan anda gagal terkirim');
            </script>";
        endif;
    endif;
 ?>

<!DOCTYPE html>
<html id="HomeESJ">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<title>ESJ English Course</title>

	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/style.css">

  <style type="text/css">
    img{
      width:100%;
      height:auto;
    }
  </style>

</head>
<body id="indexbody">

	<!-- Navigation Bar -->
	<nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="">Welcome, Guest!</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand page-scroll"> ESJ English Course</a>
        </div> -->
       
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
          	<li class="nav-item"><a class="nav-link" href="#indexbody" class="page-scroll">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#profil" class="page-scroll">Profil</a></li>
            <li class="nav-item"><a class="nav-link" href="#program" class="page-scroll">Program</a></li>
            <li class="nav-item"><a class="nav-link" href="#CL" class="page-scroll">Contact and Location</a></li>
            <li class="nav-item"><a class="nav-link" href="FORMULIR_REGISTRASI_ESJ.pdf" download="FORMULIR_REGISTRASI_ESJ.pdf" class="page-scroll">Download Form Registration Here!</a></li>
            <li class="nav-item"><a class="nav-link" href="../logout.php" class="page-scroll">Logout</a></li>
          </ul>
        </div>
   </nav>
   <!-- End of Navigation Bar -->

    <!-- HOME -->
    <section>
      <!-- CAROUSELLS -->
      <div id="Carousells" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../img/a1.jpg" alt="1">
          </div>
          <div class="carousel-item">
            <img src="../img/a2.jpg" alt="2">
          </div>
          <div class="carousel-item">
            <img src="../img/a3.jpg" alt="3">
          </div>
          <!-- Left and right controls -->
          <a class="carousel-control-prev" href="#Carousells" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#Carousells" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    <!-- END CAROUSELLS -->

  <!-- profil -->
  <div id="profil">
    <div class="container-fluid">
      <p style="font-size:3vw;" class="text-center" >ESJ English Course</p>
      <div class="row">
        <div class="col-md-6">
          <p>Esj course merupakan lembaga pendidikan kursus bahasa inggris. Saat ini Esj course mempunyai 20 gerai dengan jumlah siswa lebih kurang 15.000 siswa yang terdaftar di beberapa gerai di Indonesia. Seirama dengan kemajuan dan perkembangan teknologi komunikasi masyarakat haruslah mempersenjatai diri dengan ilmu pengetahuan.</p>
        </div>
        <div class="col-md-6">
          <p>Untuk itu, Bahasa Inggris merupakan salah satu sarana penting guna mencapai tujuan tersebut. Bahasa Inggris bukan saja diperlukan oleh para siswa sekolah, tetapi juga masyarakat umum sebagai alat komunikasi di lapangan pekerjaan, Tourism, dan Lembaga dengan dunia Internasional. Esj course ingin sekali membantu masyarakat maupun Pemerintah untuk meningkatkan kemampuan berbahasa Inggris dengan menyelengarakannya sehingga cita-cita yang didambakan selama ini mampu tercapai.</p>
        </div>
      </div>
    </div> 
  </div>
 <!-- end profil -->

    <div id="program" class="item" align="middle">
      <img  src="../img/program.jpg" width="500" height="377">
    </div>


    <div  class="item" align="middle">
      <img  src="../img/register.jpg" width="500" height="377">
    </div>
 
  <!-- Jumbotron Contact & Location -->
  <div id="CL" class="container"">
    <div class="jumbotron row">
      <div class="col-md-6">
          <H3>CONTACT</H3>
            <h4>Telp   : 021-88888888</h4>
            <h4>Fax    : 021-77777777</h4>
            <p>Address: Jalan Letjen S. Parman No. 1, Tomang, Grogol petamburan, RT.6/RW.16, Tomang, Grogol petamburan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11440</p>
            <p>Hubungi Kami</p>

            <form method="post">
              <div class="form-group">
                <input type="text" name="nama" id="nama" tabindex="1" class="form-control" placeholder="Masukkan nama" value="">
              </div>
              <div class="form-group">
                <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Masukkan e-mail" value="">
              </div>
              <div class="form-group">
                <input type="text" name="pesan" id="pesan" tabindex="1" class="form-control" placeholder="Masukkan pesan" value="">
              </div>
              <div class="col-sm-6">
                <input type="submit" name="submit" id="submit" tabindex="4" class="form-control btn btn-success" value="Submit">
              </div>
            </form>  
      </div>
      <!--  location -->
      <div class="col-md-6">
        <h3>LOCATION</h3>
        <iframe src="https://www.google.com/maps/embed/v1/place?q=untar%201&key=AIzaSyBUnUXnX5VCzL6p_wFyg5EqRCL2WzdcE6c" width="100%" height="450" frameborder="0" style="border:2px solid;"></iframe>
      </div>
      <!-- end location -->
    </div>
  </div>
  <!-- End of Jumbotron -->

</section>
<!-- End of Body -->

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
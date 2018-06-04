<?php 
  session_start();
  require 'functions/functions.php';

/*======== REGISTER PROCESS =============*/


/*======== LOGIN PROCESS ============= */
  $user = query("SELECT * FROM login");
  
  date_default_timezone_set('Asia/Jakarta');

  if(isset($_COOKIE['asd']) && isset($_COOKIE['def'])) :
    $asd = $_COOKIE['asd'];
    $def = $_COOKIE['def'];

    // ambil username berdasarkan asd
    $result = mysqli_query($conn, "SELECT * FROM tabel_login WHERE username = '$asd'");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan password
    if($def === hash('sha256', $row['password'])):
      $_SESSION['login'] = true;
      $_SESSION["username"] = $asd;
      $_SESSION["status"] = $row["status"];
    endif;
  endif;

  if(isset($_SESSION["login"])) :
    if(isset($_SESSION["status"])) : 
      if($_SESSION["status"] == "Admin") : 
        header("Location: admin_page/manajemen_users.php");
        exit;
      elseif($_SESSION["status"] == "Student") :
        header("Location: murid_page/home_murid.php");
        exit;
      elseif($_SESSION["status"] == "Guest") :
        header("Location: guest_page/guest_page.php");
        exit;
      endif;
    endif;
  endif;

  if(isset($_POST["loginbtn"])) :  
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM login WHERE username = '$username'");

    //Cek username
    if(mysqli_num_rows($result) === 1) : 
      //Cek Password
      $row = mysqli_fetch_assoc($result);
      // if(password_verify($password,$row["password"])) : <--Gunakan ini untuk mengubah hasil password yang telah dienkripsi menggunakan hash
      if($password === $row["password"]) : 
      //Set Session
        $_SESSION["login"] = true;
        $_SESSION["username"] = $row["username"];

        //Cek Remember Me
        if(isset($_POST["remember"])) : 
          //Create Cookie
          setcookie('asd', $row['username'], time()+60);
          setcookie('def', hash('sha256', $row['password']), time()+60);
        endif;

        //Cek Status apakah Guru/Murid/Admin
        if($row["status"] === "Guest") : 
          header("Location: guest_page/guest_page.php");
        elseif($row["status"] === "Student") : 
          header("Location: murid_page/home_murid.php");
        elseif($row["status"] === "Admin") : 
          header("Location: admin_page/manajemen_users.php");
        endif;
        $_SESSION["status"] = $row["status"];
        exit;
      endif;
    endif;
    // $error = true;
    echo "
                <script>
                    alert('Login failed');
                    document.location.href = 'login.php';
                </script>
            ";
  endif;

  if(isset($_POST["registerbtn"])) :
    if(register($_POST) > 0 && $_POST["registertrigger"]==1) :
      echo "
                <script>
                    alert('Register berhasil, silahkan login');
                    document.location.href = 'login.php';
                </script>
            ";
      else :
            echo "
                <script>
                    alert('Register gagal, pastikan username belum ada yang menggunakan, password sesuai kriteria, dan format E-mail benar');
                    document.location.href = '';
                </script>
            ";
        endif;
  endif;
  
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>ESJ English Course</title>

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/style.css">

</head>
<body>

	<!-- Navigation Bar -->
  <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="">ESJ English Course</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
       
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="index.php" class="page-scroll">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="about.php" class="page-scroll">About</a></li>
            <li class="nav-item active"><a class="nav-link" href="login.php" class="page-scroll">Login</a></li>
          </ul>
        </div>
   </nav>
   <!-- End of Navigation Bar -->


<!-- login -->
<section>
  <div class="container-fluid">
    <div class="col-md-12" id="Welcome">
      <h1 class="text-center">Selamat datang di ESJ English Course</h1>
    </div>
  </div>
  <div class="container-fluid">
    <div class="col-md-6 offset-md-3" id="loginregister">
      <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab" style="margin-top: 20px;">
        <form method="post">
            <div class="form-group">
              <input class="form-control" type="text" name="username" id="username" placeholder="Username" tabindex="1">
            </div>
            <div class="form-group">
              <input class="form-control" type="password" name="password" id="password" placeholder="Password" tabindex="2">
            </div>
            <button class="col-md-4 offset-md-4 btn btn-success" type="submit" name="loginbtn">Login</button>
        </form>
      </div>
      <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab" style="margin-top: 20px;">
        <form method="post">
            <input type="hidden" name="registertrigger" value="1">
            <div class="form-group">
              <input class="form-control" type="text" name="username" id="username" placeholder="Masukkan nama username" tabindex="1">
            </div>
            <div class="form-group">
              <input class="form-control" type="password" name="password" id="password" placeholder="Masukkan password" tabindex="2">
            </div>
            <div class="form-group">
              <input class="form-control" type="password" name="repassword" id="repassword" placeholder="Masukkan password ulang" tabindex="3">
            </div>

            <div class="form-group">
              <input class="form-control" type="name" name="name" id="name" placeholder="Masukkan nama lengkap" tabindex="4">
            </div>
            <div class="form-group">
              <input class="form-control" type="email" name="email" id="email" placeholder="Masukkan E-mail" tabindex="5">
            </div>
            
            <button class="col-md-4 offset-md-4 btn btn-success" type="submit" name="registerbtn">Register</button>
        </form>
      </div>
    </div>    
    </div>
  </div>
</section>

<!-- end login-->

    <!-- Footer -->
  <footer>
    <div class="nav fixed-bottom">
      <div class="container-fluid text-center" id="footerlog">
          <p>© 2018 Copyright: ESJ English Course</p>
      </div>
    </div>
  </footer>
  <!-- End of Footer -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <script src="bootstrap/js/jquery-3.3.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/script.js"></script>
    <script src="stylejs.js"></script>
   


</body>
</html>
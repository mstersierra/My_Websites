<?php 
  ini_set('session.cache_limiter','public');
  session_cache_limiter(false);

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
    $class = [["class"=>"English for Children"],["class"=>"English for Teens"],["class"=>"English for Adults"]];
    $student = query("SELECT * FROM murid WHERE username = '$username'")[0];


    if(isset($_POST["submit"])) :
        $_POST["oldusername"] = $username;
        if(updatestudent($_POST) > 0) :
            echo "
                <script>
                    alert('Student updated');
                    document.location.href = 'manajemen_murid.php';
                </script>
            ";
        else :
            echo "
                <script>
                    alert('Updating student failed, make sure there is something changed, username that inputted is correct, exist and no duplicate found');
                    document.location.href = '';
                </script>
            ";
        endif;
        
    endif;

    // //Tombol cari ditekan
    // if(isset($_POST["cari"])) :
    //  $tabellogin = cariuserlogin($_POST["keyword"]);
    // endif;

 ?>

<!DOCTYPE html>
<html lang="en" id="home">
<head>
    <title>ADMIN - Update Student</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/admin_page_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <!-- Body -->
    <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3><span class="fa fa-desktop fa-fw"></span> Admin Pages</h3>
                </div>

                <ul class="list-unstyled components">
                    <li>
                        <a href="manajemen_users.php" aria-expanded="false"><span class="fa fa-user fa-fw"></span> Users</a>
                    </li>
                    <li class="active">
                        <a href="manajemen_murid.php" aria-expanded="false"><span class="fa fa-address-card-o fa-fw"></span> Students</a>
                    </li>
                    <li>
                        <a href="manajemen_materi.php" aria-expanded="false"><span class="fa fa-book fa-fw"></span> Materials</a>
                    </li>
                    <li>
                        <a href="manajemen_pesan.php" aria-expanded="false"><span class="fa fa-envelope fa-fw"></span> Messages </a>
                    </li>
                    <li>
                        <a href="../index.php" aria-expanded="false"><span class="fa fa-sign-out fa-fw" onclick="return confirm('Are you sure to logout?')"></span> Logout</a>
                    </li>   
                </ul>
                <ul class="list-unstyled components">
                    <li>
                        <a href="add_murid.php" aria-expanded="false"><span class="fa fa-plus fa-fw"></span> Add Student</a>
                    </li>
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content">

                <nav class="navbar navbar-default navbar-expand-lg">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="fa fa-align-left fa-fw"></i>
                                <span>Toggle Sidebar</span>
                            </button>
                        </div>

                        <!-- <div class="navbar-nav ml-auto">
                            <ul class="nav navbar-nav navbar-right">
                                
                            </ul>
                        </div> -->
                    </div>
                </nav>

                <div class="line"></div>

                <h3><span class="fa fa-address-card-o fa-fw"></span> Update Student</h3>

                <div class="line"></div>

                <form action="" method="post" id="formm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="badge badge-primary" for="username">Username :</label>
                        <input class="form-control" type="text" name="username" id="username" required="" placeholder="Enter username" value="<?= $student["username"]; ?>">
                    </div>
                    <div class="form-group">
                        <label class="badge badge-success" for="studentname">Student Name :</label>
                        <input class="form-control" type="text" name="studentname" id="studentname" required="" placeholder="Enter student name" value="<?= $student["nama_murid"]; ?>">
                    </div>
                    <div class="form-group">
                        <label class="badge badge-danger" for="class">Class :</label>
                        <select class="form-control" name="class" required="">
                            <option value="<?= $student["id_kelas"]; ?>" selected><?= $student["id_kelas"]; ?></option>
                            <?php foreach($class as $s) : ?>
                                <?php if($s["class"] != $student["id_kelas"]) : ?>
                                    <option value="<?= $s["class"]; ?>"><?= $s["class"]; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="badge badge-warning" for="email">E-mail :</label>
                        <input class="form-control" type="email" name="email" id="email" required="" placeholder="Enter e-mail" value="<?= $student["email"]; ?>">
                    </div>
                    <div class="form-group">
                        <label class="badge badge-primary" for="address">Address :</label>
                        <input class="form-control" type="text" name="address" id="address" placeholder="Enter address" required="" value="<?= $student["alamat"]; ?>">
                    </div>
                    <div class="form-group">
                        <label class="badge badge-success" for="phonenumber">Phone number :</label>
                        <input class="form-control" type="tel" name="phonenumber" id="phonenumber" placeholder="Enter phone number" required="" value="<?= $student["notelp"]; ?>">
                    </div>
                    <div class="form-group">
                        <label class="badge badge-warning" for="photo">Student photo :</label><br>
                        <input class="form-control" type="file" name="photo" id="photo" value="<?= $student["photo"]; ?>"><img width="100px" src="student_photos/<?= $student["photo"]; ?>">
                    </div>
                    <input type="hidden" name="oldphoto" value="<?= $student["photo"]; ?>">
                    <input type="hidden" name="photo_name" value="<?= $student["namaFile"]; ?>">
                    <button class="btn btn-primary" name="submit" id="submit" onclick="return confirm('Are you sure?')"><span class="fa fa-plus fa-fw"></span> Update Student</button>
                </form>
                
                <div class="line"></div>
            </div> <!-- End of Page Content-->
        </div> <!-- End of Wrapper -->

        <!-- Footer -->
            <footer class="footer">
                <div class="container">
                       <div class="row">
                            <div class="col-sm-12">
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
    <script src="../bootstrap/js/stylejs.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!-- Bootstrap Js CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
     </script>
    
</body>
</html>
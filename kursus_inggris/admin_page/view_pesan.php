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
    $id_pesan = $_GET["id_pesan"];
    $pesan = query("SELECT * FROM pesan WHERE id_pesan = '$id_pesan'")[0];

 ?>

<!DOCTYPE html>
<html lang="en" id="home">
<head>
    <title>ADMIN - View Messages</title>
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
                    <li >
                        <a href="manajemen_murid.php" aria-expanded="false"><span class="fa fa-address-card-o fa-fw"></span> Students</a>
                    </li>
                    <li>
                        <a href="manajemen_materi.php" aria-expanded="false"><span class="fa fa-book fa-fw"></span> Materials</a>
                    </li>
                    <li class="active">
                        <a href="manajemen_pesan.php" aria-expanded="false"><span class="fa fa-envelope fa-fw"></span> Messages </a>
                    </li>
                    <li>
                        <a href="../index.php" aria-expanded="false" onclick="return confirm('Are you sure to logout?')"><span class="fa fa-sign-out fa-fw"></span> Logout</a>
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

                <h3><span class="fa fa-envelope fa-fw"></span> View Message</h3>

                <div class="line"></div>

                <form action="" method="post" id="formm" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="badge badge-primary" for="sender">Sender :</label>
                            <input class="form-control" type="text" name="sender" id="sender" required="" value="<?= $pesan["nama"]; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="badge badge-success" for="time">Delivered Time:</label>
                            <input style="background-color: white;" class="form-control" type="text" name="time" id="time" required="" disabled="" value="<?= $pesan["waktu"]; ?>">
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <label class="badge badge-warning" for="isi">Content :</label>
                        <textarea class="form-control" readonly="" name="isi" style="background-color: white;"><?= $pesan["pesan"]; ?></textarea>
                    </div>
                   
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
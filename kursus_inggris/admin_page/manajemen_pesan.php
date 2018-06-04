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

	if(isset($_POST["searchBtn"])) :
		$tables = search_message($_POST["search"]);
	else :
		$tables = query("SELECT * FROM pesan ORDER BY id_pesan");
	endif;

	// //Tombol cari ditekan
	// if(isset($_POST["cari"])) :
	// 	$tabellogin = cariuserlogin($_POST["keyword"]);
	// endif;

 ?>

<!DOCTYPE html>
<html lang="en" id="home">
<head>
	<title>ADMIN - Messages Management</title>
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
                    <li>
                        <a href="manajemen_murid.php" aria-expanded="false"><span class="fa fa-address-card-o fa-fw"></span> Students</a>
                    </li>
                    <li>
                        <a href="manajemen_materi.php" aria-expanded="false"><span class="fa fa-book fa-fw"></span> Materials</a>
                    </li>
                    <li class="active">
                        <a href="manajemen_pesan.php" aria-expanded="false"><span class="fa fa-envelope fa-fw"></span> Messages</a>
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

                        <div class="navbar-nav ml-auto">
                            <form action="" method="post">
                                <input type="text" name="search" id="keyword" size="30" autofocus=""
                                placeholder="Search here" autocomplete="off">
                                <button style="margin-left: 5px;" class="btn btn-primary" type="submit" name="searchBtn">Search</button>
                            </form>
                        </div>

                	</div>
                </nav>

                <div class="line"></div>

                <div class="text-center" style="margin-bottom: 30px;">
                	<h1><span class="fa fa-envelope fa-fw"></span> Messages Management</h1>
                </div>
                
                <div class="line"></div>

                <div class="table table-responsive" style="width: 1000px; font-size: 14px;">
                	<table class="table table-sm table-hover table-bordered">
                		<thead class="thead-light">
                			<tr>
                				<th class="bg-danger text-center" scope="col">No</th>
                				<th class="bg-warning text-center" scope="col">Delivered Time</th>
                				<th class="bg-success text-center" scope="col">Sender Name</th>
                				<th class="bg-primary text-center" scope="col">E-mail</th>
                				<th class="bg-info text-center" scope="col">Message</th>
                				<th class="text-center"><a href="">Edit</a></th>
                			</tr>
                		</thead>
                		<?php $i=1; ?>
                		<?php foreach ($tables as $u) : ?>
                			<tr>
                				<td class="text-center"><?= $i; ?></td>
                				<td class="text-center"><?= $u["waktu"]; ?></td>
                				<td class="text-center"><?= $u["nama"]; ?></td>
                				<td class="text-center"><?= $u["email"]; ?></td>
                				<td class="text-center"><?= $u["pesan"]; ?></td>
                				<td class="text-center">
                                    <a class="badge badge-primary" href="view_pesan.php?id_pesan=<?= $u["id_pesan"]; ?>">View </a> | 
                                    <a class="badge badge-danger" href="delete_pesan.php?id_pesan=<?= $u["id_pesan"]; ?>" onclick="return confirm('Are you sure to delete this?');">Delete</a>
                                </td>
                			</tr> 
                		<?php $i++; endforeach; ?>
                		
                	</table>
                </div>
                
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
<?php
    // session start
    if(!empty($_SESSION)){ }else{ session_start(); }
    require 'koneksi.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>
            <?= $title_project;?> 
        </title>
		<!-- BOOTSTRAP 4-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.1/css/bootstrap.css">
        <!-- DATATABLES BS 4-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/main.css?v=<?=time();?>">
        <!-- jQuery -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <!-- BOOTSTRAP 4-->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <!-- DATATABLES BS 4-->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

	</head>
    <body class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <b>
                        <i class="fa fa-cog"></i> 
                        <?= $title_project;?>
                    </b>
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation"></button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ml-auto">
                        <?php if(!empty($_SESSION['ADMIN'])){?>
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">Dashboard</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php?hal=profil">
                                    Edit Akun
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="proses.php?aksi=logout">
                                    <i class="fa fa-sign-out"></i> Logout
                                </a>
                            </li>
                        <?php }else{?>
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="login.php">
                                    <i class="fa fa-sign-in"></i> Login Disini
                                </a>
                            </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </nav>
		<div class="container">
			<?php 
                if(!empty($_GET['hal'])){
                    if(!empty($_SESSION['ADMIN'])){
                        if(!empty($_GET['file'])){
                            if(file_exists('views/'.strip_tags($_GET['hal']).'/'.strip_tags($_GET['file']).'.php'))
                            {
                                include 'views/'.strip_tags($_GET['hal']).'/'.strip_tags($_GET['file']).'.php';
                            }else{
                                include 'views/errors/404.php';
                            }
                        }else{
                            if(file_exists('views/'.strip_tags($_GET['hal']).'/index.php'))
                            {
                                include 'views/'.strip_tags($_GET['hal']).'/index.php';
                            }else{
                                include 'views/errors/404.php';
                            }
                        }
                    }else{
                        echo '<script>alert("Maaf Login Dahulu !");window.location="login.php"</script>';
                    }
                }else{
                    include 'views/home/index.php';
                }
            ?>
		</div>
        <div class="clearfix mt-5"></div>
        <div class="footer mt-auto text-center">
            <p> Copyright &copy; <?= $title_project;?> <?=date('Y');?></p>
        </div>
        <script>
            $('#mytable').dataTable();
        </script>
	</body>
</html>

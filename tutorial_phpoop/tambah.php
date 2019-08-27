<?php
    // session start
    if(!empty($_SESSION)){ }else{ session_start(); }
    //session
	if(!empty($_SESSION['ADMIN'])){ }else{ header('location:login.php'); }
    // panggil file
    include 'proses/koneksi.php';
    include 'proses/prosescrud.php';
    // cara panggil class di koneksi php
    $db = new Koneksi();
    // cara panggil koneksi di fungsi DBConnect()
    $koneksi =  $db->DBConnect();
    // panggil class prosesCrud di file proses/prosescrud.php
    $proses = new prosesCrud($koneksi);
    // menghilangkan pesan error
    error_reporting(0);
    // panggil session ID
    $id = $_SESSION['ADMIN']['id_login'];

	$sesi = $proses->tampil_data_id('tbl_user','id_login',$id);

	// proses tambah
	if(!empty($_POST['nama']))
	{
		$nama = strip_tags($_POST['nama']);
		$telepon = strip_tags($_POST['telepon']);
		$email = strip_tags($_POST['email']);
		$alamat = strip_tags($_POST['alamat']);
		$user = strip_tags($_POST['user']);
		$pass = strip_tags($_POST['pass']);
		
		$tabel = 'tbl_user';
		# proses insert
		$data[] = array(
			'username'		=>$user,
			'password'		=>md5($pass),
			'nama_pengguna'	=>$nama,
			'telepon'		=>$telepon,
			'email'			=>$email,
			'alamat'		=>$alamat
		);
		$proses->tambah_data($tabel,$data);
        echo '<script>alert("Tambah Data Berhasil");window.location="index.php"</script>';
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Tambah Pengguna</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
    <body style="background:#586df5;">
		<div class="container">
			<br/>
			Selamat Datang, <?php echo $sesi['nama_pengguna'];?>
			<div class="float-right">	
				<a href="index.php" class="btn btn-success btn-md" style="margin-right:1pc;"><span class="fa fa-home"></span> Kembali</a> 
				<a href="logout.php" class="btn btn-danger btn-md float-right"><span class="fa fa-sign-out"></span> Logout</a>
			</div>		
			<br/><br/><br/>
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-lg-6">
					<br/>
					<div class="card">
						<div class="card-header">
						<h4 class="card-title">Tambah Pengguna</h4>
						</div>
						<div class="card-body">
							<form action="" method="POST">
								<div class="form-group">
									<label>Nama </label>
									<input type="text" value="" class="form-control" name="nama">
								</div>
								<div class="form-group">
									<label>Telepon</label>
									<input type="number" value="" class="form-control" name="telepon">
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="harga" value="" class="form-control" name="email">
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<textarea name="alamat" class="form-control"></textarea>
								</div>
								<div class="form-group">
									<label>Username</label>
									<input type="text" value="" class="form-control" name="user">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" value="" class="form-control" name="pass">
								</div>
								<button class="btn btn-primary btn-md" name="create"><i class="fa fa-plus"> </i> Tambah Data</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</div>
	</body>
</html>
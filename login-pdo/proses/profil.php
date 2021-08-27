<?php 
    require '../koneksi.php';

    // proses login
    if(!empty($_GET['aksi'] == 'update'))
    {
        $id =  (int)$_POST["id_login"]; // should be integer (id)
        $data[] =  htmlspecialchars($_POST["username"]);
        $data[] =  htmlspecialchars($_POST["password"]);
        $data[] =  htmlspecialchars($_POST["nama_pengguna"]);
        $data[] =  htmlspecialchars($_POST["telepon"]);
        $data[] =  htmlspecialchars($_POST["email"]);
        $data[] =  htmlspecialchars($_POST["alamat"]);
        $data[] =  $id;

        $sql = "UPDATE tbl_user SET 
                    username = ?, 
                    password = md5(?), 
                    nama_pengguna = ?, 
                    telepon = ?, 
                    email = ?, 
                    alamat = ?  
                    WHERE id_login = ?";

        $row = $koneksi->prepare($sql);
        $row->execute($data);
        echo "<script>window.location='../index.php?hal=profil&notif=success';</script>";
    }
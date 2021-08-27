<?php 
    session_start();
    require 'koneksi.php';

    // proses login
    if(!empty($_GET['aksi'] == 'login'))
    {
        // validasi text untuk filter karakter khusus dengan fungsi strip_tags()
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $sql = "SELECT * FROM user WHERE username = ? AND password = md5(?)";
        $row = $koneksi->prepare($sql);
        $row->execute(array($user,$pass));
        $count = $row->rowCount();

        if($count > 0)
        {
            $result = $row->fetch();
            $_SESSION['ADMIN'] = $result;
            // status yang diberikan 
            echo "<script>window.location='index.php';</script>";
        }else{
            echo "<script>window.location='login.php?get=failed';</script>";
        }

    }

    if(!empty($_GET['aksi'] == "tambah")) {
        $data[] =  $_POST["kd_barang"];
        $data[] =  $_POST["nama_barang"];
        $data[] =  $_POST["satuan"];
        $data[] =  $_POST["harga"];

        $sql = "INSERT INTO barang (kd_barang,nama_barang,satuan,harga ) VALUES ( ?,?,?,?)";
        $row = $koneksi->prepare($sql);
        $row->execute($data);

        echo "<script>window.location='index.php';</script>";

    }

    if(!empty($_GET['aksi'] == "edit")) {
        $id =  (int)$_GET["id"];
        $data[] =  $_POST["kd_barang"];
        $data[] =  $_POST["nama_barang"];
        $data[] =  $_POST["satuan"];
        $data[] =  $_POST["harga"];

        $data[] = $id;
        $sql = "UPDATE barang SET kd_barang = ?, nama_barang = ?, satuan = ?, harga = ?  WHERE id = ? ";
        $row = $koneksi->prepare($sql);
        $row->execute($data);

        echo "<script>window.location='index.php';</script>";

    }

    if(!empty($_GET['aksi'] == "hapus")) {

        $id =  (int)$_GET["id"]; // should be integer (id)
        $sql = "SELECT * FROM barang WHERE id = ?";
        $row = $koneksi->prepare($sql);
        $row->execute(array($id));
        $cek = $row->rowCount();
        if($cek > 0)
        {
            $sql_delete = "DELETE FROM barang WHERE id = ?";
            $row_delete = $koneksi->prepare($sql_delete);
            $row_delete->execute(array($id));
            echo "<script>window.location='index.php';</script>";
        }else{
            echo "<script>window.location='index.php';</script>";
        }
    }

    if(!empty($_GET['aksi'] == 'logout'))
    {
        session_destroy();
        echo "<script>window.location='login.php?signout=success';</script>";
    }
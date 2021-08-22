<?php 
    require 'koneksi.php';

    // proses login
    if(!empty($_GET['aksi'] == 'login'))
    {
        // validasi text untuk filter karakter khusus dengan fungsi strip_tags()
        $user = strip_tags($_POST['user']);
        $pass = strip_tags($_POST['pass']);

        $row = $koneksi->prepare('SELECT * FROM tbl_user WHERE username = ? AND password = md5(?)');
        $row->execute(array($user,$pass));
        $count = $row->rowCount();
        if($count > 0)
        {
            // buat sesi 
            session_start();

            $result = $row->fetch();
            $_SESSION['ADMIN'] = $result;
            // status yang diberikan 
            echo "<script>window.location='index.php';</script>";
        }else{
            echo "<script>window.location='login.php?get=failed';</script>";
        }
    }

    if(!empty($_GET['aksi'] == 'tambah'))
    {
        $data[] =  htmlspecialchars($_POST["npm"]);
        $data[] =  htmlspecialchars($_POST["nama_siswa"]);
        $data[] =  htmlspecialchars($_POST["fakultas"]);
        $data[] =  htmlspecialchars($_POST["tahun"]);
        $data[] =  htmlspecialchars($_POST["tgl_buat"]);

        $sql = "INSERT INTO tbl_mahasiswa (npm,nama_siswa,fakultas,tahun,tgl_buat ) 
            VALUES ( ?,?,?,?,?)";
        $row = $koneksi->prepare($sql);
        $row->execute($data);
        echo "<script>alert('tambah mahasiswa berhasil');window.location='index.php';</script>";
    }

    if(!empty($_GET['aksi'] == 'edit'))
    {
        $id = (int)$_GET["id"]; // should be integer (id)
        $data[] =  htmlspecialchars($_POST["npm"]);
        $data[] =  htmlspecialchars($_POST["nama_siswa"]);
        $data[] =  htmlspecialchars($_POST["fakultas"]);
        $data[] =  htmlspecialchars($_POST["tahun"]);
        $data[] =  htmlspecialchars($_POST["tgl_buat"]);
        $data[] = $id;

        $sql = "UPDATE tbl_mahasiswa SET npm = ?, nama_siswa = ?, fakultas = ?, tahun = ?, tgl_buat = ?  WHERE id = ? ";
        $row = $koneksi->prepare($sql);
        $row->execute($data);
        echo "<script>alert('edit mahasiswa berhasil');window.location='index.php';</script>";
    }

    if(!empty($_GET['aksi'] == 'hapus'))
    {
        $id =  (int)$_GET["id"]; // should be integer (id)
        $sql = "SELECT * FROM tbl_mahasiswa WHERE id = ?";
        $row = $koneksi->prepare($sql);
        $row->execute(array($id));
        $cek = $row->rowCount();
        if($cek > 0)
        {
            $sql_delete = "DELETE FROM tbl_mahasiswa WHERE id = ?";
            $row_delete = $koneksi->prepare($sql_delete);
            $row_delete->execute(array($id));
            echo "<script>alert('hapus mahasiswa berhasil');window.location='index.php';</script>";
        }else{
            echo "<script>window.location='index.php';</script>";
        }
    }


    if(!empty($_GET['aksi'] == 'logout'))
    {
        session_start();
        session_destroy();
        echo "<script>window.location='login.php?signout=success';</script>";
    }
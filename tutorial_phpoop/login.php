<?php
    // session start();
    if(!empty($_SESSION)){ }else{ session_start(); }
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

    // proses login
    if(!empty($_POST['user']))
    {   
        // validasi text untuk filter karakter khusus dengan fungsi strip_tags()
        $user = strip_tags($_POST['user']);
        $pass = strip_tags($_POST['pass']);

        // panggil fungsi proses_login() yang ada di class prosesCrud()
        $result = $proses->proses_login($user,$pass);

        if($result == 'sukses')
        {
            echo "<script>window.location='index.php';</script>";
        }
        else
        {
            echo "<script>$('#notifikasi').show();$('#formlogin')[0].reset();</script>";
        }
        // hapus transfer data user dan password dengan unset post
        unset($user); unset($pass);
    }
?>
<!doctype html>
<html>
    <head>
        <title>Belajar Login bersama codekop.com </title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </head>
    <body style="background:#586df5;">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
                <br/><br/>
                <div id="logout">
                    <?php if(!empty($_GET['signout'] == 'sukses')){?>
                        <div class="alert alert-success">
                            <small>Anda Berhasil Logout</small>
                        </div>
                    <?php }?>
                </div>
                <div id="notifikasi">
                    <div class="alert alert-danger">
                        <small>Login Anda Gagal, Periksa Kembali Username dan Password</small>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Sign in</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="" id="formlogin">
                        <div class="form-group">
                            <label>Your username</label>
                            <input name="user" class="form-control" placeholder="user" type="text" required="required" autocomplete="off">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <label>Your password</label>
                            <input name="pass" class="form-control" placeholder="******" type="password" required="required" autocomplete="off">
                        </div> <!-- form-group// --> 
                        <div class="form-group">
                            <button type="submit" name="proses_login" class="btn btn-primary btn-block"> Login  </button>
                        </div> <!-- form-group// -->                                                           
                    </form>
                        <div class="form-group">
                            <a href="index.php"> Kembali ke Home  </a>
                        </div> <!-- form-group//-->
                </div>
            </div>
            <div class="col-sm-4">
            </div>
        </div> 
    </div>
    <script>
      // notifikasi gagal di hide
      <?php if(empty($_POST['user'])){?>
        $("#notifikasi").hide();
      <?php }?>
        var logingagal = function(){
            $("#logout").fadeOut('slow');
            $("#notifikasi").fadeOut('slow');
        };
        setTimeout(logingagal, 4000);
    </script> 
    </body>
</html>
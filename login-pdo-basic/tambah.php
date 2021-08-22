<?php
    // session start
    if(!empty($_SESSION)){ }else{ session_start(); }
    require 'koneksi.php';
    if(!empty($_SESSION['ADMIN'])){ }else{
        echo '<script>alert("Maaf Login Dahulu !");window.location="login.php"</script>';
    }
    include 'navbar.php';
?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            Tambah Data Mahasiswa
        </div>
        <div class="card-body">
            <form method="post" action="proses.php?aksi=tambah">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">NPM</label>
                            <input type="number" class="form-control" required name="npm" id="npm" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Nama siswa</label>
                            <input type="text" class="form-control" required name="nama_siswa" id="nama_siswa" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Fakultas</label>
                            <input type="text" class="form-control" required name="fakultas" id="fakultas" placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <input type="number" 
                                class="form-control" 
                                name="tahun" id="tahun" required placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Tgl buat</label>
                            <input type="date" value="<?= date('Y-m-d');?>" 
                                class="form-control" required name="tgl_buat" 
                                id="tgl_buat" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Aksi</label>
                            <button type="submit" class="btn btn-primary btn-md btn-block">
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php';?>
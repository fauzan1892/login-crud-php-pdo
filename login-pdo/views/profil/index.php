<?php 
    $id =  $_SESSION['ADMIN']['id_login'];
    $sql = "SELECT * FROM tbl_user WHERE id_login = ?";
    $row = $koneksi->prepare($sql);
    $row->execute(array($id));
    $hasil = $row->fetch();
?>
<div class="row">
    <div class="col-sm-8 mt-5">
        <?php if(!empty($_GET['notif'])){?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong> Update Profil Berhasil !</strong> 
        </div>
        <?php }?>
        <div class="card">
            <div class="card-header">
               <i class="fa fa-edit"></i> Ubah Profil Anda
            </div>
            <div class="card-body">
                <form method="post" action="proses/profil.php?aksi=update">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nama </label>
                                <input type="text" 
                                    value="<?php echo $hasil['nama_pengguna'];?>" 
                                    required class="form-control" 
                                    name="nama_pengguna">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Telepon</label>
                                <input type="number" 
                                    value="<?php echo $hasil['telepon'];?>" 
                                    required class="form-control" 
                                    name="telepon">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" 
                            value="<?php echo $hasil['email'];?>" 
                            required class="form-control" 
                            name="email">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea 
                            name="alamat" 
                            class="form-control" 
                            required><?php echo $hasil['alamat'];?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" 
                                    value="<?php echo $hasil['username'];?>" 
                                    required 
                                    class="form-control" 
                                    name="username">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" value="" 
                                    placeholder="ubah password" 
                                    required 
                                    class="form-control" 
                                    name="password">
                                <input type="hidden" value="<?php echo $hasil['id_login'];?>" 
                                    class="form-control" 
                                    name="id_login">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md">Save</button>
                </form> 
            </div>
        </div>
    </div>
    <div class="col-sm-4 mt-5">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-user"></i> Profil Anda
            </div>
            <div class="card-body text-center">
                <i class="fa fa-user-circle fa-4x"></i>
                <hr>
                <h4><?= $hasil['nama_pengguna'];?></h4>
            </div>
        </div>
    </div>
</div>

<?php
    session_start();
    session_destroy();
    header("location:login.php?signout=sukses"); 
?>
<?php
    session_start();
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    echo "<script> location.href='../index.html';</script>";
    //header("Location: login.php");
?>
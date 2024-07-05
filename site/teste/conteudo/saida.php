<?php
    session_start();
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    echo "<script> location.href='../login.php';</script>";
    //header("Location: login.php");
?>
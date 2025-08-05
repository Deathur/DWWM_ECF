<?php
session_start();
    if (isset($_SESSION['admin'])){
        include 'logout.php';
    }
    else {
        include 'login.php';
    }

?>
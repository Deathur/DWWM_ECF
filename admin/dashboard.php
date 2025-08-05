<?php
    session_start();
    if (isset($_SESSION['admin'])){

    }
    else {
        include 'login.php';
    }

?>
<form method="POST">
    <input type="submit" name="logout" value="Déconnexion">
</form>
<?php
    if (isset($_POST['logout'])){
        session_destroy();
        header("Location: dashboard.php");
    }    
?>
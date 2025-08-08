<?php
    $host = 'localhost';
    $dbname = 'dwwm_ecf';
    $user = 'root';
    $password = '';

    try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Active les erreurs PDO en exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<script>console.log('Connexion réussi !');</script>";
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }

    session_start();

    if (isset($_SESSION['admin'])){
        // Bouton
        echo "<form method='POST'>
                <input type=submit name='changePresta' value='Prestation'>
                <input type=submit name='changeGallery' value='Gallery'>
                <input type=submit name='addPresta' value='Ajouter Prestation'>
                <input type=submit name='addGallery' value='Ajouter Gallery'>
                <input type=submit name='reset' value='Reset'>
            </form>";

        if (isset($_POST['reset'])){
            header("Location: dashboard.php");
        }
        include_once 'addPresta.php';
        include_once 'addGallery.php';
        include_once 'modifPresta.php';
        include_once 'modifGallery.php';
        
        
        

        
        
        
        //Reste
        include 'logout.php';
    }
    else {
        include 'login.php';
    }

?>
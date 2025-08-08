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

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Artisan Local</title>
        <link rel="stylesheet" href="reset.css"> 
        <link rel="stylesheet" href="style.css"> 
    </head>
    <body>
        <header>
            <?php
            include_once "header.php";
            ?>
        </header>
        <main>
            <?php
            include_once "banderole.php";
            include_once "gallery.php";
            ?>           
        </main>
        <footer>
            <?php
            include_once "footer.php";
            ?>
        </footer>
        <script src="script.js"></script>
    </body>
</html>
<?php

/*

*/

?>
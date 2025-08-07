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
        //Partie prestation
        echo '<h2>Prestation</h2>';
        $sqlPresta = "SELECT * FROM `prestation`";
        $stmtPresta = $pdo->prepare($sqlPresta);
        $stmtPresta->execute();
        $resultsPresta = $stmtPresta->fetchAll(PDO::FETCH_ASSOC);
        echo "<div class=flex>";
        foreach ($resultsPresta as $key => $value){
            echo "<div class=cell>";
            foreach($value as $key2=>$value2){
                echo $key2.': '.$value2;
                echo '<br>';
            }
            echo '</div>';
        }
        echo '</div><hr>';
        //Partie Gallery
        echo '<h2>Gallery</h2>';
        $sqlGallery = "SELECT * FROM `gallery`";
        $stmtGallery = $pdo->prepare($sqlGallery);
        $stmtGallery->execute();
        $resultsGallery = $stmtGallery->fetchAll(PDO::FETCH_ASSOC);
        echo "<div class=flex>";
        foreach ($resultsGallery as $key => $value){
            echo "<div class=cell>";
            foreach($value as $key2=>$value2){
                echo $key2.': '.$value2;
                echo '<br>';
            }
            echo '</div>';
        }
        echo '</div><hr>';
        //Reste
        include 'logout.php';
    }
    else {
        include 'login.php';
    }
?>
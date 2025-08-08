<?php
    $sqlGallery = "SELECT * FROM `gallery`";
    $stmtGallery = $pdo->prepare($sqlGallery);
    $stmtGallery->execute();
    $resultsGallery = $stmtGallery->fetchAll(PDO::FETCH_ASSOC);
    echo "<div class=gallery>";
        foreach ($resultsGallery as $key => $value){
            echo "<div class=cellGallery>";
            foreach($value as $key2=>$value2){
                echo '
                
                ';
                echo '<br>';
            }
            echo $lienGallery.': '.$legendeGallery;
            echo '</div>';
        }
        echo '</div><hr>';
?>
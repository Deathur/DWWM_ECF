<?php
    $sqlGallery = "SELECT * FROM `gallery`";
    $stmtGallery = $pdo->prepare($sqlGallery);
    $stmtGallery->execute();
    $resultsGallery = $stmtGallery->fetchAll(PDO::FETCH_ASSOC);
    echo "<div class=gallery>";
        foreach ($resultsGallery as $key => $value){
            echo "<div class=cellGallery>";
            foreach($value as $key2=>$value2){
                if ($key2 == 'lien_Gallery'){
                    $lienGallery = $value2;
                }
                if($key2 == 'legende_Gallery'){
                    $legendeGallery =  $value2;
                }
                echo '<br>';
            }
            echo $lienGallery.': '.$legendeGallery;
            echo '</div>';
        }
        echo '</div><hr>';
?>
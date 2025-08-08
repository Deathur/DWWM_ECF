<?php
    $sqlGallery = "SELECT * FROM `gallery`";
    $stmtGallery = $pdo->prepare($sqlGallery);
    $stmtGallery->execute();
    $resultsGallery = $stmtGallery->fetchAll(PDO::FETCH_ASSOC);
    echo "<div class='gallery' id='gallery'>";
    foreach ($resultsGallery as $key => $value){
        echo "<div class='cellGallery'>";
        foreach($value as $key2=>$value2){
            if ($key2 == 'lien_Gallery'){
                $image = $value2;
            }
            if ($key2 == 'legende_Gallery'){
                $legende = $value2;
            }
        }
        echo '
        <img src="uploads/'. $image .'" alt="'. $legende .'">
        ';
        echo "<div class='textGallery'><p>".$legende."</p></div>";
        echo '</div>';
    }
    echo '</div><hr>';
?>
<?php
    $sqlPresta = "SELECT * FROM `prestation`";
    $stmtPresta = $pdo->prepare($sqlPresta);
    $stmtPresta->execute();
    $resultsPresta = $stmtPresta->fetchAll(PDO::FETCH_ASSOC);
    echo "<div class=prestation>";
        foreach ($resultsPresta as $key => $value){
            echo "<div class=cellPrestation>";
            foreach($value as $key2=>$value2){
                if ($key2 == 'nom_Prestation'){
                    $nomTempo = $value2;
                }
                if($key2 == 'description_Prestation'){
                    $descTempo =  $value2;
                }
                echo '<br>';
            }
            echo $nomTempo.': '.$descTempo;
            echo '</div><hr>';
        }
        echo '</div><hr>';
?>
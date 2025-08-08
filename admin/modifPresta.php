<?php
    if (isset($_POST['changePresta'])){
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
                if ($key2 == 'id_Prestation'){
                    $idSelectionne = $value2;
                }
                echo $key2.': '.$value2;
                echo '<br>';
            }
            echo '<br><a href="dashboard.php?idPresta=' . $idSelectionne . '">Modifier</a>';
            echo '<br><a href="dashboard.php?idSuppPresta=' . $idSelectionne . '">Supprimer</a>';
            echo '</div><hr>';
        }
        echo '</div><hr>';
    }

    if(isset($_GET['idPresta'])){
            
            $id = $_GET['idPresta'];
            $sqlId = "SELECT * FROM prestation WHERE id_Prestation = '$id'";

            $stmtId = $pdo->prepare($sqlId);
            $stmtId->execute();
            
            $resultsId = $stmtId->fetchAll(PDO::FETCH_ASSOC);
            
            echo '<form method="POST">
            <label for="">Nom</label>
            <input type="text" name="nomUpdate" value="' . htmlspecialchars($resultsId[0]['nom_Prestation']) . '">
            <br>
            <label for="">Description</label>
            <input type="text" name="descriptionUpdate" value="' . htmlspecialchars($resultsId[0]['description_Prestation']) . '">
            <br>
            <input type="submit" name="submitPrestaUpdate" Value="Mettre à jour la BDD">
            </form>';
        }
        if(isset($_GET['idSuppPresta'])){
            $id = $_GET['idSuppPresta'];
            
            $sqlId = "DELETE FROM `prestation` WHERE `id_Prestation` = '$id'";

            $stmtId = $pdo->prepare($sqlId);
            $stmtId->execute();
            
            $resultsId = $stmtId->fetchAll(PDO::FETCH_ASSOC);
            header('Location: dashboard.php');
        }
        
        if (isset($_POST['submitPrestaUpdate'])){
            $nomUpdate = $_POST['nomUpdate'];
            $descriptionUpdate = $_POST['descriptionUpdate'];

            $sqlUpdate = "UPDATE `prestation` SET `nom_Prestation`=?,`description_Prestation`=? WHERE `id_Prestation` = '$id'";
            $stmtUpdate = $pdo->prepare($sqlUpdate);
            $stmtUpdate->execute([$nomUpdate, $descriptionUpdate]);

            header("Location: dashboard.php");
        }
?>
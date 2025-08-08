<?php
    if(isset($_POST['changeGallery'])){
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
                if ($key2 == 'id_Gallery'){
                    $idSelectionne = $value2;
                }
                echo $key2.': '.$value2;
                echo '<br>';
            }
            echo '<br><a href="dashboard.php?idGallery=' . $idSelectionne . '">Modifier</a>';
            echo '<br><a href="dashboard.php?idSuppGallery=' . $idSelectionne . '">Supprimer</a>';
            echo '</div><hr>';
        }
    echo '</div><hr>';
    }

    if(isset($_GET['idGallery'])){
            $id = $_GET['idGallery'];
            $sqlId = "SELECT * FROM gallery WHERE id_Gallery = '$id'";

            $stmtId = $pdo->prepare($sqlId);
            $stmtId->execute();
            
            $resultsId = $stmtId->fetchAll(PDO::FETCH_ASSOC);
            
            echo '<form method="POST">
            <label for="">Lien</label>
            <input type="text" name="lienGalleryUpdate" value="' . htmlspecialchars($resultsId[0]['lien_Gallery']) . '">
            <br>
            <label for="">Description</label>
            <input type="legende" name="descriptionGalleryUpdate" value="' . htmlspecialchars($resultsId[0]['legende_Gallery']) . '">
            <br>
            <input type="submit" name="submitGalleryUpdate" Value="Mettre à jour la BDD">
            </form>';
        }
        if(isset($_GET['idSuppGallery'])){
            $id = $_GET['idSuppGallery'];
            
            $sqlId = "DELETE FROM `gallery` WHERE `id_Gallery` = '$id'";

            $stmtId = $pdo->prepare($sqlId);
            $stmtId->execute();
            
            $resultsId = $stmtId->fetchAll(PDO::FETCH_ASSOC);
            header('Location: dashboard.php');
        }
        if (isset($_POST['submitGalleryUpdate'])){
            $lienUpdate = $_POST['lienGalleryUpdate'];
            $descriptionUpdate = $_POST['descriptionGalleryUpdate'];

            $sqlUpdate = "UPDATE `gallery` SET `lien_Gallery`=?,`legende_Gallery`=? WHERE `id_Gallery` = '$id'";
            $stmtUpdate = $pdo->prepare($sqlUpdate);
            $stmtUpdate->execute([$lienUpdate, $descriptionUpdate]);

            header("Location: dashboard.php");
        }
?>
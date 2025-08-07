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
        if (isset($_POST['addPresta'])){
            echo '
            <form method="POST">
                <input type="text" name="nomAddPresta" placeholder="Titre">
                <input type="text" name="descriptionAddPresta" placeholder="Description">
                <input type="submit" name="submitAddPresta" value="Envoyer">
            </form>
            ';
        }

        if (isset($_POST['addGallery'])){
            echo '
            <form method="POST">
                <input type="file" name="lienAddGallery">
                <input type="text" name="descriptionAddGallery" placeholder="Legende">
                <input type="submit" name="submitAddGallery" value="Envoyer">
            </form>
            ';
        }
        if (isset($_POST['submitAddPresta'])){
            $nomAddPresta = htmlspecialchars($_POST['nomAddPresta']);
            $descriptionAddPresta = htmlspecialchars($_POST['descriptionAddPresta']);
            
            $sqlAddPresta = "INSERT INTO `prestation`(`nom_Prestation`, `description_Prestation`) VALUES ('$nomAddPresta','$descriptionAddPresta')";
            $stmtAddPresta = $pdo->prepare($sqlAddPresta);
            
            $stmtAddPresta->execute();
        }
        if (isset($_POST['submitAddGallery'])){
            $lienAddGallery = htmlspecialchars($_POST['lienAddGallery']);
            $descriptionAddGallery = htmlspecialchars($_POST['descriptionAddGallery']);

            $sqlAddPresta = "INSERT INTO `gallery`(`lien_Gallery`, `legende_Gallery`) VALUES ('$lienAddGallery','$descriptionAddGallery')";
            $stmtAddPresta = $pdo->prepare($sqlAddPresta);
            
            $stmtAddPresta->execute();
        }
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
        
        //Reste
        include 'logout.php';
    }
    else {
        include 'login.php';
    }
?>
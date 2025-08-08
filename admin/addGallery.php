<?php
    if(isset($_POST['addGallery'])){
        $sqlUpload = "SELECT lien_Gallery AS 'Lien', legende_Gallery AS 'Legende' FROM `gallery`";
        $stmtUpload = $pdo->prepare($sqlUpload);
        $stmtUpload->execute();
        $resultsUpload = $stmtUpload->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultsUpload AS $key => $value){
            var_dump($resultsUpload);
            echo '<br>';
        }
        echo '<hr>';
        echo '
        <form enctype="multipart/form-data" method="POST">
            <input type="file" name="userfile">
            <input type="text" name="legende">
            <input type="submit" name="fileSubmit" value="Test">
        </form>
        ';
    }

    if (isset($_POST['fileSubmit'])){
        $legende =  $_POST['legende'];
        $uploaddir = '../uploads/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        $filename = basename($_FILES['userfile']['name']);
        $sqlAddImage = "INSERT INTO `gallery`(`lien_Gallery`, `legende_Gallery`) VALUES ('$legende','$filename')";
        $stmtAddImage = $pdo->prepare($sqlAddImage);
        $stmtAddImage->execute();

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            echo "Le fichier est valide, et a été téléchargé
                avec succès. Voici plus d'informations :\n";
        } else {
            echo "Attaque potentielle par téléchargement de fichiers.
                Voici plus d'informations :\n";
        }

        echo 'Voici quelques informations de débogage :';
        print_r($_FILES);

        echo '</pre>';
        header('Location: dashboard.php');
    }
?>
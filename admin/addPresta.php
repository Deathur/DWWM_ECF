<?php
    if (isset($_POST['addPresta'])){
        echo '
        <form method="POST">
            <input type="text" name="nomAddPresta" placeholder="Titre">
            <input type="text" name="descriptionAddPresta" placeholder="Description">
            <input type="submit" name="submitAddPresta" value="Envoyer">
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
?>
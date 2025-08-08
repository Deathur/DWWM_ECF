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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="reset.css"> 
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <?php
        include_once 'header.php';
    ?>
    <hr>
    <hr>
     <form method="POST">
        <input type="text" name="mail" placeholder="Mail">
        <input type="text" name="telephone" placeholder="Téléphone">
        <input type="text" name="message" placeholder="Votre message">
        <input type="submit" name="submitContact">
     </form>
    <?php
        if (isset($_POST['submitContact'])){
            $mail = $_POST['mail'];
            $telephone = $_POST['telephone'];
            $message = $_POST['message'];
            $sqlContact = "INSERT INTO `contact`(`mail_Contact`, `telephone_Contact`, `message_Contact`) VALUES ('$mail','$telephone','$message')";
            $stmtContact = $pdo->prepare($sqlContact);
            $stmtContact->execute();
            header('Location: index.php');
        }
    ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="usernameLogin" placeholder="Pseudo">
        <input type="password" name="passwordLogin" placeholder="Mot de passe">
        <input type="submit" name="loginSubmit" value="Se connecter">
    </form>
    <p><a href="?page=createAccount">Créer un compte</a><p>
</body>
</html>
<?php
if (isset($_POST['loginSubmit'])){
    $username = $_POST['usernameLogin'];
    $password = $_POST['passwordLogin'];
    $sql = "SELECT * FROM `account`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $key => $value){
        if ($username == $value['username_Account'] && password_verify($password, $value['password_Account'])){
            $_SESSION['admin']=[
                "username_Account" => htmlspecialchars($value['username_Account']),
                "password_Account" => htmlspecialchars($value['password_Account'])
            ];
            header("Location: dashboard.php");
        }
        else {
            echo "Erreur";
        }
    }
}
if (isset($_GET['page']) && ($_GET['page'] == 'createAccount')){
            echo '
            <form method="POST">
                <label for="">Nom</label>
                <input type="text" name="pseudoCreate" required>
                <br>
                <label for="">Mot de passe</label>
                <input type="text" name="passwordCreate" required>
                <br>
                <input type="submit" name="submitCreate" value="Créer mon compte">
            </form>
            ';
        }

        if (isset($_POST['submitCreate'])){
            $pseudoCreate = $_POST['pseudoCreate'];
            $passwordCreate = $_POST['passwordCreate'];

            $hachedPasswordCreate = password_hash($passwordCreate, PASSWORD_DEFAULT);

            $sqlCreate = "INSERT INTO `account`(`username_Account`, `password_Account`) VALUES (:pseudo,:password)";
            $stmtCreate = $pdo->prepare($sqlCreate);

            $stmtCreate->bindParam(':pseudo', $pseudoCreate);
            $stmtCreate->bindParam(':password', $hachedPasswordCreate);

            $stmtCreate->execute();
            header("Location: dashboard.php");
        }
?>
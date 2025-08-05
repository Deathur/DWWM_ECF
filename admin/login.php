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
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="usernameLogin" placeholder="Pseudo">
        <input type="password" name="passwordLogin" placeholder="Mot de passe">
        <input type="submit" name="loginSubmit" value="Se connecter">
    </form>
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
        if ($username == $value['username_Account'] && $password == $value['password_Account']){
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
?>
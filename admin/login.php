<?php

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

}
?>
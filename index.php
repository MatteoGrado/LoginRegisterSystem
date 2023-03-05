<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $dsn = 'mysql:dbname=UserDB;host=192.168.8.101';
    $user = 'root';
    $pw = 'Sumafelo03!';
    $con = new PDO($dsn, $user, $pw);
    if(isset($_POST['submit'])) {
        var_dump($_POST);

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['passwort'];
        
        $stmt = $con->prepare("SELECT * FROM user WHERE user=:username OR email=:email");
        $stmt ->bindParam(":username", $username);
        $stmt ->bindParam(":email", $email);
        $stmt ->execute();

        $usersAlreadyExists =$stmt ->fetchColumn();
        if(!$usersAlreadyExists) {
            //start register
            registerUser($username, $email, $passwort);
        } else {
            //user exists
        }
    }
    function registerUser($username, $email, $passwort) {
        global $con;
        $stmt = $con ->prepare("INSERT INTO user(user, email, passwort)VALUES(:username, :email, :passwort)");
        $stmt ->bindParam(":username", $username);
        $stmt ->bindParam(":email", $email);
        $stmt ->bindParam(":passwort", $passwort);
        $stmt ->execute();
        header("Location: home.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1 class="header">Account Erstellen</h1>
    <form action="index.php" method="POST">
        <input type="text" placeholder="Benutzername eingeben" class="Benutzer" name="username" autocomplete="off">
        <input type="text" placeholder="E-Mail eingeben" class="email" name="email" autocomplete="off">
        <input type="password" placeholder="Passwort eingeben" class="pw" name="passwort" autocomplete="off">
        <button type="submit" class="btn1" name="submit">Absenden</button>
    </form>
    <a href="#" class="account1">Hast du schon einen Account?</a>
</body>
</html>
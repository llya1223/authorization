<?php
session_start();
if(isset($_SESSION['name'])) {
   header("Location: home.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

    <form class="container">
        <p>Введите логин</p>
        <input type="text" name="login"><br>
        <p>Введите пароль</p>
        <input type="password" name="password"><br>
        <button type="submit" class="btn-login">Войти</button><br>
        <a href="registry.php">Пройти регистрицию!</a>
        <p class="error"></p>
    </form>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>
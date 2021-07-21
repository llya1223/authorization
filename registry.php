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
    <title>Регистрация</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<form class="container">
    <p>Введите логин</p>
    <input type="text" name="login"><br>

    <p>Введите пароль</p>
    <input type="password" name="password""><br>

    <p>Повторите пароль</p>
    <input type="password" name="confirm_password" "><br>

    <p>Введите email</p>
    <input type="email" name="email"><br>

    <p>Введите Ваше имя</p>
    <input type="text" name="username" autocomplete="off"><br>

    <button type="submit" class="btn-reg">Зарегистрироваться</button><br>
    <a href="index.php">Войти</a>
    <p class="error"></p>
</form>


<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
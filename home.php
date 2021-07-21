<?php
session_start();
if(!isset($_SESSION['name'])) {
    header("Location: index.php");
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
    <p>Добро пожаловать, <? echo $_SESSION['name']; ?> </p>
    <a href="logout.php">Выйти</a>
</form>

</body>
</html>
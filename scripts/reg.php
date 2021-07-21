<?php
session_start();

$salt = "4ffD5|D34";
$login = strip_tags(trim($_POST['login']));
$password = md5($salt.trim($_POST['password']));
$confirm_password = md5($salt.trim($_POST['confirm_password']));
$email = strip_tags(trim($_POST['email']));
$username = strip_tags(trim($_POST['username']));

/*
 * Проверка правильности ввода данных
 */

$isMatched = preg_match('/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/', $_POST['password']);
if (!$isMatched){
    $response = [
        'reg' => false,
        'error' => 'Пароль обязательно должен содержать цифру, буквы в разных регистрах и спец символ - !@#$%^&*'
    ];
    die(json_encode($response));
}
if ($password != $confirm_password){
    $response = [
        'reg' => false,
        'error' => 'Пароли не совподают'
    ];
    die(json_encode($response));
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $response = [
        'reg' => false,
        'error' => 'Email введен некорректно'
    ];
    die(json_encode($response));
}
if (!preg_match('/^[a-zA-Z0-9]{6,}/iu',$login)){
    $response = [
        'reg' => false,
        'error' => 'Логин может содержать только цифры и буквы латинского алфавита, и должен быть больше 6 символов'
    ];
    die(json_encode($response));
}
if (!preg_match('/^[а-яёА-ЯЁ0-9]{2,}/iu',$username)){
    $response = [
        'reg' => false,
        'error' => 'Имя может содержать только цифры или буквы русского алфавита, и должен быть больше 2 символов'
    ];
    die(json_encode($response));
}


/*
 * Подключение к XML и проверка логина с email на уникальность
 */

$a =  file_get_contents( '../db/db.xml');

if (strripos($a, $email)){
    $response = [
        'reg' => false,
        'error' => 'Такой email уже существует'
    ];
    die(json_encode($response));
}

$xml = <<<XML
$a
XML;
$sxe = new SimpleXMLElement($xml);

$path = "//user[@login='".$login."']";
$categoryAttributes = $sxe->xpath($path);

if ($categoryAttributes){
    $response = [
        'reg' => false,
        'error' => 'Такой логин уже существует'
    ];
    die(json_encode($response));
}else{
    $user = $sxe->addChild('user');
    $user->addAttribute('login', $login);
    $user->addChild('name', $username);
    $user->addChild('password', $password);
    $user->addChild('email', $email);

    $file = fopen('../db/db.xml', 'w');
    fwrite($file, $sxe->asXML());
    fclose($file);
    $_SESSION['name'] = $username;
    $response = [
        'reg' => true
    ];
    die(json_encode($response));
}






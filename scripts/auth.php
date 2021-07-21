<?php
session_start();

$salt = "4ffD5|D34";

$login = strip_tags(trim($_POST['login']));
$password = md5($salt . trim($_POST['password']));

$a = file_get_contents("../db/db.xml");

$xml = <<<XML
$a
XML;
$sxe = new SimpleXMLElement($xml);

$path = "//user[@login='" . $login . "']";
$categoryAttributes = $sxe->xpath($path);

if ($categoryAttributes) {
    $password_bd = $sxe->xpath($path."/password")[0];
    if ($password == $password_bd){
        $name = (string)$sxe->xpath($path."/name")[0];
        $_SESSION['name'] = $name;

        $response = [
            'auth' => true
        ];
    }
    else{
        $response = [
            'auth' => false,
            'error' => 'Пароль введен не верно'
        ];
    }

} else {
    $response = [
        'auth' => false,
        'error' => 'Логина не существует'
    ];
}

echo json_encode($response);
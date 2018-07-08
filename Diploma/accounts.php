<?php
require_once './functions.php';
require_once 'C:\xampp\htdocs\Netology\Diploma\vendor\autoload.php';

$pdo = new PDO("mysql:host=localhost;dbname=diploma;charset=utf8", "root", "");

if (isset($_COOKIE['user'])) {
  
    $admin = $_COOKIE['user'];

}
 else {
    echo 'Ошибка авторизации';
    die;
}

if (isset($_POST['addAdmin'])) {
    
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
    
    addAdmin($pdo, $login, $password);

}

//************Вывод шаблона *****************************
initTwig('accounts.tmpl', 
        array(
        'admins'=> getAdminsList($pdo),
        'admin'=>$admin
      )
);

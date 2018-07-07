<?php
require_once './functions.php';
require_once 'C:\xampp\htdocs\Netology\Homework16\vendor\autoload.php';

session_start();

$errors = [];
//$pdo = new PDO("mysql:host=localhost;dbname=diploma;charset=utf8", "root", "");

if (route_login($errors)) {
  
    redirect('index.php?user=' . $_SESSION['user']['login'] . '&PHPSESSID=' . $_COOKIE[PHPSESSID]);

}
 else {
//    foreach ($errors as $error) {
//        echo $error;
//    }
}

initTwig('login.tmpl', 
        array(
        'errors'=>$errors
        )
);

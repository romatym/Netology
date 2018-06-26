<?php
require_once './functions.php';
require_once 'C:\xampp\htdocs\Netology\Homework16\vendor\autoload.php';

session_start();

$errors = [];
if (!empty($_POST['login']) && !empty($_POST['password'])) {

    $pdo = new PDO("mysql:host=localhost;dbname=homework13;charset=utf8", "root", "");
    
    if (empty($_POST['sign_in'])) {
        
        if (register($pdo, $_POST['login'], $_POST['password'])) {
            $new_user = getUser($pdo, $_POST['login']);
            redirect('index.php?user_id='.$new_user['id'].'&user='.$new_user[login].'&PHPSESSID='.$_COOKIE[PHPSESSID]);
            die;
        } else {
            $errors[] = 'Такой логин уже есть';
            //echo 'Такой логин уже есть';
        }
    }
    else {
        if (login($pdo, $_POST['login'], $_POST['password'])) {
            redirect('index.php?user_id='.$_SESSION['user']['id'].'&user='.$_SESSION['user'][login].'&PHPSESSID='.$_COOKIE[PHPSESSID]);
            die;
        } else {
            $errors[] = 'Неверные логин или пароль';
        }
    }
}

initTwig('login.tmpl', 
        array(
        'errors'=>$errors
        )
);
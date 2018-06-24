<?php
require_once './functions.php';
require_once 'C:\xampp\htdocs\Netology\Homework16\vendor\autoload.php';

session_start();

$errors = [];
if (!empty($_POST['login']) && !empty($_POST['password'])) {

    if (empty($_POST['sign_in'])) {
        
        if (register($_POST['login'], $_POST['password'])) {
            $new_user = getUser($_POST['login']);
            redirect('index.php?user_id='.$new_user['id'].'&user='.$new_user[login].'&PHPSESSID='.$_COOKIE[PHPSESSID]);
            die;
        } else {
            $errors[] = 'Такой логин уже есть';
            //echo 'Такой логин уже есть';
        }
    }
    else {
        if (login($_POST['login'], $_POST['password'])) {
            redirect('index.php?user_id='.$_SESSION['user']['id'].'&user='.$_SESSION['user'][login].'&PHPSESSID='.$_COOKIE[PHPSESSID]);
            die;
        } else {
            $errors[] = 'Неверные логин или пароль';
        }
    }
}

try {
  // указывае где хранятся шаблоны
  $loader = new Twig_Loader_Filesystem('templates');

  // инициализируем Twig
  $twig = new Twig_Environment($loader);

  // подгружаем шаблон
  $template = $twig->loadTemplate('login.tmpl');

  // передаём в шаблон переменные и значения
  // выводим сформированное содержание
  echo $template->render(array(
      'errors'=>$errors
    ));

} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}
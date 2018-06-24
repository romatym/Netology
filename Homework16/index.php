<?php
   
require_once '.\functions.php';
require_once 'C:\xampp\htdocs\Netology\Homework16\vendor\autoload.php';

$pdo = new PDO("mysql:host=localhost;dbname=homework13;charset=utf8", "root", "");

//************Проверка авторизации *****************************
if (isset($_GET['user'])) {
    if (isset($_GET['PHPSESSID']) && $_GET['PHPSESSID']=$_COOKIE['PHPSESSID']) {
        $user = $_GET['user'];
        setcookie('user', $_GET['user'], time()+3600);
        setcookie('user_id', $_GET['user_id'], time()+3600);
    } else {
        echo 'Ошибка авторизации';
        die;
    }
}
elseif (!isset($_COOKIE['user'])) {    
    echo 'Пользователь не авторозован';
    header("Location: login.php");
}

//************Проверка всех возможных действий *****************************
if (isset($_POST['description'])) {
    
    $description = (string)$_POST['description'];
    
    addTask($pdo, $description);

}
    
if (isset($_REQUEST['action']) && isset($_REQUEST['id'])) {
    
    $action = (string) $_REQUEST['action'];
    $action_id = (int) $_REQUEST['id'];
    
    changeTask($pdo, $action, $action_id);
    
}

if (isset($_REQUEST['assign'])) {
        
    $assigned_user_id = (int)$_REQUEST['assigned_user_id'];
    $row_id = (int)$_REQUEST['row_id'];
        
    assignTask($pdo, $assigned_user_id, $row_id);
}
    
//************Вывод шаблона *****************************
try {
  // указывае где хранятся шаблоны
  $loader = new Twig_Loader_Filesystem('templates');

  // инициализируем Twig
  $twig = new Twig_Environment($loader);

  // подгружаем шаблон
  $template = $twig->loadTemplate('tasks.tmpl');

  // передаём в шаблон переменные и значения
  // выводим сформированное содержание
  echo $template->render(array(
      'tasks'=> getTasks($pdo),
      'user'=>$user,
      'users'=>getUsersList($pdo)
    ));

} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}

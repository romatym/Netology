<?php
   
require_once '.\functions.php';
require_once 'C:\xampp\htdocs\Netology\Homework16\vendor\autoload.php';

$pdo = new PDO("mysql:host=localhost;dbname=diploma;charset=utf8", "root", "");

//************Проверка авторизации *****************************
if (isset($_GET['user'])) {
    if (isset($_GET['PHPSESSID']) && $_GET['PHPSESSID']=$_COOKIE['PHPSESSID']) {
        $user = $_GET['user'];
        setcookie('user', $_GET['user'], time()+3600);
        //setcookie('user_id', $_GET['user_id'], time()+3600);
    }
}
elseif (isset($_COOKIE['user'])) {    
    $user = $_COOKIE['user'];
}

if (isset($_GET['category'])) {
    $category_id = $_GET['category'];
}
 else {
    $category_id = 1;
}

//************Вывод шаблона *****************************
initTwig('index.tmpl', 
        array(
        'tree'=>getTree($pdo),
        'categories'=>getCategories($pdo),
        'selectedCategory'=>$category_id
      )
);

//************Проверка всех возможных действий *****************************
//if (isset($_POST['description'])) {
//    
//    $description = (string)$_POST['description'];
//    
//    addTask($pdo, $description);
//
//}
//    
//if (isset($_REQUEST['action']) && isset($_REQUEST['id'])) {
//    
//    $action = (string) $_REQUEST['action'];
//    $action_id = (int) $_REQUEST['id'];
//    
//    if ($action == 'done') {
//        setDoneTask($pdo, $action_id);
//    } elseif ($action == 'delete') {
//        deleteTask($pdo, $action_id);
//    }
//    
//}
//
//if (isset($_REQUEST['assign'])) {
//        
//    $assigned_user_id = (int)$_REQUEST['assigned_user_id'];
//    $row_id = (int)$_REQUEST['row_id'];
//        
//    assignTask($pdo, $assigned_user_id, $row_id);
//}
    


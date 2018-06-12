<?php

function login($login, $password) {
    $user = getUser($login);
    if ($user && $user['password'] === $password) {
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}

/**
 * Реализует механизм авторизации
 * @param $login
 * @param $password
 */
function register($login, $password) {
      
    //проверим, что нет пользователя с таким именем    
    $table = getUser($login);
    if ($table) {
        return false;
    }

    //запишем пользователя в таблицу
    $pdo = new PDO("mysql:host=localhost;dbname=homework13;charset=utf8", "root", "");
    $sql = "INSERT INTO users (login, password) VALUES (?,?)";
    $stmt = $pdo->prepare($sql);
    $affected = $stmt->execute([$login, $password]);
    if ($affected > 0) {
        $_SESSION['user'] = $login;
        return true;
    }
    return false;
}

/**
 * Получение всех пользователей из бд
 * @return array|mixed
 */
function getUser($user) {
    
    $pdo = new PDO("mysql:host=localhost;dbname=homework13;charset=utf8", "root", "");
    
//    $sql = "SELECT * FROM users WHERE login = ? ";
//    $stmt = $pdo->prepare($sql);
//    $stmt->execute([$user]);
//    $table = $stmt->fetchAll(PDO::FETCH_ASSOC);  
//    foreach ($table as $row) {
//        echo($row['login']);
//    }    
    
    $sql = "SELECT * FROM users where login = '".$user."'";
    //$sql = "SELECT * FROM users where login = ':user'";
    $table = $pdo->query($sql);
    foreach ($table as $row) {
        return $row;
    }
    
    if (!$table) {
        return $table['login'];
    } else {
        return NULL;
    }
    
}

/**
 * Является ли пользователь авторизованным
 * @return bool
 */
function isAuthorized()
{
    return !empty($_SESSION['user']);
}

function isAdmin()
{
    return isAuthorized() && $_SESSION['user']['is_admin'];
}

function redirect($page) {
    header("Location: $page");
    die;
}
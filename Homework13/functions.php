<?php
session_start();
/**
 * Реализует механизм авторизации
 * @param $login
 * @param $password
 */
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
    $pdo = new PDO("mysql:host=localhost;dbname=homework13;charset=utf8", "root", "");
    $sql = "SELECT * FROM users where user = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$login]);    
    $table = $stmt->fetchAll();

    if (!empty($table)) {
        return false;
    }

    //запишем пользователя в таблицу
    $sql = "INSERT INTO users (user, password) VALUES (?,?)";
    $stmt = $pdo->prepare($sql);
    $affected = $stmt->execute([$login, $password]);
    if ($affected > 0) {
        $_SESSION['user'] = $login;
        return true;
    }
    return false;
}

/**
 * Получение пользователя по его логину
 * @param $login
 * @return mixed|null
 */
function getUser($login) {
    $users = getUsers();
    foreach ($users as $user) {
        if ($login === $user['login']) {
            return $user;
        }
    }
    return null;
}

/**
 * Получение всех пользователей из бд
 * @return array|mixed
 */
function getUsers($user) {
    
    $pdo = new PDO("mysql:host=localhost;dbname=homework13;charset=utf8", "root", "");
    $sql = "SELECT * FROM users where user = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user]);    
    $table = $stmt->fetchAll();

    if (!empty($table)) {
        return $table;
    }
    
    $userData = file_get_contents(__DIR__ . '/data/users.json');
    if (!$userData) {
        return [];
    }
    $users = json_decode($userData, true);
    if (!$users) {
        return [];
    }

    return $users;
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
    header("Location: $page.php");
    die;
}
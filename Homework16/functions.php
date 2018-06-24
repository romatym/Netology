<?php

function login($login, $password) {
    $user = getUser($login);
    if ($user && $user['password'] === $password) {
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}

function addTask($pdo, $description) {
    
    $current_date = date("Y-m-d H:i:s");
    $user_id = $_COOKIE['user_id'];
    $sql = "INSERT INTO tasks (description, date_added, is_done, user_id) VALUES (?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$description, $current_date, 0, $user_id]);
    
    if (!$result) {
        return($stmt->errorInfo());
    }  
    
}

function changeTask($pdo, $action, $action_id) {
    
    if ($action == 'done') {
        $sql = "UPDATE tasks SET is_done = 1 where id = ?";
    } elseif ($action == 'delete') {
        $sql = "delete from tasks where id = ?";
    }

    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$action_id]);

    if (!$result) {
        return($stmt->errorInfo());
    }
}

function assignTask($pdo, $user_id, $row_id) {
    
    $sql = "UPDATE tasks SET assigned_user_id = ? where id = ?";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$user_id, $row_id]);

    if (!$result) {
        return($stmt->errorInfo());
    }
}

function getTasks($pdo) {
    
    $sql = "SELECT tasks.id, tasks.description, tasks.date_added, tasks.is_done, 
                users.id as user_id, users.login as login, tasks.assigned_user_id as assigned_user_id, users_ass.login as assigned_user_login
                FROM tasks 
                LEFT JOIN users on users.id = tasks.user_id
                LEFT JOIN users as users_ass on users_ass.id = tasks.assigned_user_id
                ";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute();
    
    if (!$result) {
        return($stmt->errorInfo());
    }
    return $stmt->fetchAll();
}

function getUsersList($pdo) {
    
    $sql = "SELECT login, id FROM users";
    
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute();
    
    if (!$result) {
        return($stmt->errorInfo());
    }
    return $stmt->fetchAll();
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
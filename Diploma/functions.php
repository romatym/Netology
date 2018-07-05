<?php

function initTwig($Template, $params) {
    try {
      // указывае где хранятся шаблоны
      $loader = new Twig_Loader_Filesystem('templates');

      // инициализируем Twig
      $twig = new Twig_Environment($loader);

      // подгружаем шаблон
      $template = $twig->loadTemplate($Template);

      // передаём в шаблон переменные и значения
      // выводим сформированное содержание
      echo $template->render($params);

    } catch (Exception $e) {
      die ('ERROR: ' . $e->getMessage());
    }
}

function route_login(&$errors) {
    
    if (!empty($_POST['login']) && !empty($_POST['password'])) {

        $pdo = new PDO("mysql:host=localhost;dbname=diploma;charset=utf8", "root", "");
        
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
        
        if (!empty($_POST['sign_in'])) {
            $aaa = route_sign_in($pdo, $login, $password, $errors);
            return $aaa;
        }
        elseif (!empty($_POST['register'])) {
            return route_register($pdo, $login, $password, $errors);
        }
        else {
            return FALSE;
        }
    }

    return FALSE;
}

function route_register($pdo, $login, $password, $errors) {

    if (register($pdo, $_POST['login'], $_POST['password'])) {
        
        return TRUE;
        //$_SESSION['user_login'] = $new_user['login'];
        //redirect('index.php?user_id=' . $new_user['id'] . '&user=' . $new_user[login] . '&PHPSESSID=' . $_COOKIE[PHPSESSID]);
        //die;
    } else {
        $errors[] = 'Такой логин уже есть';
        return FALSE;
    }
}

function route_sign_in($pdo, $login, $password, &$errors) {
    
    if (login($pdo, $_POST['login'], $_POST['password'])) {
        return TRUE;
//        redirect('index.php?user_id=' . $_SESSION['user']['id'] . '&user=' . $_SESSION['user'][login] . '&PHPSESSID=' . $_COOKIE[PHPSESSID]);
//        die;
    } else {
        $errors[] = 'Неверные логин или пароль';
        return FALSE;
    }
}

function login($pdo, $login, $password) {
    $user = getUser($pdo, $login);
    if ($user && $user['password'] === $password) {
        $_SESSION['user'] = $user;
        return TRUE;
    }
    return FALSE;
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

function setDoneTask($pdo, $action_id) {
    
    $sql = "UPDATE tasks SET is_done = 1 where id = ?";

    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$action_id]);

    if (!$result) {
        return($stmt->errorInfo());
    }
}

function deleteTask($pdo, $action_id) {
    
    $sql = "delete from tasks where id = ?";

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
function register($pdo, $login, $password) {
      
    //проверим, что нет пользователя с таким именем    
    $table = getUser($login);
    if ($table) {
        return false;
    }

    //запишем пользователя в таблицу
    //$pdo = new PDO("mysql:host=localhost;dbname=homework13;charset=utf8", "root", "");
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
function getUser($pdo, $user) {
    
    //$pdo = new PDO("mysql:host=localhost;dbname=homework13;charset=utf8", "root", "");
    
//    $sql = "SELECT * FROM users WHERE login = ? ";
//    $stmt = $pdo->prepare($sql);
//    $stmt->execute([$user]);
//    $table = $stmt->fetchAll(PDO::FETCH_ASSOC);  
//    foreach ($table as $row) {
//        echo($row['login']);
//    }    
    
    $sql = "SELECT id, login, password FROM users where login = '".$user."'";
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
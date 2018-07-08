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

function getCategoryByName($pdo, $name) {
    
    $sql = "SELECT id, name FROM categories where name='".$name."'";
    //$sql = "SELECT * FROM users where login = ':user'";
    $table = $pdo->query($sql);
    foreach ($table as $row) {
        return $row['id'];
    }    

}

function getCategories($pdo) {
    
    $sql = "SELECT id, name FROM categories";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute();
    
    if (!$result) {
        return($stmt->errorInfo());
    }
    $table = [];
    foreach ($stmt->fetchAll() as $key => $value) {
        $table[$value['id']] = $value;
    }
    return $table;
}

function getTree($pdo) {
    
    $Categories = getCategories($pdo);
    $Questions = getQuestions($pdo);
    $tree = [];
    foreach ($Categories as $key1 => $value1) {
        $branch = [];
        foreach ($Questions as $key2 => $value2) {
            if ($value1['id'] == $value2['category_id']) {
                $branch[] = $value2;
            }
        }
        $tree[$value1['id']] = $branch;
    }

    return $tree;
}

function getQuestions($pdo) {
    
    $sql = "SELECT questions.id, questions.question, questions.topic, questions.date, questions.email, questions.publish, questions.author,
            admins.login,
            questions.category_id, categories.name as category
            FROM questions
            LEFT JOIN admins on admins.id = questions.admin_id
            LEFT JOIN categories on categories.id = questions.category_id";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute();
    
    if (!$result) {
        return($stmt->errorInfo());
    }
    return $stmt->fetchAll();
}

function addQuestion($pdo, $category, $name, $email, $topic, $question) {
    
    $categoryId = getCategoryByName($pdo, $category);
    
    $sql = "INSERT INTO questions (category, author, email, topic, question, date) VALUES (?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$categoryId, $name, $email, $topic, $question, date("Y-m-d H:i:s")]);
    
    if (!$result) {
        $a = $stmt->errorInfo();
        return($a);
    }  
    
}

function addAdmin($pdo, $login, $password) {
    
    $sql = "INSERT INTO admins (login, password) VALUES (?,?)";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$login, $password]);
    
    if (!$result) {
        return($stmt->errorInfo());
    }  
    
}

function setPassword($pdo, $login, $password) {
    
    $sql = "UPDATE admins SET password = ? where login = ?";

    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$password, $login]);

    if (!$result) {
        return($stmt->errorInfo());
    }
}

function deleteUser($pdo, $login) {
    
    $sql = "delete from admins where login = ?";

    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$login]);

    if (!$result) {
        return($stmt->errorInfo());
    }
}

function getAdminsList($pdo) {
    
    $sql = "SELECT login, id FROM admins";
    
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
    
    $sql = "SELECT id, login, password FROM admins where login = '".$user."'";
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
<?php
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
        //redirect('index');
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

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Авторизация</title>
</head>
<body>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-wrap">
                    <h1>Авторизация</h1>
                    <ul>
                        <?php foreach ($errors as $error) { ?>
                        <li><?php echo($error) ?></li>
                        <?php } ?>
                    </ul>
                    <form method="POST">
                        <div class="form-group">
                            <label for="lg" class="sr-only">Логин</label>
                            <input type="text" placeholder="Логин" name="login" id="lg" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">Пароль</label>
                            <input type="password" placeholder="Пароль" name="password" id="key" class="form-control">
                        </div>
                        <input type="submit" name="sign_in" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Вход">
                        <input type="submit" name="register" id="btn-register" class="btn btn-custom btn-lg btn-block" value="Регистрация">
                    </form>

                    <hr>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
</body>
</html>
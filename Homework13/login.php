<?php
session_start();

include_once './functions.php';

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
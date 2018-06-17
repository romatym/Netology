<?php
   
    $pdo = new PDO("mysql:host=localhost;dbname=homework13;charset=utf8", "root", "");
    $sql = "SELECT login, id FROM users";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();    
    $users = $stmt->fetchAll();

    if (isset($_POST['description'])) {
        $description_value = (string)$_POST['description'];
        $current_date = date("Y-m-d H:i:s");
        $user_id = $_COOKIE['user_id'];
        $sql = "INSERT INTO tasks (description, date_added, is_done, user_id) VALUES (?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$description_value, $current_date, 0, $user_id]);
    }
    if (isset($_GET['user'])) {
        if (isset($_GET['PHPSESSID']) && $_GET['PHPSESSID']=$_COOKIE['PHPSESSID']) {
            setcookie('user', $_GET['user'], time()+3600);
            setcookie('user_id', $_GET['user_id'], time()+3600);
        } else {
            echo 'Ошибка авторизации';
            die;
        }
    } 
    else {
            echo 'Пользователь не авторозован';
            header("Location: login.php");
    }
    
    if (isset($_REQUEST['action']) && isset($_REQUEST['id'])) {
        $action_value = (string)$_REQUEST['action'];
        $action_id = (int)$_REQUEST['id'];
        if ($action_value == 'done') {
            $sql = "UPDATE tasks SET is_done = 1 where id = ?";
        }
        elseif ($action_value == 'delete') {
            $sql = "delete from tasks where id = ?";
        }
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$action_id]);
    }
    
    if (isset($_REQUEST['assign'])) {
        $assigned_user_id = (int)$_REQUEST['assigned_user_id'];
        $row_id = (int)$_REQUEST['row_id'];
        
        $sql = "UPDATE tasks SET assigned_user_id = ? where id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$assigned_user_id, $row_id]);
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <style>
            table { 
                border-spacing: 0;
                border-collapse: collapse;
            }

            table td, table th {
                border: 1px solid #ccc;
                padding: 5px;
            }

            table th {
                background: #eee;
            }
        </style>
    </head>
    <body>
        
        <h1>Здравствуйте, <?php echo($_COOKIE['user']) ?>! Вот общий список задач:</h1>
        
        <form method="POST">
            <input type="text" name="description" placeholder="Описание задачи" value="" />
            <input type="submit" name="save" value="Добавить" />
        </form>
        <br>
        
        <!--таблица 1-->
        <table>
            <tr>
                <th>Описание задачи</th>
                <th>Дата добавления</th>
                <th>Статус</th>
                <th>Действие</th>
                <th>Автор</th>
                <th>Ответственный</th>
                <th>Назначить ответственного</th>
            </tr>
                    
        <?php
        
            $pdo = new PDO("mysql:host=localhost;dbname=homework13;charset=utf8", "root", "");
            $sql = "SELECT tasks.id, tasks.description, tasks.date_added, tasks.is_done, 
                users.id as user_id, users.login as login, tasks.assigned_user_id as assigned_user_id, users_ass.login as assigned_user_login
                FROM tasks 
                LEFT JOIN users on users.id = tasks.user_id
                LEFT JOIN users as users_ass on users_ass.id = tasks.assigned_user_id
                ";
            
            $table = $pdo->query($sql);
            
            if (!empty($table)) {
                foreach ($table as $row) {
        ?>
                
            <tr>
                <td><?php echo($row['description']) ?></td>
                <td><?php echo($row['date_added']) ?></td>
                <td><span style='color: orange;'><?php echo(($row['is_done'] == 0) ? 'В процессе' : 'Выполнено') ?></span></td>
                <td>
                    <a href='?id=<?php echo($row['id']) ?>&action=done'>Выполнить</a>
                    <a href='?id=<?php echo($row['id']) ?>&action=delete'>Удалить</a>
                </td>
                <td><?php echo($row['login']) ?></td>
                <td><?php echo($row['assigned_user_login']) ?>
                    
                </td>
                <td>
                    <form method='POST'>
                        <select name='assigned_user_id'>
                            <?php
                            if (!empty($users)) {
                                foreach ($users as $user1) {
                                    ?>
                                    <option value='<?php echo($user1['id']) ?>'><?php echo($user1['login']) ?></option>
                                <?php
                                }
                            }
                            ?>
                        </select>

                        <input type='submit' name='assign' value='Назначить'/>
                        <input type="hidden" name="row_id" value='<?php echo($row['id']) ?>'>
                    </form>                    
                </td>
            </tr>
                
        <?php
                }    
            }
        ?>
                
        </table>
        
        <br>
        
        <!--таблица 2-->
        <h1>Задачи, за которые вы ответственны:</h1>
        <table>
            <tr>
                <th>Описание задачи</th>
                <th>Дата добавления</th>
                <th>Статус</th>
                <th>Автор</th>
                <th>Ответственный</th>
            </tr>
                    
        <?php
        
            $pdo = new PDO("mysql:host=localhost;dbname=homework13;charset=utf8", "root", "");
            $sql = "SELECT tasks.id, tasks.description, tasks.date_added, tasks.is_done, 
                users.id as user_id, users.login as login, tasks.assigned_user_id as assigned_user_id, users_ass.login as assigned_user_login
                FROM tasks 
                LEFT JOIN users on users.id = tasks.user_id
                LEFT JOIN users as users_ass on users_ass.id = tasks.assigned_user_id
                where tasks.assigned_user_id = '".$_COOKIE['user_id']."'";
            
            $table = $pdo->query($sql);
            
            if (!empty($table)) {
                foreach ($table as $row) {
        ?>
                
            <tr>
                <td><?php echo($row['description']) ?></td>
                <td><?php echo($row['date_added']) ?></td>
                <td><span style='color: orange;'><?php echo(($row['is_done'] == 0) ? 'В процессе' : 'Выполнено') ?></span></td>
                <td><?php echo($row['login']) ?></td>
                <td><?php echo($row['assigned_user_login']) ?></td>
            </tr>
                
        <?php
                }    
            }
        ?>
                
        </table>
        
        <br>
        
        <a href="logout.php">Выход</a> </li>
        
    </body>
</html>

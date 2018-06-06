<?php
    if (isset($_POST['description'])) {
        $description_value = (string)$_POST['description'];
        $current_date = date("Y-m-d H:i:s");
        $pdo = new PDO("mysql:host=localhost;dbname=homework12;charset=utf8", "root", "");
        $sql = "INSERT INTO tasks (description, date_added, is_done) VALUES (?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$description_value, $current_date, 0]);
        
        $vasya = $stmt->fetch();
    }
if (isset($_REQUEST['action']) && isset($_REQUEST['id'])) {
        $action_value = (string)$_REQUEST['action'];
        $action_id = (int)$_REQUEST['id'];
        $pdo = new PDO("mysql:host=localhost;dbname=homework12;charset=utf8", "root", "");
        if ($action_value == 'done') {
            $sql = "UPDATE tasks SET is_done = 1 where id = ?";
        }
        elseif ($action_value == 'delete') {
            $sql = "delete from tasks where id = ?";
        }
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$action_id]);
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
        
        <h1>Список дел:</h1>
        
        <form method="POST">
            <input type="text" name="description" placeholder="Описание задачи" value="" />
            <input type="submit" name="save" value="Добавить" />
        </form>
        <br>
        
        <table>
            <tr>
                <th>Описание задачи</th>
                <th>Дата добавления</th>
                <th>Статус</th>
                <th></th>
            </tr>
                    
        <?php
        
            $pdo = new PDO("mysql:host=localhost;dbname=homework12;charset=utf8", "root", "");
            $sql = "SELECT * FROM tasks";
            
            $table = $pdo->query($sql);
            
            if (!empty($table)) {
                
                
                
                foreach ($table as $row) {
                    
        ?>
                
            <tr>
                <td><?php echo($row['description']) ?></td>
                <td><?php echo($row['date_added']) ?></td>
                <td><span style='color: orange;'><?php echo(($row['is_done']==0) ? 'В процессе' : 'Выполнено') ?></span></td>
                <td>
                    <a href='?id=<?php echo($row['id']) ?>&action=done'>Выполнить</a>
                    <a href='?id=<?php echo($row['id']) ?>&action=delete'>Удалить</a>
                </td>
            </tr>
                
        <?php
                
                }    
            }
        
        ?>
                
        </table>
                
    </body>
</html>

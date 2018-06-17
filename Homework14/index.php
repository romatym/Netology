<?php

$pdo = new PDO("mysql:host=localhost;dbname=homework14;charset=utf8", "root", "");

if (isset($_POST['TableName'])) {

    $TableName = $_POST['TableName'];
    $sql = "CREATE TABLE `".$TableName."` ("
            . "id INT NOT NULL AUTO_INCREMENT, "
            . "name varchar(150) NULL, "
            . "primary key (`id`) "
            . ") "
            . "ENGINE=InnoDB DEFAULT charset=utf8;";
    
    $stmt = $pdo->prepare($sql);
    if (!$stmt) {
        echo "\nPDO::errorInfo(): ";
        print_r($pdo->errorInfo());
    }
    $result = $stmt->execute();
    if (!$result) {
        echo "\nPDO::errorInfo(): ";
        print_r($stmt->errorInfo());
    }
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
            .CreateTable p {display: inline-block;}
        </style>
    </head>
    <body>
        
        <br>
        <table>
            <tr>
                <th>Таблицы в homework14</th>
            </tr>
                    
        <?php
        
            $pdo = new PDO("mysql:host=localhost;dbname=homework14;charset=utf8", "root", "");
            $sql = "show tables";
            
            $table = $pdo->query($sql);
            
            if (!empty($table)) {
                foreach ($table as $row) {
                ?>
                    <tr>
                        <td><a href='table.php?table=<?php echo($row['Tables_in_homework14']) ?>&action=open'><?php echo($row['Tables_in_homework14']) ?></a></td>
                    </tr>
                <?php
                }    
            }
        ?>
        </table>

        <br>
        <form method="post" class="CreateTable">
            <p>Создать таблицу: <input type="text" name="$TableName"/></p>
            <button type="submit" name="CreateTable">Создать</button>
        </form>
    </body>
</html>

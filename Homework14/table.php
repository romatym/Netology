<?php
if (isset($_GET['table'])) {

    $TableName = $_GET['table'];

}
else {
    die;
}

if (isset($_GET['action']) && $_GET['action']=='delete') {
    $column = $_GET['id'];
    
    $pdo = new PDO("mysql:host=localhost;dbname=homework14;charset=utf8", "root", "");
    $sql = "ALTER TABLE ".$TableName." DROP COLUMN ".$column.";"; 
    //$sql = "ALTER TABLE ? DROP COLUMN ? "; 
    
    $stmt = $pdo->prepare($sql);
    if (!$stmt) {
        echo "\nPDO::errorInfo(): ";
        print_r($pdo->errorInfo());
    }
    //$result = $stmt->execute(array($TableName, $column));
    $result = $stmt->execute();
    if (!$result) {
        echo "\nPDO::errorInfo(): ";
        print_r($stmt->errorInfo());
    }
}

if (isset($_POST['change'])) {

    $field = $_POST['field'];
    $name = $_POST['newName'];
    $type = $_POST['newType'];

    $pdo = new PDO("mysql:host=localhost;dbname=homework14;charset=utf8", "root", "");
    $sql = "ALTER TABLE `".$TableName."` CHANGE ".$field." ".$name." ".$type; 
    
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
        </style>
    </head>
    <body>
        
        <br>
        <form method="POST">
        <table>
            <tr>
                <th>Имя поля</th>
                <th>Тип</th>
                <th>Изменить</th>
                <th>Тип</th>
                <th></th>
                <th></th>
            </tr>
                    
        <?php
        
            $pdo = new PDO("mysql:host=localhost;dbname=homework14;charset=utf8", "root", "");
            $sql = "DESCRIBE `".$TableName."`";
            
            $table = $pdo->query($sql);
            
            if (!empty($table)) {
                foreach ($table as $row) {
                ?>
                    <tr>
                        <td><?php echo($row['Field']) ?></td>
                        <td><?php echo($row['Type']) ?></td>
                        <td>
                            <input type="text" name="newName" placeholder="Новое имя" value="" />
                        </td>
                        <td>
                            <select name="newType">
                                <option value="int">int</option>
                                <option value="varchar(100)">varchar</option>
                            </select>
                        </td>
                        <td>
                            <input type="submit" name="change" value="Изменить"/>
                            <input type="hidden" name="field" value="<?php echo($row['Field']) ?>"/>
                        </td>
                        <td>
                            <a href='?id=<?php echo($row['Field']) ?>&table=<?php echo($TableName) ?>&action=delete'>Удалить</a>
                        </td>
                    </tr>
                <?php
                }    
            }
        ?>
        </table>
        </form>

    </body>
</html>

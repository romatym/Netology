<?php

if (isset($_POST['$TableName'])) {

    $TableName = $_POST['$TableName'];
    $pdo = new PDO("mysql:host=localhost;dbname=homework14;charset=utf8", "root", "");
    $sql = "CREATE TABLE `".$TableName."` ("
            . "id INT NOT NULL AUTO_INCREMENT, "
            . "name varchar(150) NULL, "
            . "primary key (`id`) "
            . ") "
            . "ENGINE=InnoDB DEFAULT charset=utf8;";
    
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute();
    echo $result;
    //$users = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <form method="post">
            <p>Создать таблицу: <input type="text" name="$TableName"/></p>
            <button type="submit" name="CreateTable">Создать</button>
        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>

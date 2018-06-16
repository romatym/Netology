<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    
        <form action="admin.php" method="post">
            <p>Добавить тест: <input type="file" name="newTest" accept="application/json"/></p>
            <p><input type="submit" value="Сохранить тест"/></p>
        </form>

        <?php
            $str_out = filter_input(INPUT_POST, "newTest");
            if (isset($str_out) and ! empty($str_out)) {

                $res = move_uploaded_file(__DIR__ . '\\' . $str_out, __DIR__ . '\Tests\\' . $str_out);
                header("Location: list.php");
                exit;
            }
        ?>
        
    </body>
</html>

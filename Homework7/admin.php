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

            $res = copy(__DIR__ . '\\' . $str_out, __DIR__ . '\Tests\\' . $str_out);
            header("Location: list.php");
            exit;

//    echo $res;
    //$fileList = scandir(__DIR__.'\Tests\\');
//    $directory = __DIR__.'\Tests\\';
//    $scanned_directory = array_diff(scandir($directory), array('..', '.'));
//    foreach ($scanned_directory as $key => $value) { 
            ?>
        

<?php
//    }

//    $testListFile = file_get_contents(__DIR__.'\list.json');
//    $testList = json_decode($testListFile, true);
//    $testList[$str_out] = 0;
//    $Number = 1; 
//    foreach ($testList as $testName => $testNumber) {
//        $testList[$testName] = $Number;
//        $Number ++;
//    }
//    file_put_contents(__DIR__.'\list.json', json_encode($testList));
//    
//    $testArray = json_decode(file_get_contents(__DIR__.'\\'.$str_out), true);
//    print_r($testArray);
}

?>
        
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
              
<?php
    $testName = filter_input(INPUT_GET, "test");
    if (!isset($testName)) {
        echo 'Номер теста не указан';
        exit;
    }
?>   

        <form action="test.php?test=<?php echo($testName) ?>" method="post">
            <p>Ваше имя: <input type="text" name="name" /></p>
            <p><input type="submit" /></p>
        </form>
      
    <?php
        if (!isset($_POST['name'])) {
            exit;
        }
    ?> 
   <form action="test.php?num=<?php echo($testNumber) ?>" method="post">     
<?php

    $testListFile = file_get_contents(__DIR__.'\list.json');
    $testList = json_decode($testListFile, true);
    $flipped = array_flip($testList);
    
    $testFileName = $flipped[$testNumber];
    $test = json_decode(file_get_contents(__DIR__.'\\'.$testFileName), true);
?>   
    <div>
        <p><?php echo(key($test)) ?></p>
        <?php
            foreach (current($test) as $key => $value) {?>
                <label><input type="radio" name="answer" 
                    value="<?php echo($value) ?>">
                    <?php echo($key) ?></label>
        <?php                
            }
        ?>
        </br>
        </br>
    </div>
        
    <button type="submit" name="testResult">Результат</button>
       
    </form>
    </br>
    
<?php
    if (isset($_POST['answer'])) {
        $Result = filter_input(INPUT_POST, "answer");
        if ($Result == '1') {
            echo 'Ответ правильный';
        }
        else {
            echo 'Ответ НЕправильный';
        }
        
     }
?> 
      
    </body>
</html>

<?php
        if (isset($_GET['test'])) {
            $testName = $_GET['test'];
            
            $directory = __DIR__ . '\Tests\\';
            if (!file_exists($directory . $testName)) {
                http_response_code(404);
                exit(1);
            }
            
            $testContent = file_get_contents($directory . $testName);
            if ($testContent === FALSE) {
                http_response_code(404);
                exit(1);
            }
        }
        else {
            http_response_code(404);
            exit(1);
        }
        

        
?>        
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
      
        <form action="test.php?test=<?php echo($testName) ?>" method="post">
            <p>Ваше имя: <input type="text" name="$userName"/></p>
            <?php
            $test = json_decode($testContent, true);
            $n=0;
            foreach ($test as $question => $answers) {
                
            ?>   
                <div>
                    <p><?php echo($question) ?></p>
                    <?php foreach ($answers as $key => $value) { ?>
                        <label><input type="radio" name="answer<?php echo($n)?>" 
                                      value="<?php echo($value) ?>">
                                <?php echo($key) ?></label>
                            <?php
                        }
                        ?>
                        </br>
                        </br>
                </div>
            <?php
            $n++;
            }
            ?>
            
            <button type="submit" name="testResult">Результат</button>
            <input type="hidden" name="NumberOfQuestions" value='<?php echo($n)?>'>
        </form>
        </br>
    
    <?php
        $Result = 0;
        $n=0;
        while (isset($_POST['answer'.$n])) {
            $Result = $Result + (int)$_POST['answer'.$n];
            $n++;  
        }
        if (isset($_POST['NumberOfQuestions'])) {
            $NumberOfQuestions = filter_input(INPUT_POST, "NumberOfQuestions");
            if ($Result == (int)$NumberOfQuestions) {
                echo 'Тест пройден!';
        ?>        
        <img src="sertificate.php?name= <?php echo($_POST['$userName']) ?>">
        <?php    
            } else {
                echo 'Тест НЕ пройден!';
            }
        }
    ?>    
        
    </body>
</html>


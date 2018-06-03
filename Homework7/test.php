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
            <p>Ваше имя: <input type="text" name="name"/></p>
            <?php
            $test = json_decode($testContent, true);
            ?>   
            <div>
                <p><?php echo(key($test)) ?></p>
                <?php foreach (current($test) as $key => $value) { ?>
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
                if (isset($_POST['name'])) {
                    $userName = $_POST['name'];
                }
        ?>        
        <img src="sertificate.php?name= <?php echo($userName) ?>">
        <?php    
            } else {
                echo 'Ответ НЕправильный';
            }
        }
        ?>
        
    </body>
</html>

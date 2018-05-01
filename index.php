<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

        $x = filter_input(INPUT_GET, 'x');
          
        $param1 = 1;
        $param2 = 1;
        
        while (true) {
    
            if ($param1 > $x) {
                echo 'Задуманное число НЕ входит в числовой ряд!';
                echo PHP_EOL;
                exit();
            }
            elseif ($param1 == $x) {
                echo 'Задуманное число входит в числовой ряд!';
                echo PHP_EOL;
                exit();
            }
            else {
                $param3 = $param2 + $param1;
                $param1 = $param1 + $param2;
                $param2 = $param3;
                continue;
            }
            
        }
                
        ?>
    </body>
</html>

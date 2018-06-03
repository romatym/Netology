<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <p>Список тестов:</p>
        <?php
        $directory = __DIR__ . '\Tests\\';
        $scanned_directory = array_diff(scandir($directory), array('..', '.'));
        foreach ($scanned_directory as $key => $value) {
            $link = 'test.php?test='.$value;
            ?>
            <p>
                <a href= "<?php echo $link ?>"><?php echo $value ?></a>
            </p>

        <?php } ?>        
        
    </body>
</html>

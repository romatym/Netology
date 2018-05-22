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
            ?>
            <p><?php echo($value) ?></p>

        <?php } ?>        
        
    </body>
</html>

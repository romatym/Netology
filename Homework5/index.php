<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
<?php
    
$phonebook = file_get_contents(__DIR__.'\phonebook.json');
$phonebookDecoded = json_decode($phonebook, true);
?>
        
        <table>
        <!-- выводим колонки таблицы, сортируем по их возрастанию -->
        <?php 
                $person = current($phonebookDecoded);
                $columns = array_keys($person);
                asort($columns);
                ?>
                <tr>
                <?php foreach ($columns as $column) {?>
                    <td><?php echo($column)?></td>
        <?php
                }?>
                </tr>
        
        <!-- выводим строки таблицы -->
        <?php 
            foreach ($phonebookDecoded as $person) {
                    ?>
                <tr>
                    <?php foreach ($columns as $column) {?>
                        <td><?php echo($person[$column])?></td>
                    <?php 
                    }
                    ?>
                </tr>
        <?php
            }
        ?>    
        </table>
       
    </body>
</html>

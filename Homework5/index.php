<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
<?php
    $phonebook = <<<jsontext
[  
    {
        "firstName": "Иван",
        "lastName": "Иванов",
        "address": "г.Москва, ул. Алиева,2",
        "phoneNumber": "812 123-1234"
    },
    {
        "firstName": "Петр",
        "lastName": "Петров",
        "address": "г.Москва, ул. Ленина,1",
        "phoneNumber": "812 123-4567"
    }
]
jsontext;
        
$phonebook_decoded = json_decode($phonebook, true);
?>
        
        <table>
        
        <?php 
            foreach ($phonebook_decoded as $person) {
                $columns = array_keys($person);
                asort($columns);
                ?>
                <tr>
                <?php foreach ($columns as $column) {?>
                    <td><?php echo($column)?></td>
        <?php
                }?>
                </tr>
        <?php 
            break;
            }
        ?>            
        
        <?php 
            foreach ($phonebook_decoded as $person) {
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

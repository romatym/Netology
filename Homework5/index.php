<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
$Phonebook = <<<json
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
json;
        
echo $Phonebook;
        ?>
    </body>
</html>

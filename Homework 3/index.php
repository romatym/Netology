<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
//            $continents = ['Europe', 'Asia', 'Africa', 'North America', 'South America', 'Australia', 'Antarctica'];
            $animals = [
                'Europe' => ['Canis lupus', 'Vulpes vulpes', 'Alces alces'],
                'Africa' => ['Loxodonta africana', 'Panthera leo', 'Pan troglodytes'],
                'Australia' => ['Macropus'],
                'Asia' => ['Ailuropoda melanoleuca'],
                'Antarctica' => ['Spheniscidae'],
                'North America' => ['Bison bison'],
                'South America' => ['Myrmecophagidae']
                ];
            echo '<pre>';
            print_r($animals);
            
            foreach ($animals as $continent => $animal) {
                echo '<b>' . $continent, '</b><br>';
                foreach ($animal as $key => $name) {
                    echo $key, $name . '<br>';
                }
            }
        ?>
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            
        $animals = [
                'Europe' => ['Canis lupus', 'Vulpes vulpes', 'Alces alces'],
                'Africa' => ['Loxodonta africana', 'Panthera leo', 'Pan troglodytes'],
                'Australia' => ['Macropus'],
                'Asia' => ['Ailuropoda melanoleuca'],
                'Antarctica' => ['Spheniscidae'],
                'North America' => ['Bison bison'],
                'South America' => ['Myrmecophagidae']
                ];
            
            $two_words = [];
            $first_words = [];
            $second_words = [];
            foreach ($animals as $continent => $animal) {
                foreach ($animal as $key => $name) {
                    $pos = strpos($name, ' ');
                    if ($pos !== FALSE) {
                        
                        $two_words[] = $name;
                        $pieces = explode(" ", $name);
                        $first_words[] = $pieces[0];
                        $second_words[] = $pieces[1];
                    } 
                }
            }
            
            shuffle($first_words);
            shuffle($second_words);
            
            $new_animals = [];
            
            foreach ($first_words as $key1 => $first_word) {
                $new_animals[] = $first_words[$key1].' '.$second_words[$key1];
            }
            
            echo '<pre>';
            print_r($new_animals);
            
        ?>
    </body>
</html>

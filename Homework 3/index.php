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
            
            echo '<pre>';
            echo 'Исходные животные:';
            print_r($animals);
            
            $two_words = [];
            $first_words = [];
            $second_words = [];
            
            foreach ($animals as $continent => $animal) 
            {
                foreach ($animal as $key => $name) 
                {
                    $pos = strpos($name, ' ');
                    if ($pos !== FALSE) 
                    {
                        
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
            
            foreach ($first_words as $key1 => $first_word) 
            {
                $new_animals[] = $first_words[$key1].' '.$second_words[$key1];
            }
            
            echo '<pre>';
            echo '<br>Новые животные:';
            print_r($new_animals);
          
            $continent_new_animals = [];
            
            foreach ($animals as $continent => $animals_array) 
            {
                $new_animals2 = [];
                
                foreach ($animals_array as $key1 => $animal) 
                {
                    foreach ($new_animals as $key2 => $new_animal) 
                    {
                        $pieces = explode(" ", $new_animal);
                        $find_animal = stristr($animal, $pieces[0]);
                        
                        if ($find_animal != false) 
                        {
                            $new_animals2[] = $new_animal;
                        }
                    }                
                }
                
                $continent_new_animals[$continent] = $new_animals2;
            }

            echo '<br>Новые животные по континентам:';
            foreach ($continent_new_animals as $continent => $animals_array) 
            {
                echo '<h2>'.$continent.'</h2>';
                $string_animals = '';
                
                foreach ($animals_array as $key => $animal) 
                {
                    $string_animals = $string_animals.$animal.', ';
                }
                echo(substr($string_animals, 0, -2));
            }
            
        ?>
    </body>
</html>

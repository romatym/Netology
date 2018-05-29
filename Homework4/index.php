<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $content = file_get_contents("https://api.openweathermap.org/data/2.5/weather?id=5601538&appid=ef275086da6b4c2a604c04dd29f2e5dc");
            $content_decoded = json_decode($content);
            $temperature = $content_decoded->main->temp - 273.15; //Перевод из Кельвинов в градусы Цельсия
            $pressure = $content_decoded->main->pressure;
            $humidity = $content_decoded->main->humidity;

            echo '<pre>';
            echo 'Погода в Москве:';
            $weather_description = $content_decoded->weather;
            if (isset($weather_description) & count($weather_description)>0) {
                echo '<br/>';
                echo($weather_description[0]->description);
            }
            echo '<br/>Температура: '.round($temperature);
            echo '<br/>Давление: '.round($pressure);
            echo '<br/>Влажность: '.round($humidity);
            echo '</pre>';
        ?>
    </body>
</html>

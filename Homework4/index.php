<?php
    $parameters = '?id=5601538&appid=ef275086da6b4c2a604c04dd29f2e5dc';
    $link = 'https://api.openweathermap.org/data/2.5/weather';
    $content = file_get_contents($link.$parameters);
    if ($content === false) {
        exit('Не удалось получить данные');
    }
    $content_decoded = json_decode($content);
    if ($content_decoded === false) {
        exit('Не удалось преобразовать данные');
    }
    $temperature = round($content_decoded->main->temp - 273.15); //Перевод из Кельвинов в градусы Цельсия
    $pressure = round($content_decoded->main->pressure);
    $humidity = round($content_decoded->main->humidity);

    echo '<pre>';
    echo 'Погода в Москве:';
    $weather_description = $content_decoded->weather;
    if (isset($weather_description) & count($weather_description) > 0) {
        echo '<br/>';
        echo($weather_description[0]->description);
    }
    echo('<br/>Температура: ' . (!empty($temperature) ? $temperature, : 'Нет данных');
    echo('<br/>Давление: ' . $pressure);
    echo('<br/>Влажность: ' . $humidity);
    echo('</pre>';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
    </body>
</html>

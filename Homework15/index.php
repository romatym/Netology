<?php
if (isset($_POST['adress']) OR isset($_GET['adress'])) {

    require 'C:\xampp\htdocs\Netology\Homework15\vendor\autoload.php';

    if (isset($_POST['adress'])) {
        $adress = $_POST['adress'];
    } elseif (isset($_GET['adress'])) {
        $adress = $_GET['adress'];
    }
    
    $api = new \Yandex\Geo\Api();

    // Или можно икать по адресу
    $api->setQuery($adress);

    // Настройка фильтров
    $api
        ->setLimit(1) // кол-во результатов
        ->setLang(\Yandex\Geo\Api::LANG_US) // локаль ответа
        ->load();

        $response = $api->getResponse();
        $response->getFoundCount(); // кол-во найденных адресов

        // Список найденных точек
        $collection = $response->getList();
        if (count($collection)==1) {
            $item = $collection[0];
            $itemAddress = $item->getAddress(); // вернет адрес

            $latitude = $item->getLatitude();
            $longitude = $item->getLongitude();
        } 
        elseif (count($collection)>1) {
            $itemAddresses = [];
            foreach ($collection as $item) {
                $itemAddresses[] = $item->getAddress(); // вернет адрес
            }
        }
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <?php if (isset($latitude) && isset($longitude)) { ?>
        
            <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript">
            </script>

            <script type="text/javascript">
                ymaps.ready(init);
                var myMap, 
                    myPlacemark;

                function init() { 

                    myMap = new ymaps.Map("map", {
                        center: [<?php echo($latitude) ?>, <?php echo($longitude) ?>],
                        zoom: 11
                    }); 

                    myPlacemark = new ymaps.Placemark([
                        <?php echo($latitude) ?>
                        , 
                        <?php echo($longitude) ?>
                        ], {
                        hintContent: '<?php echo($itemAddress) ?>',
                        balloonContent: '<?php echo($itemAddress) ?>'
                    });
            
				myMap.geoObjects.add(myPlacemark);
                }
            </script>
        <?php } ?>
    </head>
    
    <body>
        
        <form method="post">
            <p>Введите адрес: <input type="text" name="adress"/></p>
            <button type="submit" name="find">Найти</button>
        </form>
        
        <?php if (isset($latitude) && isset($longitude)) { ?>
            <div id="map" style="width: 600px; height: 400px"></div>
        <?php } elseif (isset($itemAddresses)) { 
            foreach ($itemAddresses as $itemAddress) { ?>
                <a href='index.php?adress=<?php $itemAddress ?>'><?php echo($itemAddress)?></a>
        <?php } 
        } ?>
    </body>
</html>

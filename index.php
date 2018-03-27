<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

<?php
$place = 'Ярославль';
function findInf($place){
    $params = array(
        'geocode' => $place, // адрес
        'format'  => 'json',                          // формат ответа
        'results' => 1,                               // количество выводимых результатов
    );
    $response = json_decode(file_get_contents('http://geocode-maps.yandex.ru/1.x/?' . http_build_query($params, '', '&')));
    
    $adress = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->Address;
    
    $array = [];

    if ($response->response->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found > 0)
    {
        $array[] = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos;
        for ($i=0; $i < 10; $i++) {
            if ($adress->Components[$i]->name != '') {
                $array[] = $adress->Components[$i]->name  . "<br />";
            } 
            
        }
        print_r ($array);


    }
    else
    {
        echo 'Ничего не найдено';
    }
}

findInf($place);

?>
</body>
</html>
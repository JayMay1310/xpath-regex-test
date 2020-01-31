<?php

$json = '
[
    {
      "name": "Мужская одежда",
      "url": "https://example.com/category/160",
      "parent_id": 0
      "category": 1,
    },
    {
        "name": "Брюки",
        "url": "https://example.com/category/160",
        "parent_id": 1,
        "category": 100,
    },
    {
      "name": "Женская одежда",
      "url": "https://example.com/category/168",
      "parent_id": 0,
      "category": 2,
    },
    {
      "name": "Платья",
      "url": "https://example.com/category/41",
      "parent_id": 168,
      "category": 200,
    },
    {
      "name": "Блузки",
      "url": "https://example.com/category/451",
      "parent_id": 2,
      "category": 201,
    },
    {
      "name": "Тапки",
      "url": "https://example.com/category/45",
      "parent_id": 1,
      "category": 202,
    },
    {
      "name": "Туфли",
      "url": "https://example.com/category/455",
      "parent_id": 2,
      "category": 203,
    },
    {
      "name": "Кепки",
      "url": "https://example.com/category/67",
      "parent_id": 1,
      "category": 103,
    },
    {
      "name": "Юбки",
      "url": "https://example.com/category/52",
      "parent_id": 2,
      "category": 210,
    }
  ]
';


//Сперва находим все item строки в json
preg_match_all('/{(?:[^{}])*\}.*/u', $json, $item_matches);
$array_product = [];
foreach ($item_matches[0] as $value)
{
    //В item json получаем данные категорий и названия категорий
    preg_match_all('/(?:"(name|url|parent_id|category)": )(.*)/u', $value, $matches);
    preg_match('/([^"name": ])(.*)[^",\\r]/u', $matches[0][0], $category_name_matches);
    preg_match('/(www|http:|https:)+[^\s]+[\w]/u', $matches[0][1], $category_url_matches);
    preg_match('/\d/u', $matches[0][2], $category_id_matches);
    preg_match('/\d/u', $matches[0][3], $category_matches);
    $category_name = $category_name_matches[0];
    $url = $category_url_matches[0];
    $category_parent_id = $category_id_matches[0];
    $category_id = $category_matches[0];

    $array_product [] = ['id' => $category_id, 'parent_id' => $category_parent_id, 'name'=> $category_name, 'url'=> $url];   
}

$filter_category = array_filter($array_product, function($innerArray){
    return ($innerArray['name'] == 'Мужская одежда');    //Поиск по всему массиву
});

$root_id = $filter_category[0]['id'];
unset($array_product[$root_id]);
$link = [];
foreach ($array_product as $value)
{
    if ($value['parent_id'] == $root_id)
    {
        $link [] = $value['url'];
    }  
}

echo '<pre>'.print_r($link, true).'</pre>';

echo "break";
//Тут начинаем работать с массивов


?>
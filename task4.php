<?php

$categories = [
    ['id' => 1,  'parent_id' => 0, 'name' => 'Мужская одежда', 'url' => 'http://url1.com'],
    ['id' => 2,  'parent_id' => 0, 'name' => 'Женская одежда', 'url' => 'http://url2.com'],
    ['id' => 3,  'parent_id' => 0, 'name' => 'Детская одежда', 'url' => 'http://url3.com'],
    ['id' => 4,  'parent_id' => 0, 'name' => 'Одежда для беременных', 'url' => 'http://url4.com'],
    ['id' => 5,  'parent_id' => 2, 'name' => 'Платья', 'url' => 'http://url6.com'],
    ['id' => 6,  'parent_id' => 2, 'name' => 'Юбки', 'url' => 'http://url7.com'],
    ['id' => 7,  'parent_id' => 1, 'name' => 'Джинсы', 'url' => 'http://url8.com'],
    ['id' => 8,  'parent_id' => 4, 'name' => 'Субкатегория одежда для беременных', 'url' => 'http://url9.com'],
];




$filter_root_category = array_filter($categories, function($innerArray){
    return ($innerArray['name'] == 'Женская одежда');    //Поиск по всему массиву
});

$id = $filter_root_category[1]['id'];
$link = [];
foreach ($categories as $value)
{
    if ($value['parent_id'] == $id)
    {
        $link [] = $value['url'];
    }
       
}

echo '<pre>'.print_r($link, true).'</pre>';


?>
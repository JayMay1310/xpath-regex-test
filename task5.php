<?php

$json = '
  [
    {
      "name": "Мужская одежда",
      "url": "https://example.com/category/160",
      "parent_id": 0,
      "category": 160
    },
    {
      "name": "Женская одежда",
      "url": "https://example.com/category/168",
      "parent_id": 0,
      "category": 168
    },
    {
      "name": "Платья",
      "url": "https://example.com/category/41",
      "parent_id": 168
    },
    {
      "name": "Блузки",
      "url": "https://example.com/category/451",
      "parent_id": 168
    },
    {
      "name": "Тапки",
      "url": "https://example.com/category/45",
      "parent_id": 160
    },
    {
      "name": "Туфли",
      "url": "https://example.com/category/455",
      "parent_id": 168
    },
    {
      "name": "Кепки",
      "url": "https://example.com/category/67",
      "parent_id": 160
    },
    {
      "name": "Юбки",
      "url": "https://example.com/category/52",
      "parent_id": 168
    }
  ]
';

$find_name_category = "Мужская одежда";
//Сперва находим все item строки в json
preg_match_all('/{(?:[^{}])*\}.*/u', $json, $item_matches);
$array_product = [];
$category_id = "";
$link = [];
foreach ($item_matches[0] as $value)
{
    //Если name содержит искомую строку
  preg_match('/\"name\":\s+\"(.*)\"/u', $value, $match_name);
  if ($match_name[1] === $find_name_category)
  {
    //Тут получаем id категорий
    preg_match('/\"category\":\s+(\d+)/u', $value, $root_id_matches);
    $category_id = $root_id_matches[1];
    break;
  }
}

if (isset($category_id))
{
  foreach ($item_matches[0] as $value)
  {
    preg_match('/\"parent_id\":\s+(\d+)/u', $value, $parent_id_matches);
    if ($parent_id_matches[1] === $category_id)
    {
      preg_match('/(www|http:|https:)+[^\s]+[\w]/u', $value, $url_matches);
      $link [] = $url_matches[0];
    }
  }
}


echo '<pre>'.print_r($link, true).'</pre>';

echo "break";
//Тут начинаем работать с массивов


?>
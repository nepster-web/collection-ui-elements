<?php

if (isset($_GET['term'])) {
    $result = [];
    $result[] = [
        'id' => 1,
        'name' => "Телевизоры",
        'desc' => "Категория телевизоров",
        'icon' => "images/items/1.jpg"
    ];
    $result[] = [
        'id' => 2,
        'name' => "Кондиционеры",
        'desc' => "Категория кондиционеров",
        'icon' => "images/items/2.jpg"
    ];
    $result[] = [
        'id' => 3,
        'name' => "Стиральные машины",
        'desc' => "Категория стиральных машин",
        'icon' => "images/items/3.jpg"
    ];
    $result[] = [
        'id' => 4,
        'name' => "Компьютеры",
        'desc' => "Категория компьютеров",
        'icon' => "images/items/4.jpg"
    ];
    echo json_encode($result);
    exit;
}
else if (isset($_GET['rand'])) {
    echo rand(100000000, 999999999);
    exit;
}
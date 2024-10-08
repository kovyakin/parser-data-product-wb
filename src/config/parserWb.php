<?php
/*
 * Copyright (c) 2024.
 * author - kovyakin
 * kdv-1974@mail.ru
 */

/**
 * address.state - адрес по которому получаем card.json от WB
 * max_numeric_servers - индекс к сайту от 1 до max_numeric_servers по которому ищем данные продукта.
 *          Рекомендуется значение 20, иначе если число будет меньше - риск того,
 *          что данные не будут получены
 *          если больше - то время парсинга при отсутствии 'Артикул WB' будет увеличено.
*/

return [
    'address'=>[
        'state'=>'https://card.wb.ru/cards/v1/detail?appType=1&curr=rub&dest=-1257786&spp=29&nm=',
    ],
    'max_numeric_servers'=>20, // recomented >= 18 < = 20
];

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">

<div style="text-align: center;">

![GitHub watchers](https://img.shields.io/github/watchers/kovyakin/parser-data-product-wb)
![GitHub Downloads (all assets, all releases)](https://img.shields.io/github/downloads/kovyakin/parser-data-product-wb/total)
![Packagist Stars](https://img.shields.io/packagist/stars/kovyakin/parser-data-product-wb)
![Packagist Version](https://img.shields.io/packagist/v/kovyakin/parser-data-product-wb)
![Packagist License](https://img.shields.io/packagist/l/kovyakin/parser-data-product-wb)

</div>

# Parser data and photo product from wildberries (article Wb) for Laravel

## Требования
- Laravel 11 и выше.
- PHP 8.2 и выше.


### Установка

- composer require kovyakin/parser-data-product-wb
- php artisan migrate

## Важное замечание!

 > **Использовать с очередями QUEUE !!!**

### Использование

1.Пользователь должен быть зарегистрирован.

2.Пример кода:

``` php
$my_parser = new ParserDataWb();
$articleWb = 219503618;
$my_parser->parse($articleWb);
```

Результат будет true или false.

    Обновление записи ~3.4s
    Создание записи ~2.0s
    Нет записи ~3.2s

3.Парсер создает 3 таблицы:

    - nmId;
    - photo_products;
    - data_products;

3.1.Таблица nmId

    Описание полей:
    - user_id (int) - id пользователя;
    - nmId (int) - артикул продукта Wb, который мы получаем;

``` php
// как пример - получение артикула продукта из БД.
// работают все методы модели.

$user_id = auth()->user()->id;
NmId::query()->where('user_id',$user_id)->first();
```

3.2.Таблица photo_products

    Описание полей:
    - nm_id (int) - id записи из таблицы nmId;
    - url_photo (string,255) - спарсенный url главного изображения продукта;

``` php
// как пример - получение url главного изображения продукта из БД.
// работают все методы модели PhotoProducts.
$user_id = auth()->user()->id;
$nmId = NmId::query()->where('user_id',$user_id)->first();
$nmId->photo;
//или
$nmId->photo['url_photo'];
// можно получить модель nmId, принадлежащий к данному photo_products
// Отношение с таблицей nmId - HasOne
$photoModel = PhotoProducts::query()
    ->where('nm_id',$nmId->id)->first();
$photoModel->nmId;
```

3.3.Таблица data_products

    Описание полей:
    - nm_id (int) - id записи из таблицы nmId;
    - data (json,255) - спарсенный data главного изображения продукта;
    - state (json,255) - спарсенный state главного изображения продукта;

``` php
// как пример - получение data главного изображения продукта из БД.
// работают все методы модели DataProducts.

$user_id = auth()->user()->id;
$nmId = NmId::query()->where('user_id',$user_id)->first();
$nmId->data;
//или
$nmId->data['data'];
$nmId->data['state'];
// можно получить модель nmId, принадлежащий к данному photo_products
// Отношение с таблицей nmId - HasOne
$dataModel = DataProducts::query()
    ->where('nm_id',$nmId->id)->first();
$dataModel->nmId;
```

4.Описание полей 'data', 'state' таблицы data_products:

    -все и так ясно по ключам значений.
5.Публикация
``` php
php artisan vendor:publish --provider="Kovyakin\ParserDataProductWb\Providers\ParserServiceProvider"
```


## Журнал изменений

Журнал изменений [CHANGELOG.md](CHANGELOG.md), что изменилось в последнее время.

## Автор

- [Kovyakin Dmitry](https://github.com/kovyakin)

## Лицензия

Это MIT License (MIT). Посмотрите [License File](LICENSE.md) для ознакомления.




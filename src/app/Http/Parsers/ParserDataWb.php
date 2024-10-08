<?php
/*
 * Copyright (c) 2024.
 * author - kovyakin
 * kdv-1974@mail.ru
 */

namespace Kovyakin\ParserDataProductWb\app\Http\Parsers;

use Kovyakin\ParserDataProductWb\app\Http\Handlers\dataProductHandler;
use Kovyakin\ParserDataProductWb\app\Http\Handlers\getDataFromCity;
use Kovyakin\ParserDataProductWb\app\Http\Handlers\nmIdHandler;
use Kovyakin\ParserDataProductWb\app\Http\Handlers\urlPhotoHandler;
use Kovyakin\ParserDataProductWb\app\Traits\CurlTrait;

class ParserDataWb
{
    use CurlTrait;

    public function parse($nmId): bool
    {
        $nmIdHandler = new nmIdHandler();

        $nm_id = $nmIdHandler->set($nmId);

        $id_photo = null;
        $url = '';

        for ($num = 1; $num <= config('parserWb.max_numeric_servers'); $num++) {
            $http = $num < 10 ? 'https://basket-0' : 'https://basket-';

            $url = $http . $num .
                '.wbbasket.ru/vol'
                . mb_substr((string)$nmId, 0, 4)
                . '/part'
                . mb_substr((string)$nmId, 0, 6)
                . '/' . (string)$nmId
                . '/images/big/1.webp';

            $query = $this->get($url);

            $urlProductHandler = new urlPhotoHandler($url);

            if ($query === false) {
                continue;
            }

            $response = preg_split('/\R/', $query);

            if (trim($response[0]) === 'HTTP/2 200') {
                $id_photo = $urlProductHandler->set($nm_id);
                break;
            }
        }

        if ($id_photo == null) {
            return $nmIdHandler->delete($nmId);
        }

        $dataProduct = new dataProductHandler();

        $query_data = new getDataFromCity();

        $data = $query_data->get($url, $nmId);

        $result = $dataProduct->set($nm_id, $data);

        if ($result == null) {
            return false;
        }

        return true;
    }

}
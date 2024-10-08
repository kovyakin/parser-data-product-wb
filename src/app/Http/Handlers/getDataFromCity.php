<?php
/*
 * Copyright (c) 2024.
 * author - kovyakin
 * kdv-1974@mail.ru
 */

namespace Kovyakin\ParserDataProductWb\app\Http\Handlers;

use Kovyakin\ParserDataProductWb\app\Interfaces\curlSite;

/**
 *
 */
class getDataFromCity implements curlSite
{
    /**
     * @inheritDoc
     */
    public function get(string $url, int $nmId): array
    {
        if ($url !== '') {
            $address_array = explode('/', $url);
            $address = 'https://' . $address_array[2] . '/' . $address_array[3] . '/'
                . $address_array[4] . '/' . $address_array[5] . '/info/ru/card.json';
            $request_date = file_get_contents($address);
            $address_state = config('parserWb.address.state') . $nmId;
            $request_state = file_get_contents($address_state);

            return ['data' => $request_date, 'state' => $request_state];
        }
        return ['data' => '', 'state' => ''];
    }
}
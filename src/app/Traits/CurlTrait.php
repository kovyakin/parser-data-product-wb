<?php
/*
 * Copyright (c) 2024.
 * author - kovyakin
 * kdv-1974@mail.ru
 */

namespace Kovyakin\ParserDataProductWb\app\Traits;

/**
 *
 */
trait CurlTrait
{
    /**
     * @param string $url
     * @return bool|string
     */
    public function get(string $url){

       if (!filter_var($url, FILTER_VALIDATE_URL)) {
           return false;
       }

       // Инициализация cURL
       $curlInit = curl_init($url);

       // Установка параметров запроса
       curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
       curl_setopt($curlInit, CURLOPT_HEADER, true);
       curl_setopt($curlInit, CURLOPT_NOBODY, true);
       curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

       // Получение ответа
       $response = curl_exec($curlInit);

       // закрываем CURL
       curl_close($curlInit);

       return $response;
   }
}

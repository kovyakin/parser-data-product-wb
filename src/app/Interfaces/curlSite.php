<?php
/*
 * Copyright (c) 2024.
 * author - kovyakin
 * kdv-1974@mail.ru
 */

namespace Kovyakin\ParserDataProductWb\app\Interfaces;

/**
 *
 */
interface curlSite
{

    /**
     * @param string $url
     * @param int $nmId
     * @return array
     */
    public function get(string $url,int $nmId): array;
}
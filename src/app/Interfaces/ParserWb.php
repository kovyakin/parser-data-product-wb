<?php
/*
 * Copyright (c) 2024.
 * author - kovyakin
 * kdv-1974@mail.ru
 */

namespace Kovyakin\ParserDataProductWb\app\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
interface ParserWb
{
    /**
     * @param int $nmId
     * @return Model|null
     */
    public function get(int $nmId) :Model|null;

    /**
     * @param int $nmId
     * @return int
     */
    public function set(int $nmId) :int;

    /**
     * @param int $nmId
     * @return bool
     */
    public function delete(int $nmId) :bool;
}

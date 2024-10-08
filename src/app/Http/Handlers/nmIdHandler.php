<?php
/*
 * Copyright (c) 2024.
 * author - kovyakin
 * kdv-1974@mail.ru
 */

namespace Kovyakin\ParserDataProductWb\app\Http\Handlers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kovyakin\ParserDataProductWb\app\Interfaces\ParserWb;
use Kovyakin\ParserDataProductWb\app\Http\Models\NmId;


/**
 *
 */
class nmIdHandler implements ParserWb
{

    /**
     * @var int|mixed
     */
    public int $user_id;

    /**
     * @param User $user
     */
    public function __construct()
    {
        $this->user_id = Auth::user()->id;
    }


    /**
     * @param $nmId
     * @return Model|null
     */
    public function get($nmId): Model|null
    {
        return NmId::query()
            ->where('nmId', $nmId)
            ->first();
    }


    /**
     * @param int $nmId
     * @return int
     */
    public function set(int $nmId): int
    {
        $is_exist_nmId = $this->get($nmId);;
        if ($is_exist_nmId == null) {
            return NmId::query()->create([
                'user_id' => $this->user_id,
                'nmId' => $nmId
            ])->id;
        }

        return $is_exist_nmId->id;
    }


    /**
     * @param int $nmId
     * @return bool
     */
    public function delete(int $nmId): bool
    {
        return !NmId::query()
                ->where('nmId', $nmId)->delete() > 0;
    }

}
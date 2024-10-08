<?php
/*
 * Copyright (c) 2024.
 * author - kovyakin
 * kdv-1974@mail.ru
 */

namespace Kovyakin\ParserDataProductWb\app\Http\Handlers;

use Illuminate\Database\Eloquent\Model;
use Kovyakin\ParserDataProductWb\app\Http\Models\DataProducts;
use Kovyakin\ParserDataProductWb\app\Interfaces\ParserWb;

/**
 *
 */
class dataProductHandler implements ParserWb
{

    /**
     * @param int $nmId
     * @return Model|null
     */
    public function get(int $nmId): Model|null
    {
        return DataProducts::query()
            ->where('nm_id', $nmId)
            ->first();
    }

    /**
     * @param int $nmId
     * @return int
     */
    public function set(int $nmId, array $data = []): int
    {
        $is_exist_data = $this->get($nmId);

        if ($is_exist_data !== null) {
            DataProducts::query()
                ->where('nm_id', $nmId)
                ->update([
                    'data' => $data['data'],
                    'state' => $data['state'],
                ]);
        } else {
            $is_exist_data = DataProducts::query()->create([
                'nm_id' => $nmId,
                'data' => $data['data'],
                'state' => $data['state'],
            ]);
        }
        return $is_exist_data->id;
    }

    /**
     * @param int $nmId
     * @return bool
     */
    public function delete(int $nmId): bool
    {
        return \Kovyakin\ParserDataProductWb\app\Http\Models\DataProducts::query()
                ->where('nm_id', $nmId)->delete() > 0;
    }
}
<?php
/*
 * Copyright (c) 2024.
 * author - kovyakin
 * kdv-1974@mail.ru
 */

namespace Kovyakin\ParserDataProductWb\app\Http\Handlers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kovyakin\ParserDataProductWb\app\Http\Models\PhotoProducts;
use Kovyakin\ParserDataProductWb\app\Interfaces\ParserWb;

/**
 *
 */
class urlPhotoHandler implements ParserWb
{
    /**
     * @var int
     */
    protected int $user_id;
    /**
     * @var string
     */
    public string $url;

    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->user_id = Auth::user()->id;
        $this->url = $url;
    }

    /**
     * @param int $nmId
     * @return Model|null
     */
    public function get(int $nmId): Model|null
    {
        return PhotoProducts::query()
            ->where('nm_id', $nmId)
            ->first();
    }

    /**
     * @param int $nmId
     * @return int
     */
    public function set(int $nmId): int
    {
        $photoProduct = $this->get($nmId);

        if ($photoProduct == null) {
            $photoProduct = PhotoProducts::query()->create([
                'nm_id' => $nmId,
                'url_photo' => $this->url,
            ]);
        } else {
            $photoProduct->update([
                'url_photo' => $this->url,
            ]);
        }
        return $photoProduct->id;
    }

    /**
     * @param int $nmId
     * @return bool
     */
    public function delete(int $nmId): bool
    {
        return \Kovyakin\ParserDataProductWb\app\Http\Models\PhotoProducts::query()
                ->where('nm_id', $nmId)->delete() > 0;
    }
}
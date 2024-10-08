<?php
/*
 * Copyright (c) 2024.
 * author - kovyakin
 * kdv-1974@mail.ru
 */

namespace Kovyakin\ParserDataProductWb\app\Http\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 *
 */
class NmId extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'nm_id';
    /**
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'nmId'
    ];

    /**
     * @return HasOne
     */
    public function photo(): HasOne
    {
        return $this->hasOne(PhotoProducts::class, 'nm_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function data(): HasOne
    {
        return $this->hasOne(DataProducts::class, 'nm_id', 'id');
    }

}

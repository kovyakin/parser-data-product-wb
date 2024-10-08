<?php
/*
 * Copyright (c) 2024.
 * author - kovyakin
 * kdv-1974@mail.ru
 */

namespace Kovyakin\ParserDataProductWb\app\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 */
class DataProducts extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'data_products';
    /**
     * @var string
     */
    protected $primaryKey='id';
    /**
     * @var string[]
     */
    protected $fillable = [
        'nm_id',
        'data',
        'state',
    ];

    /**
     * @return BelongsTo
     */
    public function nmId(): BelongsTo
    {
        return $this->belongsTo(NmId::class, 'nm_id');
    }
}

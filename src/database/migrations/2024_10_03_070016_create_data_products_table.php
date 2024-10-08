<?php
/*
 * Copyright (c) 2024.
 * author - kovyakin
 * kdv-1974@mail.ru
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Kovyakin\ParserDataProductWb\app\Http\Models\NmId::class,'nm_id')
                ->constrained('nm_id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->json('data')->nullable();
            $table->json('state')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_products');
    }
};

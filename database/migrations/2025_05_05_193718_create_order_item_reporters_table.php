<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_item_reporters', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->float('total_amount');
            $table->unsignedBigInteger('quantity');
            $table->morphs('model');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_item_reporters');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('min_price');
            $table->unsignedTinyInteger('type');
            $table->unsignedBigInteger('quantity_allowed')->nullable();
            $table->unsignedBigInteger('quantity_used');
            $table->string('code');
            $table->string('description');
            $table->date('expires_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique('code');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('coupon_id')->nullable()->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('coupon_id');
        });
    }
};

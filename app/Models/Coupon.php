<?php

namespace App\Models;

use App\Enums\CouponTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'amount',
        'min_price',
        'type',
        'description',
        'quantity_allowed',
        'quantity_used',
        'expires_at',
    ];

    protected $casts = [
        'type' => CouponTypeEnum::class,
        'expires_at' => 'date',
    ];

    protected $attributes = [
        'quantity_used' => 0,
    ];

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }
}

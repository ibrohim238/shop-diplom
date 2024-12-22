<?php

namespace App\Models;

use App\Enums\PurchaseStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Purchase extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'coupon_id',
    ];

    protected $casts = [
        'status' => PurchaseStatusEnum::class,
        'amount' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, PurchaseProduct::class)->withPivot('quantity');
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }
}

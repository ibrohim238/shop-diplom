<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

final class Product extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    protected $casts = [
        'price' => 'float',
    ];


    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, OrderProduct::class);
    }
}

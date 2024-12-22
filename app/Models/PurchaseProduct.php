<?php

namespace App\Models;

use App\Enums\PurchaseStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PurchaseProduct extends Pivot
{
    protected $table = 'purchase_product';

    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
    ];
}

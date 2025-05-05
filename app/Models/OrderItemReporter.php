<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class OrderItemReporter extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'total_amount',
        'quantity',
        'model_type',
        'model_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Versions\Private\Services;

use App\Enums\PurchaseStatusEnum;
use App\Models\Basket;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Versions\Private\Dtos\PurchaseDto;
use Illuminate\Support\Facades\DB;

final readonly class PurchaseService
{
    public function __construct(
        private Purchase $purchase
    )
    {
    }

    public function store(PurchaseDto $dto): Purchase
    {
        DB::transaction(function () use ($dto) {
            $baskets = Basket::query()
                ->whereIn('id', $dto->getBaskets())
                ->get();
            $amount = $baskets
                ->map(fn(Basket $basket) => $basket->quantity * $basket->product->price)
                ->sum();
            $this->purchase->user()->associate($dto->getUserId());
            $this->purchase->fill([
                'status' => PurchaseStatusEnum::PENDING,
                'amount' => $amount,
            ]);
            $this->purchase->save();
            PurchaseProduct::query()
                ->insert(
                    $baskets
                        ->map(fn(Basket $basket) => [
                            'purchase_id' => $this->purchase->id,
                            'product_id' => $basket->product_id,
                            'quantity' => $basket->quantity,
                        ])
                        ->toArray()
                );
            Basket::query()
                ->whereIn('id', $dto->getBaskets())
                ->delete();
        });

        return $this->purchase;
    }
}

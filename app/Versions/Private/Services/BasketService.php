<?php

namespace App\Versions\Private\Services;

use App\Models\Basket;
use App\Versions\Private\Dtos\BasketDto;

final readonly class BasketService
{
    public function __construct(
        private Basket $basket,
    ) {
    }

    public function store(BasketDto $basketDto): Basket
    {
        $this->basket->fill($basketDto->toArray());
        $this->basket->save();

        return $this->basket;
    }

    public function delete(): void
    {
        $this->basket->delete();
    }
}

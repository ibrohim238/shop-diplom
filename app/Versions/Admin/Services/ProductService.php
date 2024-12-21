<?php

namespace App\Versions\Admin\Services;

use App\Models\Product;
use app\Versions\Admin\Dto\ProductDto;

final readonly class ProductService
{
    public function __construct(
        private Product $product
    ) {
    }

    public function store(ProductDto $dto): Product
    {
        $this->save($dto);

        return $this->product;
    }

    public function update(ProductDto $dto): Product
    {
        $this->save($dto);

        return $this->product;
    }

    public function destroy(): void
    {
        $this->product->delete();
    }

    private function save(ProductDto $dto): void
    {
        $this->product
            ->fill($dto->toArray())
            ->save();
    }
}

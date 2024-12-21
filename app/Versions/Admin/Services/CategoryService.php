<?php

namespace App\Versions\Admin\Services;

use App\Models\Product;
use App\Versions\Admin\Dtos\CategoryDto;

final readonly class CategoryService
{
    public function __construct(
        private Product $product
    ) {
    }

    public function store(CategoryDto $dto): Product
    {
        $this->save($dto);

        return $this->product;
    }

    public function update(CategoryDto $dto): Product
    {
        $this->save($dto);

        return $this->product;
    }

    public function destroy(): void
    {
        $this->product->delete();
    }

    private function save(CategoryDto $dto): void
    {
        $this->product
            ->fill($dto->toArray())
            ->save();
    }
}

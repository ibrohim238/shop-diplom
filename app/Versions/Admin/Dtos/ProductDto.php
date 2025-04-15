<?php

namespace App\Versions\Admin\Dtos;

use App\Versions\Admin\Http\Requests\ProductRequest;

final readonly class ProductDto
{
    public function __construct(
        private string $name,
        private string $description,
        private float  $price,
        private ?int   $quantity,
        private ?array $categories,
        private ?array $medias,
    ) {
    }

    public static function fromRequest(ProductRequest $request): ProductDto
    {
        $validated = $request->validated();

        return new self(
            name: $validated['name'],
            description: $validated['description'] ?? null,
            price: $validated['price'],
            quantity: $validated['quantity']     ?? null,
            categories: $validated['categories'] ?? null,
            medias: $validated['medias']         ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name'        => $this->name,
            'description' => $this->description,
            'price'       => $this->price,
            'quantity'    => $this->quantity,
        ];
    }

    public function getMedias(): ?array
    {
        return $this->medias;
    }

    public function getCategories(): ?array
    {
        return $this->categories;
    }
}

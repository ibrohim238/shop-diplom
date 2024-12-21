<?php

namespace App\Versions\Admin\Dtos;

use App\Versions\Admin\Http\Requests\ProductRequest;

class ProductDto
{
    public function __construct(
        private string $name,
        private string $description,
    ) {
    }

    public static function fromRequest(ProductRequest $request)
    {
        $validated = $request->validated();

        return new self(
            name: $validated['name'],
            description: $validated['description'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}

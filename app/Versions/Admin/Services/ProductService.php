<?php

namespace App\Versions\Admin\Services;

use App\Models\Product;
use App\Versions\Admin\Dtos\ProductDto;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final readonly class ProductService
{
    public function __construct(
        private Product $product
    ) {
    }

    public function store(ProductDto $dto): Product
    {
        $this->save($dto);
        Media::query()
            ->where('id', $dto->getMedias())
            ->get()
            ->each(function (Media $media) {
                $media->move($this->product);
            });
        $this->product->categories()->attach($dto->getCategories());

        return $this->product;
    }

    public function update(ProductDto $dto): Product
    {
        $this->save($dto);
        $this->product->clearMediaCollection();
        Media::query()
            ->where('id', $dto->getMedias())
            ->get()
            ->each(function (Media $media) {
                $media->move($this->product);
            });
        $this->product->categories()->detach();
        $this->product->categories()->attach($dto->getCategories());

        return $this->product;
    }

    public function destroy(): void
    {
        $this->product->clearMediaCollection();
        $this->product->categories()->detach();
        $this->product->delete();
    }

    private function save(ProductDto $dto): void
    {
        $this->product
            ->fill($dto->toArray())
            ->save();
    }
}

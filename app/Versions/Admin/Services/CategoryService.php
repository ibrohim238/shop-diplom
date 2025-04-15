<?php

namespace App\Versions\Admin\Services;

use App\Models\Category;
use App\Versions\Admin\Dtos\CategoryDto;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final readonly class CategoryService
{
    public function __construct(
        private Category $category,
    ) {
    }

    public function store(CategoryDto $dto): Category
    {
        $this->save($dto);
        if ($mediaId = $dto->getMediaId()) {
            $this
                ->getMedia($mediaId)
                ->move($this->category);
        }

        return $this->category;
    }

    public function update(CategoryDto $dto): Category
    {
        $this->save($dto);
        $this->category->clearMediaCollection();
        if ($mediaId = $dto->getMediaId()) {
            $this
                ->getMedia($mediaId)
                ->move($this->category);
        }

        return $this->category;
    }

    public function destroy(): void
    {
        $this->category->clearMediaCollection();
        $this->category->products()->detach();
        $this->category->delete();
    }

    private function save(CategoryDto $dto): void
    {
        $this->category
            ->fill($dto->toArray())
            ->save();
    }

    private function getMedia(int $mediaId): Media
    {
        return Media::find($mediaId);
    }
}

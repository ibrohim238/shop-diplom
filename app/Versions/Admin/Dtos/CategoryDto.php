<?php

namespace App\Versions\Admin\Dtos;

use app\Versions\Admin\Http\Requests\CategoryRequest;

final readonly class CategoryDto
{
    public function __construct(
        private string  $name,
        private ?string $description,
        private int     $parentId,
        private ?int    $mediaId,
    ) {
    }

    public static function fromRequest(CategoryRequest $request): CategoryDto
    {
        $validated = $request->validated();

        return new self(
            name: $validated['name'],
            description: $validated['description'] ?? null,
            parentId: $validated['parent_id'] ?? null,
            mediaId: $validated['media_id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'parent_id' => $this->parentId,
        ];
    }

    public function getMediaId(): int
    {
        return $this->mediaId;
    }
}

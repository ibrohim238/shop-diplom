<?php

namespace App\Versions\Private\Services;

use App\Enums\MediaCollectionNameEnum;
use App\Models\User;
use App\Versions\Private\Dtos\UserMediaDto;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final readonly class UserMediaService
{
    public function __construct(
        private Media $media
    ) {
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public static function store(User $user, UserMediaDto $dto): Collection
    {
        $media = collect();
        foreach ($dto->media as $item) {
            $media->add(
                $user
                    ->addMedia($item)
                    ->toMediaCollection(MediaCollectionNameEnum::TEMP->value, 'temporary'),
            );
        }

        return $media;
    }

    public function destroy(): void
    {
        $this->media->delete();
    }
}

<?php

namespace App\Versions\Private\Dtos;

use App\Versions\Private\Http\Requests\UserMediaRequest;
use Illuminate\Http\UploadedFile;

class UserMediaDto
{
    /**
     * @param array<UploadedFile> $media
     */
    public function __construct(
        public readonly array $media,
    ) {
    }

    public static function fromRequest(UserMediaRequest $request): UserMediaDto
    {
        $validated = $request->validated();

        return new self(
            media: $validated['media'],
        );
    }
}

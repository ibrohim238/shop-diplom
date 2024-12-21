<?php

namespace App\Versions\Private\Http\Requests;

use App\Enums\MediaExtensionTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rules\File;

/**
 * @property-read array<UploadedFile> $media
*/
final class UserMediaRequest extends FormRequest
{
    public function rules(): array
    {
        $extensions = MediaExtensionTypeEnum::values();

        return [
            'media'   => ['required', 'array', 'max:10'],
            'media.*' => [
                'required',
                File::types($extensions)->extensions($extensions),
            ],
        ];
    }
}

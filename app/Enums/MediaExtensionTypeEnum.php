<?php

namespace App\Enums;

enum MediaExtensionTypeEnum: string
{
    use EnumTrait;

    case PNG  = 'png';
    case JPG  = 'jpg';
    case JPEG = 'jpeg';
    case WEBP = 'webp';
    case GIF  = 'gif';
}

<?php

namespace App\Versions\Private\Swagger\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'UserMedia request',
    description: 'UserMedia request body data',
    required: [],
    type: 'object',
)]
final class UserMediaRequest
{
    #[OA\Property(
        title: 'media',
        description: 'media',
        type: 'array',
        items: new OA\Items(type: 'file'),
    )]
    private readonly array $media;
}

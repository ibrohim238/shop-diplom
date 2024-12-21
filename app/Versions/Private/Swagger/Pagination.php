<?php

namespace App\Versions\Private\Swagger;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Pagination',
    description: 'Pagination',
    xml: new OA\Xml(
        name: 'Pagination',
    ),
)]
final class Pagination
{
    #[OA\Property(
        title: 'current_page',
        description: 'current_page',
        type: 'integer',
    )]
    private readonly int $current_page;

    #[OA\Property(
        title: 'from',
        description: 'from',
        type: 'integer',
    )]
    private readonly int $from;

    #[OA\Property(
        title: 'last_page',
        description: 'last_page',
        type: 'integer',
    )]
    private readonly int $last_page;

    #[OA\Property(
        title: 'path',
        description: 'path',
        type: 'string',
    )]
    private readonly string $path;

    #[OA\Property(
        title: 'per_page',
        description: 'per_page',
        type: 'integer',
    )]
    private readonly int $per_page;

    #[OA\Property(
        title: 'to',
        description: 'to',
        type: 'integer',
    )]
    private readonly int $to;

    #[OA\Property(
        title: 'total',
        description: 'total',
        type: 'integer',
    )]
    private readonly int $total;
}

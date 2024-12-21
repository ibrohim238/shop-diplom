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
final readonly class Pagination
{
    #[OA\Property(
        title: 'current_page',
        description: 'current_page',
        type: 'integer',
    )]
    private int $current_page;

    #[OA\Property(
        title: 'from',
        description: 'from',
        type: 'integer',
    )]
    private int $from;

    #[OA\Property(
        title: 'last_page',
        description: 'last_page',
        type: 'integer',
    )]
    private int $last_page;

    #[OA\Property(
        title: 'path',
        description: 'path',
        type: 'string',
    )]
    private string $path;

    #[OA\Property(
        title: 'per_page',
        description: 'per_page',
        type: 'integer',
    )]
    private int $per_page;

    #[OA\Property(
        title: 'to',
        description: 'to',
        type: 'integer',
    )]
    private int $to;

    #[OA\Property(
        title: 'total',
        description: 'total',
        type: 'integer',
    )]
    private int $total;
}

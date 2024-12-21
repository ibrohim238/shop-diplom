<?php

namespace App\Versions\Admin\Swagger\Responses;

use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
final class UnauthorizedResponse extends OA\Response
{
    public function __construct()
    {
        parent::__construct(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthenticated');
    }
}

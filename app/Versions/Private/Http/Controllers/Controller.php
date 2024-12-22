<?php

namespace App\Versions\Private\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use OpenApi\Attributes as OA;

#[OA\Server(
    url: '/api/private',
)]
#[OA\Info(
    version: 'private',
    description: 'Private Api docs',
    title: 'api-ord documentation',
    contact: new OA\Contact(email: ''),
    license: new OA\License(name: 'Apache 2.0', url: 'https://www.apache.org/licenses/LICENSE-2.0.html'),
)]
#[OA\SecurityScheme(
    securityScheme: 'api-key',
    type: 'http',
    name: 'Authorization',
    in: 'header',
    bearerFormat: 'JWT',
    scheme: 'bearer',
)]
#[OA\Tag(name: 'Products', description: 'Продукты')]
#[OA\Tag(name: 'Categories', description: 'Категории')]
#[OA\Tag(name: 'UserMedia', description: 'Файлы')]
#[OA\Tag(name: 'Baskets', description: 'Корзина')]
#[OA\Tag(name: 'Purchases', description: 'Оплата')]
abstract readonly class Controller extends BaseController
{
    //
}

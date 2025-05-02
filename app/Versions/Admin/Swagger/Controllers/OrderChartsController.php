<?php

namespace App\Versions\Admin\Swagger\Controllers;

use OpenApi\Attributes as OA;

interface OrderChartsController
{
    #[OA\Get(
        path: '/orders/charts',
        description: 'Возвращает данные для построения графика: суммарное количество товаров по дням/неделям/месяцам/годам',
        summary: 'График продаж по датам',
        tags: ['Orders', 'Charts'],
        parameters: [
            new OA\Parameter(
                name: 'period',
                description: 'Диапазон дат в формате "YYYY/MM/DD-YYYY/MM/DD"',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string', example: '2023/01/01-2023/01/31'),
            ),
            new OA\Parameter(
                name: 'format',
                description: 'Группировка по периоду',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                    default: 'day',
                    enum: ['day', 'week', 'month', 'year'],
                    example: 'week',
                ),
            ),
            new OA\Parameter(
                name: 'product_id',
                description: 'Фильтрация по идентификатору товара',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer', example: 42),
            ),
            new OA\Parameter(
                name: 'category_id',
                description: 'Фильтрация по идентификатору категории',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer', example: 7),
            ),
        ],
    )]
    #[OA\Response(
        response: 200,
        description: 'Успешный ответ',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    description: 'Список точек графика',
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(
                                property: 'date',
                                description: 'Дата (начало периода)',
                                type: 'string',
                                format: 'date',
                            ),
                            new OA\Property(
                                property: 'quantity',
                                description: 'Суммарное количество проданных штук',
                                type: 'integer',
                            ),
                        ],
                    ),
                ),
            ],
        )
    )]
    public function __invoke(): mixed;
}

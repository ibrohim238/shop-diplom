<?php

namespace App\Versions\Admin\Swagger\Controllers;

use OpenApi\Attributes as OA;

interface OrderItemReporterController
{
    #[OA\Get(
        path: '/order-item-reporters/charts',
        description: 'Возвращает список точек графика: суммарное количество товаров по дням/неделям/месяцам/годам',
        summary: 'График продаж по датам',
        tags: ['OrderItemReporter'],
        parameters: [
            new OA\Parameter(
                name: 'period',
                description: 'Диапазон дат в формате "YYYY/MM/DD-YYYY/MM/DD"',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string', example: '2023/01/01-2023/01/31')
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
                    example: 'week'
                )
            ),
            new OA\Parameter(
                name: 'type',
                description: 'Тип отчёта: по товару или по категории',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                    enum: ['product', 'category'],
                    example: 'product'
                )
            ),
            new OA\Parameter(
                name: 'model_id',
                description: 'ID товара или категории для фильтрации',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer', example: 42)
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Успешный ответ',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            description: 'Массив точек графика',
                            type: 'array',
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(
                                        property: 'date',
                                        description: 'Дата (начало периода)',
                                        type: 'string',
                                        format: 'date'
                                    ),
                                    new OA\Property(
                                        property: 'quantity',
                                        description: 'Суммарное количество штук',
                                        type: 'integer'
                                    ),
                                    new OA\Property(
                                        property: 'total_amount',
                                        description: 'Суммарная сумма продаж',
                                        type: 'number',
                                        format: 'float'
                                    ),
                                ]
                            )
                        )
                    ]
                )
            )
        ]
    )]
    public function charts(): mixed;

    #[OA\Get(
        path: '/order-item-reporters/charts/sum',
        summary: 'Суммарные показатели за период',
        tags: ['OrderItemReporter'],
        parameters: [
            new OA\Parameter(ref: '#/components/parameters/period'),
            new OA\Parameter(ref: '#/components/parameters/type'),
            new OA\Parameter(ref: '#/components/parameters/model_id'),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Сумма quantity и total_amount',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'quantity', type: 'integer'),
                        new OA\Property(property: 'total_amount', type: 'number', format: 'float'),
                    ]
                )
            )
        ]
    )]
    public function sum(): mixed;

    #[OA\Get(
        path: '/order-item-reporters/charts/avg',
        summary: 'Средние показатели за период',
        tags: ['OrderItemReporter'],
        parameters: [
            new OA\Parameter(ref: '#/components/parameters/period'),
            new OA\Parameter(ref: '#/components/parameters/type'),
            new OA\Parameter(ref: '#/components/parameters/model_id'),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Среднее quantity и total_amount',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'quantity', type: 'number', format: 'float'),
                        new OA\Property(property: 'total_amount', type: 'number', format: 'float'),
                    ]
                )
            )
        ]
    )]
    public function avg(): mixed;

    #[OA\Get(
        path: '/order-item-reporters/charts/max',
        summary: 'Максимальные показатели за период',
        tags: ['OrderItemReporter'],
        parameters: [
            new OA\Parameter(ref: '#/components/parameters/period'),
            new OA\Parameter(ref: '#/components/parameters/type'),
            new OA\Parameter(ref: '#/components/parameters/model_id'),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Максимум quantity и total_amount',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'quantity', type: 'integer'),
                        new OA\Property(property: 'total_amount', type: 'number', format: 'float'),
                    ]
                )
            )
        ]
    )]
    public function max(): mixed;

    #[OA\Get(
        path: '/order-item-reporters/charts/min',
        summary: 'Минимальные показатели за период',
        tags: ['OrderItemReporter'],
        parameters: [
            new OA\Parameter(ref: '#/components/parameters/period'),
            new OA\Parameter(ref: '#/components/parameters/type'),
            new OA\Parameter(ref: '#/components/parameters/model_id'),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Минимум quantity и total_amount',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'quantity', type: 'integer'),
                        new OA\Property(property: 'total_amount', type: 'number', format: 'float'),
                    ]
                )
            )
        ]
    )]
    public function min(): mixed;
}

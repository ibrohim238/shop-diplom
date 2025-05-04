<?php

namespace Tests\Feature\Admin;

use App\Models\Order;
use Tests\AuthTestCase;
use App\Versions\Admin\Http\Controllers\OrderController;

class OrderControllerTest extends AuthTestCase
{
    public function test_index_returns_paginated_orders_with_correct_structure(): void
    {
        Order::factory()->count(12)->create();

        $response = $this->getJson(
            action([OrderController::class, 'index'])
        );

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'total_amount',
                        'status',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'links',
                'meta',
            ]);
    }

    public function test_show_returns_order_with_correct_structure(): void
    {
        $order = Order::factory()->create();

        $response = $this->getJson(
            action([OrderController::class, 'show'], ['order' => $order->id])
        );

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'total_amount',
                    'status',
                    'items',
                    'coupon',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }
}

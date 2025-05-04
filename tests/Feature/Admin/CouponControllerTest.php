<?php

namespace Tests\Feature\Admin;

use App\Models\Coupon;
use App\Versions\Admin\Http\Controllers\CouponController;
use Tests\AuthTestCase;

class CouponControllerTest extends AuthTestCase
{
    public function test_index_returns_paginated_coupons(): void
    {
        // Создаём 30 купонов
        Coupon::factory()->count(30)->create();

        $response = $this->getJson(
            action([CouponController::class, 'index'], ['limit' => 10])
        );

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'code',
                        'description',
                        'type',
                        'amount',
                        'quality_allowed',
                        'quantity_used',
                        'expires_date',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'links',
                'meta',
            ])
            ->assertJsonCount(10, 'data');
    }

    public function test_show_returns_single_coupon(): void
    {
        $coupon = Coupon::factory()->create();

        $response = $this->getJson(
            action([CouponController::class, 'show'], ['coupon' => $coupon->id])
        );

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'code',
                    'description',
                    'type',
                    'amount',
                    'quality_allowed',
                    'quantity_used',
                    'expires_date',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

    public function test_store_creates_new_coupon(): void
    {
        // Генерируем не сохраняемый экземпляр
        $data = Coupon::factory()->make()->toArray();

        $response = $this->postJson(
            action([CouponController::class, 'store']),
            $data
        );

        $response->assertCreated()
            ->assertJsonPath('data.code', $data['code']);
    }

    public function test_destroy_deletes_coupon(): void
    {
        $coupon = Coupon::factory()->create();

        $response = $this->deleteJson(
            action([CouponController::class, 'destroy'], ['coupon' => $coupon->id])
        );

        $response->assertNoContent();

        $this->assertSoftDeleted('coupons', [
            'id' => $coupon->id,
        ]);
    }
}

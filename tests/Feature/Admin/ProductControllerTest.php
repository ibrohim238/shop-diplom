<?php

namespace Tests\Feature\Admin;

use Faker\Provider\Image;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\AuthTestCase;
use App\Models\Product;
use App\Models\Category;
use App\Versions\Admin\Http\Controllers\ProductController;

class ProductControllerTest extends AuthTestCase
{
    public function test_index_returns_paginated_products_with_correct_structure(): void
    {
        Product::factory()->count(15)->create();

        $limit = 5;
        $response = $this->getJson(
            action([ProductController::class, 'index'], ['limit' => $limit])
        );

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'price',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'links',
                'meta',
            ])
            ->assertJsonCount($limit, 'data');
    }

    public function test_show_returns_product_with_correct_structure(): void
    {
        $product = Product::factory()->create();

        $response = $this->getJson(
            action([ProductController::class, 'show'], ['product' => $product->id])
        );

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'price',
                    'medias',
                    'categories',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

    public function test_store_creates_new_product_and_returns_its_representation(): void
    {
        $categories = Category::factory()->count(2)->create();

        $image = UploadedFile::fake()->image('avatar.jpg', 720, 720);;

        $media = $this->user->addMedia($image)->toMediaCollection('temp', 'temporary');

        $payload = [
            'name'         => 'New product',
            'price'        => 123.45,
            'medias'       => [$media->id],
            'category_ids' => $categories->pluck('id')->all(),
            'quantity'     => 1
        ];

        $response = $this->postJson(
            action([ProductController::class, 'store']),
            $payload
        );

        $response->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'price',
                    'medias',
                    'categories',
                    'created_at',
                    'updated_at',
                ],
            ]);

        $this->assertDatabaseHas('products', [
            'name'  => 'New product',
            'price' => 123.45,
        ]);
    }

    public function test_update_modifies_product_and_returns_updated(): void
    {
        $product = Product::factory()->create([
            'name'  => 'Old name',
            'price' => 10.00,
        ]);

        $image = UploadedFile::fake()->image('avatar.jpg', 720, 720);;

        $media = $this->user->addMedia($image)->toMediaCollection('temp', 'temporary');

        $payload = [
            'name'  => 'Updated name',
            'price' => 99.99,
            'medias'       => [$media->id],
            'quantity'     => 1
        ];

        $response = $this->putJson(
            action([ProductController::class, 'update'], ['product' => $product->id]),
            $payload
        );

        $response->assertOk()
            ->assertJsonPath('data.name', 'Updated name')
            ->assertJsonPath('data.price', '99.99');

        $this->assertDatabaseHas('products', [
            'id'    => $product->id,
            'name'  => 'Updated name',
            'price' => 99.99,
        ]);
    }

    public function test_destroy_deletes_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson(
            action([ProductController::class, 'destroy'], ['product' => $product->id])
        );

        $response->assertNoContent();
        $this->assertSoftDeleted('products', ['id' => $product->id]);
    }
}

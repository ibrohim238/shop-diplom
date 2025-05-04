<?php

namespace Tests\Feature\Admin;

use Tests\AuthTestCase;
use App\Models\Category;
use App\Versions\Admin\Http\Controllers\CategoryController;

class CategoryControllerTest extends AuthTestCase
{
    public function test_index_returns_paginated_categories(): void
    {
        Category::factory()->count(30)->create();

        $response = $this
            ->getJson(
            action([CategoryController::class, 'index'], ['limit' => 10]),
        );

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'slug',
                        'created_at',
                        'updated_at',
                        'media',
                    ],
                ],
                'links',
                'meta',
            ])
            ->assertJsonCount(10, 'data');
    }

    public function test_show_returns_single_category(): void
    {
        $category = Category::factory()->create();

        $response = $this
            ->getJson(
            action([CategoryController::class, 'show'], ['category' => $category->slug]),
        );

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'slug',
                    'created_at',
                    'updated_at',
                    'media',
                ],
            ]);
    }

    public function test_store_creates_new_category(): void
    {
        $data = Category::factory()->make()->toArray();

        $response = $this
            ->postJson(
                action([CategoryController::class, 'store']),
                $data,
            );

        $response->assertCreated()
            ->assertJsonFragment([
                'name' => $data['name'],
            ]);
    }

    public function test_update_changes_existing_category(): void
    {
        $category = Category::factory()->create();
        $newData  = Category::factory()->make()->toArray();

        $response = $this->patchJson(
            action([CategoryController::class, 'update'], ['category' => $category->slug]),
            $newData,
        );

        $response->assertOk()
            ->assertJsonFragment([
                'id'   => $category->id,
                'name' => $newData['name'],
            ]);
    }

    public function test_destroy_deletes_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson(
            action([CategoryController::class, 'destroy'], ['category' => $category->slug]),
        );

        $response->assertNoContent();

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}

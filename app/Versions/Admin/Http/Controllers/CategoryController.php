<?php

namespace App\Versions\Admin\Http\Controllers;

use App\Models\Category;
use App\Versions\Admin\Dtos\CategoryDto;
use App\Versions\Admin\Http\Requests\CategoryRequest;
use App\Versions\Admin\Http\Resources\CategoryResource;
use App\Versions\Admin\Reporters\CategoryIndexReporter;
use App\Versions\Admin\Services\CategoryService;
use Illuminate\Http\Request;

final readonly class CategoryController
{
    public function index(Request $request, CategoryIndexReporter $reporter)
    {
        $categories = $reporter
            ->execute($request)
            ->with('media')
            ->paginate($request->get('limit', 15));

        return CategoryResource::collection($categories);
    }

    public function show(Category $category)
    {
        $category->load('media');

        return CategoryResource::make($category);
    }

    public function store(CategoryService $service, CategoryRequest $request)
    {
        $category = $service->store(CategoryDto::fromRequest($request));

        return CategoryResource::make($category);
    }

    public function update(Category $category, CategoryRequest $request)
    {
        app(CategoryService::class, [
            'category' => $category,
        ])
            ->update(CategoryDto::fromRequest($request));

        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        app(CategoryService::class, [
            'category' => $category,
        ])
            ->destroy();

        return response()->noContent();
    }
}

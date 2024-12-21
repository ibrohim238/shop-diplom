<?php

namespace App\Versions\Private\Http\Controllers;

use App\Models\Category;
use App\Versions\Private\Http\Resources\CategoryResource;
use App\Versions\Private\Reporters\CategoryIndexReporter;
use Illuminate\Http\Request;

final readonly class CategoryController
{
    public function index(Request $request, CategoryIndexReporter $reporter)
    {
        $categories = $reporter
            ->execute()
            ->paginate($request->get('limit', 15));

        return CategoryResource::collection($categories);
    }

    public function show(Category $category)
    {
        return CategoryResource::make($category);
    }
}

<?php

namespace App\Repositories\Eloquent;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function list(Category $category)
    {
        $categories = $category->filter()->paginate(request('per_page'));

        return new CategoryCollection($categories);
    }

    public function create(CategoryRequest $request)
    {
        $category = Category::create($request->all());

        return new \App\Http\Resources\Category($category);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return new \App\Http\Resources\Category($category->fresh());
    }
}

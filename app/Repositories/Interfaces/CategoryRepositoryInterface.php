<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function list(Category $category);
    public function create(CategoryRequest $request);
    public function update(CategoryRequest $request, Category $category);
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Traits\Responsable;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use Responsable;
    private $category;
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, Category $category)
    {
        $this->category = $category;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryRepository->list($this->category);

        return $this->sendResponse($categories, 'Category retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = $this->categoryRepository->create($request);

        return $this->sendResponse($category, 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category = new \App\Http\Resources\Category($category);

        return $this->sendResponse($category, 'Category retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category = $this->categoryRepository->update($request, $category);

        return $this->sendResponse($category, 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$category = Category::find($id))
        {
            return $this->sendError([], 'Category not found.');
        }

        $category->delete();
        return $this->sendResponse([], 'Category deleted successfully.');
    }
}

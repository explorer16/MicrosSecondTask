<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UploadFileRequest;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Traits\Responsable;

class ProductController extends Controller
{
    use Responsable;
    private $product;
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository, Product $product)
    {
        $this->product = $product;
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepository->list($this->product);

        return $this->sendResponse($products, 'Products retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = $this->productRepository->create($request);

        return $this->sendResponse($product, 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = new \App\Http\Resources\Product($product);

        return $this->sendResponse($product, 'Product retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product = $this->productRepository->update($request, $product);

        return $this->sendResponse($product, 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$category = Product::find($id))
        {
            return $this->sendError([], 'Category not found.');
        }

        $category->delete();
        return $this->sendResponse([], 'Category deleted successfully.');
    }

    public function upload(UploadFileRequest $request)
    {
        return $this->productRepository->upload($request);
    }

    public function import()
    {
        //
    }
}

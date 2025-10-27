<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\ImportProductsRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UploadFileRequest;
use App\Models\Product;

interface ProductRepositoryInterface
{
    public function list(Product $product);
    public function create(ProductRequest $request);
    public function update(ProductRequest $request, Product $product);
    public function upload(UploadFileRequest $request);
    public function import(ImportProductsRequest $request);
}

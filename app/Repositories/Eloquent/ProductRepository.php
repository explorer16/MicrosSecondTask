<?php

namespace App\Repositories\Eloquent;

use App\Http\Requests\ImportProductsRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UploadFileRequest;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Traits\Responsable;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{
    use Responsable;

    public function list(Product $product)
    {
        $products = $product->filter()->paginate(request('per_page'));

        return new ProductCollection($products);
    }

    public function create(ProductRequest $request)
    {
        $product = Product::create($request->all());

        return new \App\Http\Resources\Product($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());

        return new \App\Http\Resources\Product($product->fresh());
    }

    public function upload(UploadFileRequest $request)
    {
        if (!$product = Product::find($request->id)) {
            return $this->sendError([], 'Product not found');
        }
        if ($file_url = $product->file_url) {
            Storage::disk('s3')->delete($file_url);
        }
        $path = Storage::disk('s3')->putFile('files', $request->file('file'));

        $product->update(['file_url' => $path]);

        return $this->sendResponse([], 'Product upload successfully.');
    }

    public function import(ImportProductsRequest $request)
    {
        // TODO: Implement import() method.
    }
}

<?php

namespace App\Repositories\Eloquent;

use App\Http\Requests\SupplierRequest;
use App\Http\Resources\SupplierCollection;
use App\Models\Supplier;
use App\Repositories\Interfaces\SupplierRepositoryInterface;

class SupplierRepository implements SupplierRepositoryInterface
{

    public function list(Supplier $supplier): SupplierCollection
    {
        $suppliers = $supplier->filter()->paginate(request('per_page'));

        return new SupplierCollection($suppliers);
    }

    public function create(SupplierRequest $request): \App\Http\Resources\Supplier
    {
        $supplier = Supplier::create($request->all());

        return new \App\Http\Resources\Supplier($supplier);
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->all());

        return new \App\Http\Resources\Supplier($supplier->fresh());
    }
}

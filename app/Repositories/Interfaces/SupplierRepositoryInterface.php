<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;

interface SupplierRepositoryInterface
{
    public function list(Supplier $supplier);
    public function create(SupplierRequest $request);
    public function update(SupplierRequest $request, Supplier $supplier);
}

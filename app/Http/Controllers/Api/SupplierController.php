<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Http\Resources\SupplierCollection;
use App\Models\Supplier;
use App\Repositories\Interfaces\SupplierRepositoryInterface;
use App\Traits\Responsable;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    use Responsable;
    private $supplierRepository;
    private $supplier;
    public function __construct(SupplierRepositoryInterface $supplierRepository, Supplier $supplier)
    {
        $this->supplierRepository = $supplierRepository;
        $this->supplier = $supplier;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = $this->supplierRepository->list($this->supplier);

        return $this->sendResponse($suppliers, 'Suppliers retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        $supplier = $this->supplierRepository->create($request);

        return $this->sendResponse($supplier, 'Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        $supplier = new \App\Http\Resources\Supplier($supplier);

        return $this->sendResponse($supplier, 'Supplier retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier = $this->supplierRepository->update($request, $supplier);

        return $this->sendResponse($supplier, 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$supplier = Supplier::find($id))
        {
            return $this->sendError([], 'Supplier not found.');
        }

        $supplier->delete();
        return $this->sendResponse([], 'Supplier deleted successfully.');
    }
}

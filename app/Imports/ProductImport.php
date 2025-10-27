<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $category = Category::query()->where('name', $row['category'])->first();
        $supplier = Supplier::query()->where('name', $row['supplier'])->first();

        return new Product([
            'name' => $row['name'],
            'description' => $row['description'],
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'price' => (float) str_replace(',', '.', $row['price']),
        ]);
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->descrription,
            'category_id' => $this->category_id,
            'category' => $this->category,
            'supplier_id' => $this->supplier_id,
            'supplier' => $this->supplier,
            'price' => $this->price,
            'file_url' => $this->file_url,
            'created_by' => $this->created_by,
            'createdBy' => $this->createdBy,
            'updated_by' => $this->updated_by,
            'updatedBy' => $this->updatedBy,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

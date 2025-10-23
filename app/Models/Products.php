<?php

namespace App\Models;

use App\Traits\BooleanSoftDeletes;
use App\Traits\PrimaryUUID;
use App\Traits\UserRelations;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use UserRelations, PrimaryUUID, BooleanSoftDeletes;

    protected $table = 'products';
    protected $fillable = ['name', 'description', 'category_id', 'supplier_id', 'price', 'file_url', 'is_active'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function histories()
    {
        return $this->morphMany('App\Models\History', 'entity');
    }

    public function getMorphClass()
    {
        return 'products';
    }
}

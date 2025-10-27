<?php

namespace App\Models;

use App\Traits\BooleanSoftDeletes;
use App\Traits\HasCreatedBy;
use App\Traits\HasUpdatedBy;
use App\Traits\Historyable;
use App\Traits\PrimaryUUID;
use App\Traits\UserRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use UserRelations, PrimaryUUID, BooleanSoftDeletes, HasCreatedBy, HasUpdatedBy;
    use Historyable;
    use HasFactory;

    protected $table = 'products';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['name', 'description', 'category_id', 'supplier_id', 'price', 'file_url', 'is_active'];

    public function scopeFilter($query)
    {
        if ($filter = request('name')){
            $query = $query->where('name', 'like', '%' . $filter . '%');
        }
        if ($filter = request('category_id')){
            $query = $query->where('category_id', $filter);
        }
        if ($filter = request('supplier_id')){
            $query = $query->where('supplier_id', $filter);
        }
        if ($filter = request('price')){
            $query = $query->where('price', 'like', '%' . $filter . '%');
        }

        return $query;
    }

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

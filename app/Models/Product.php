<?php

namespace App\Models;

use App\Traits\BooleanSoftDeletes;
use App\Traits\PrimaryUUID;
use App\Traits\UserRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use UserRelations, PrimaryUUID, BooleanSoftDeletes;
    use HasFactory;

    protected $table = 'products';
    public $incrementing = false;
    protected $keyType = 'string';
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

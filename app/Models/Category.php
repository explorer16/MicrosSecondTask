<?php

namespace App\Models;

use App\Traits\PrimaryUUID;
use App\Traits\UserRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use UserRelations, PrimaryUUID;
    use HasFactory;

    protected $table = 'categories';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['name', 'parent_id', 'created_by', 'updated_by'];

    public function histories()
    {
        return $this->morphMany(History::class, 'entity');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function getMorphClass()
    {
        return 'categories';
    }
}

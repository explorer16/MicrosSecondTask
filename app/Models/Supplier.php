<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use App\Traits\HasUpdatedBy;
use App\Traits\Historyable;
use App\Traits\PrimaryUUID;
use App\Traits\UserRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use UserRelations, PrimaryUUID, HasCreatedBy, HasUpdatedBy;
    use Historyable;
    use HasFactory;

    protected $table = 'suppliers';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['name', 'phone', 'contact_name', 'website', 'description', 'created_by', 'updated_by'];

    public function scopeFilter($query)
    {
        if ($filter = request('name')){
            $query = $query->where('name', 'ilike', '%' . $filter . '%');
        }
        if ($filter = request('phone')){
            $query = $query->where('phone', 'like', '%' . $filter . '%');
        }
        if ($filter = request('contact_name')){
            $query = $query->where('contact_name', 'ilike', '%' . $filter . '%');
        }
        if ($filter = request('website')){
            $query = $query->where('website', $filter);
        }

        return $query;
    }

    public function histories()
    {
        return $this->morphMany(History::class, 'entity');
    }

    public function getMorphClass()
    {
        return 'suppliers';
    }
}

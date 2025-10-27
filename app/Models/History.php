<?php

namespace App\Models;

use App\Traits\PrimaryUUID;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use PrimaryUUID;

    const UPDATED_AT = null;

    protected $table = 'histories';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['user_id', 'entity_type', 'entity_id', 'action', 'changes', 'created_at'];

    public function scopeFilter($query)
    {
        if ($filter = request('user_id')) {
            $query = $query->where('user_id', $filter);
        }
        if ($filter = request('type')) {
            $query = $query->where('entity_type', $filter);
        }
        if ($filter = request('entity_id')) {
            $query = $query->where('entity_id', $filter);
        }
    }

    public function entity()
    {
        $this->morphTo();
    }
}

<?php

namespace App\Models;

use App\Traits\PrimaryUUID;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use PrimaryUUID;

    protected $table = 'histories';
    protected $fillable = ['user_id', 'entity_type', 'entity_id', 'action', 'changes', 'created_at'];

    public function entity()
    {
        $this->morphTo();
    }
}

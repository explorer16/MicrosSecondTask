<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

trait UserRelations
{
    use HasRelationships;
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}

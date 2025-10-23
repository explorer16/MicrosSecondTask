<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;

trait UserRelations
{
    use HasRelationships;
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by', 'id');
    }
}

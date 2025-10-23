<?php

namespace App\Models;

use App\Traits\PrimaryUUID;
use App\Traits\UserRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use UserRelations, PrimaryUUID;
    use HasFactory;

    protected $table = 'suppliers';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['name', 'phone', 'contact_name', 'website', 'description', 'created_by', 'updated_by'];

    public function histories()
    {
        return $this->morphMany(History::class, 'entity');
    }

    public function getMorphClass()
    {
        return 'suppliers';
    }
}

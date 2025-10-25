<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait HasCreatedBy
{
    protected static function bootHasCreatedBy(): void
    {
        static::creating(function ($model) {
            $model->created_by = Auth::user()->id;
        });
    }
}

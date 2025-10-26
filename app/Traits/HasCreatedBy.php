<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait HasCreatedBy
{
    protected static function bootHasCreatedBy(): void
    {
        static::creating(function ($model) {
            if ($model->created_by === null) {
                $model->created_by = Auth::id();
            }
        });
    }
}

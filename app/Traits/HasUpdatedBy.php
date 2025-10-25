<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait HasUpdatedBy
{
    protected static function bootHasUpdatedBy(): void
    {
        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id;
        });
    }
}

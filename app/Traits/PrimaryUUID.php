<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait PrimaryUUID
{
    protected static function bootPrimaryUUID()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->incrementing = false;
            $model->keyType = 'string';
        });
    }
}

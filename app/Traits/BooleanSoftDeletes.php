<?php

namespace App\Traits;

trait BooleanSoftDeletes
{
    protected static function bootBooleanSoftDeletes()
    {
        static::addGlobalScope('active', function ($query) {
            $query->where('is_active', true);
        });

        static::deleting(function ($model) {
            if (method_exists($model, 'forceDeleting') && $model->forceDeleting()) {
                return;
            }

            $model->is_active = false;
            $model->timestamps = false;
            $model->saveQuietly();
            return false;
        });
    }

    public function restore()
    {
        $this->is_active = true;
        $this->save();
    }

    public static function withInactive()
    {
        return static::withoutGlobalScope('active');
    }

    public static function onlyInactive()
    {
        return static::withoutGlobalScope('active')->where('is_active', false);
    }
}

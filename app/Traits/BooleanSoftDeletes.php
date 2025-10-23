<?php

namespace App\Traits;

trait BooleanSoftDeletes
{
    protected function bootBooleanSoftDeletes()
    {
        static::addGlobalScope('active', function ($query) {
            $query->where('active', true);
        });

        static::deleting(function ($model) {
            if ($this->forceDeleting()) {
                return;
            }

            $model->is_active = false;
            $model->save();

            return false;
        });
    }

    public function restore()
    {
        $this->in_active = true;
        $this->save();
    }

    public function withInactive()
    {
        return static::withoutGlobalScope('active');
    }

    public function onlyInactive()
    {
        return static::withoutGlobalScope('active')->where('is_active', false);
    }
}

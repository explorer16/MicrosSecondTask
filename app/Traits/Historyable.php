<?php

namespace App\Traits;

use App\Models\History;
use Illuminate\Support\Facades\Auth;

trait Historyable
{
    public static function bootHistoryable()
    {
        static::creating(fn($model) => $model->createHistory('created'));
        static::updating(fn($model) => $model->createHistory('updated'));
        static::deleting(fn($model) => $model->createHistory('deleted'));
    }

    public function createHistory(string $action): void
    {
        if ($id = Auth::id()) {
            History::create([
                'user_id' => $id,
                'entity_type' => $this->getMorphClass(),
                'entity_id' => $this->getKey(),
                'action' => $action,
                'changes' => json_encode($this->getAttributes(), JSON_UNESCAPED_UNICODE)
            ]);
        }
    }
}

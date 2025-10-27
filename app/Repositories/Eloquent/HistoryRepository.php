<?php

namespace App\Repositories\Eloquent;

use App\Models\History;
use App\Repositories\Interfaces\HistoryRepositoryInterface;

class HistoryRepository implements HistoryRepositoryInterface
{

    public function list(History $history)
    {
        $histories = $history->filter()->get();

        return $histories;
    }
}

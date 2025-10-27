<?php

namespace App\Repositories\Interfaces;

use App\Models\History;

interface HistoryRepositoryInterface
{
    public function list(History $history);
}

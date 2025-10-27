<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Repositories\Interfaces\HistoryRepositoryInterface;
use App\Traits\Responsable;

class HistoryController extends Controller
{
    use Responsable;
    private $history;
    private $historyRepository;
    public function __construct(HistoryRepositoryInterface $historyRepository, History $history)
    {
        $this->history = $history;
        $this->historyRepository = $historyRepository;
    }

    public function index()
    {
        $histories = $this->historyRepository->list($this->history);

        return $this->sendResponse($histories, 'History retrieved successfully.');
    }
}

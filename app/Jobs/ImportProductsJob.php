<?php

namespace App\Jobs;

use App\Imports\ProductImport;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportProductsJob implements ShouldQueue
{
    use Queueable;

    protected string $path;
    protected string $user_id;
    /**
     * Create a new job instance.
     */
    public function __construct(string $user_id, string $path)
    {
        $this->path = $path;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Auth::loginUsingId($this->user_id);

        $fullPath = Storage::disk('s3')->path($this->path);
        Excel::import(new ProductImport(), $fullPath);

        Auth::logout();
    }
}

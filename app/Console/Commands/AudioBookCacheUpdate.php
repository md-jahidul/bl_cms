<?php

namespace App\Console\Commands;

use App\Services\AudioBook\AudioBookService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AudioBookCacheUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mybl:audio-book-cache-scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Content Cache update in redis from AudioBook';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(
        AudioBookService $audioBookService
    ) {
        try {
            $audioBookService->getContents();

            Log::channel('available-product-cache-log')->info(
                'Audio-book content cache Successfully Updated'
            );
        } catch (\Exception $e) {
            Log::channel('available-product-cache-log')->error(
                'Audio-book content cache update Error:' . $e->getMessage()
            );
        }
    }
}
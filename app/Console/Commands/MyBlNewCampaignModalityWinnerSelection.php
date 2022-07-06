<?php

namespace App\Console\Commands;

use App\Models\MyBlProduct;
use App\Models\MyBlSearchContent;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

/**
 * Class SyncOffersForSearchContents
 * @package App\Console\Commands
 */
class MyBlNewCampaignModalityWinnerSelection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaign:winner-process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process winners of campaign';

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
    public function handle()
    {

    }

}

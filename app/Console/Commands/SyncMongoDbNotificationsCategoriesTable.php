<?php

namespace App\Console\Commands;

use App\Services\NotifiationV2\NotificationCategoryV2Service;
use Illuminate\Console\Command;

class SyncMongoDbNotificationsCategoriesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mybl-table-sync:mongodb-notifications_categories-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Notification Category Table With MongoDB';

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
        $notificationsCategoryV2Service = resolve(NotificationCategoryV2Service::class);
        $notificationsCategoryV2Service->syncNotificationCategory();
    }
}

<?php

namespace App\Console\Commands;

use App\Repositories\MyBlFlashHourProductRepository;
use App\Repositories\MyBlFlashHourReminderRepository;
use App\Repositories\NotificationCategoryRepository;
use App\Repositories\NotificationDraftRepository;
use App\Repositories\NotificationScheduleRepository;
use App\Traits\FileTrait;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FlashHourReminderScheduler extends Command
{
    use FileTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flash-hour-reminder:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a flash hour reminder scheduled XLSX file';

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
     * @param MyBlFlashHourProductRepository $flashHourProductRepository
     * @param MyBlFlashHourReminderRepository $reminderRepository
     * @param NotificationCategoryRepository $notificationCategoryRepository
     * @param NotificationScheduleRepository $notificationScheduleRepository
     * @param NotificationDraftRepository $notificationDraftRepository
     * @return array|void
     */
    public function handle(
        MyBlFlashHourProductRepository $flashHourProductRepository,
        MyBlFlashHourReminderRepository $reminderRepository,
        NotificationCategoryRepository $notificationCategoryRepository,
        NotificationScheduleRepository $notificationScheduleRepository,
        NotificationDraftRepository $notificationDraftRepository
    ) {
        try {
            $basePath = env('UPLOAD_BASE_PATH');

            $reminderList = $reminderRepository->findAll();
            $notificationCat = $notificationCategoryRepository->findOneByProperties(['slug' => 'flash_hour_reminder']);

            $notificationDraft = $notificationDraftRepository->findOneByProperties(
                ['category_id' => $notificationCat->id]
            );

            $productCodeWiseMsisdnList = [];
            foreach ($reminderList as $item) {
                $flashHourProduct = $flashHourProductRepository->findOneByProperties(
                    ['id' => $item->flash_hour_product_id]
                );
                $productCodeWiseMsisdnList[$flashHourProduct->product_code][] = $item->msisdn;
                $databaseFilePath = "notification-scheduler-files/flash-hour-reminder-$flashHourProduct->product_code.xlsx";
                $schedule = $notificationScheduleRepository->findOneByProperties(['file_name' => $databaseFilePath]);

                if (!$schedule) {
                    $scheduleData = [];
                    $scheduleData['notification_draft_id'] = $notificationDraft->id;
                    $scheduleData['notification_category_id'] = $notificationCat->id;
                    $scheduleData['title'] = "Flash Hour Product";
                    $scheduleData['message'] = "Flash Hour Product now available";
                    $scheduleData['start'] = $flashHourProduct->start_date;
                    $scheduleData['end'] = $flashHourProduct->end_date;
                    $scheduleData['file_name'] = $databaseFilePath;
                    $scheduleData['status'] = "active";
                    $notificationScheduleRepository->save($scheduleData);
                }
            }
            // Excel Generator
            foreach ($productCodeWiseMsisdnList as $productCode => $msisdns) {
                $databaseFilePath = "notification-scheduler-files/flash-hour-reminder-$productCode" . '.xlsx';
                $fullPath = "$basePath/$databaseFilePath";
                $this->excelGenerator($msisdns, $fullPath);
            }
        } catch (\Exception $e) {
            Log::info('Error:' . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function excelGenerator($msisdns, $fullPath)
    {
        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToFile($fullPath);
        foreach ($msisdns as $msisdn) {
            $cells = [
                WriterEntityFactory::createCell($msisdn),
            ];
            $singleRow = WriterEntityFactory::createRow($cells);
            $writer->addRow($singleRow);
        }
        $writer->close();
    }
}

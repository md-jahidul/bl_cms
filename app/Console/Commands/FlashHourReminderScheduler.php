<?php

namespace App\Console\Commands;

use App\Repositories\MyBlFlashHourProductRepository;
use App\Repositories\MyBlFlashHourReminderRepository;
use App\Repositories\NotificationCategoryRepository;
use App\Repositories\NotificationDraftRepository;
use App\Repositories\NotificationScheduleRepository;
use App\Traits\FileTrait;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FlashHourReminderScheduler extends Command
{
    use FileTrait;

    protected const PROCESSED = 0;
    protected const IN_PROGRESS = 1;
    protected const FLASH_HOUR_SLUG = "flash_hour_reminder";

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

            $reminderList = $reminderRepository->findByProperties(['status' => self::IN_PROGRESS]);
            $notificationCat = $notificationCategoryRepository->findOneByProperties(['slug' => self::FLASH_HOUR_SLUG]);

            $notificationDraft = $notificationDraftRepository->findOneByProperties(
                ['category_id' => $notificationCat->id]
            );

            $productCodeWiseMsisdnList = [];
            foreach ($reminderList as $item) {
                $productCodeWiseMsisdnList[$item->flash_hour_product_id][] = $item->msisdn;
                $item->update(['status' => self::PROCESSED]);
            }

            $productCodeWiseReminders = $reminderList->groupBy('flash_hour_product_id');
            foreach ($productCodeWiseReminders as $product) {
                $product = $product[0];
                $flashHourProduct = $flashHourProductRepository->findOne($product->flash_hour_product_id);

                $productCode = $flashHourProduct->product_code;

                $databaseFilePath = "notification-scheduler-files/flash-hour-reminder-$productCode" . '.xlsx';
                $fullPath = "$basePath/$databaseFilePath";
                $schedule = $notificationScheduleRepository->findOneByProperties(['file_name' => $databaseFilePath]);

                if (!$schedule) {
                    $scheduleData = [];
                    $scheduleData['notification_draft_id'] = $notificationDraft->id;
                    $scheduleData['notification_category_id'] = $notificationCat->id;
                    $scheduleData['title'] = "Flash Hour Product";
                    $scheduleData['message'] = "Flash Hour product now available";
                    $scheduleData['start'] = $flashHourProduct->start_date;
                    $scheduleData['end'] = $flashHourProduct->end_date;
                    $scheduleData['file_name'] = $databaseFilePath;
                    $scheduleData['status'] = "active";
                    $notificationScheduleRepository->save($scheduleData);
                }
                $this->excelGenerator($productCodeWiseMsisdnList[$flashHourProduct->id], $fullPath);
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
        if (file_exists($fullPath)) {
            $reader = ReaderFactory::createFromType(Type::XLSX);
            $reader->open($fullPath);

            $existingMsisdns = [];
            foreach ($reader->getSheetIterator() as $sheet) {
                if ($sheet->getIndex() > 0) {
                    break;
                }
                foreach ($sheet->getRowIterator() as $row) {
                    $cells = $row->getCells();
                    $existingMsisdns[] = $cells[0]->getValue();
                }
            }
            $msisdns = array_merge($msisdns, $existingMsisdns);
            $reader->close();
        }

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

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
    protected const MYBL_CAMPAIGN_SLUG = "mybl_campaign_reminder";

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
     * @var MyBlFlashHourProductRepository
     */
    private $flashHourProductRepository;
    /**
     * @var MyBlFlashHourReminderRepository
     */
    private $reminderRepository;
    /**
     * @var NotificationCategoryRepository
     */
    private $notificationCategoryRepository;
    /**
     * @var NotificationScheduleRepository
     */
    private $notificationScheduleRepository;
    /**
     * @var NotificationDraftRepository
     */
    private $notificationDraftRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        MyBlFlashHourProductRepository $flashHourProductRepository,
        MyBlFlashHourReminderRepository $reminderRepository,
        NotificationCategoryRepository $notificationCategoryRepository,
        NotificationScheduleRepository $notificationScheduleRepository,
        NotificationDraftRepository $notificationDraftRepository
    ) {
        $this->flashHourProductRepository = $flashHourProductRepository;
        $this->reminderRepository = $reminderRepository;
        $this->notificationCategoryRepository = $notificationCategoryRepository;
        $this->notificationScheduleRepository = $notificationScheduleRepository;
        $this->notificationDraftRepository = $notificationDraftRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return array|void
     */
    public function handle()
    {
        try {
            $basePath = env('UPLOAD_BASE_PATH');

            $reminderList = $this->reminderRepository->findByProperties(['status' => self::IN_PROGRESS]);

            $productCodeWiseMsisdnList = [];
            foreach ($reminderList as $item) {
                $productCodeWiseMsisdnList[$item->flash_hour_product_id][] = $item->msisdn;
                $item->update(['status' => self::PROCESSED]);
            }

            $productCodeWiseReminders = $reminderList->groupBy('flash_hour_product_id');
            foreach ($productCodeWiseReminders as $product) {
                $product = $product[0];
                $flashHourProduct = $this->flashHourProductRepository->findOne($product->flash_hour_product_id);

                if ($flashHourProduct->flashHour->reference_type == "flash_hour") {
                    $notificationCat = $this->notificationCategoryRepository->findOneByProperties(
                        ['slug' => self::FLASH_HOUR_SLUG]
                    );
                } else {
                    $notificationCat = $this->notificationCategoryRepository->findOneByProperties(
                        ['slug' => self::MYBL_CAMPAIGN_SLUG]
                    );
                }
                $notificationDraft = $this->notificationDraftRepository->findOneByProperties(
                    ['category_id' => $notificationCat->id]
                );
                $productCode = $flashHourProduct->product_code;

                $referenceWiseName = str_replace('_', '-', $flashHourProduct->flashHour->reference_type);

                $databaseFilePath = "notification-scheduler-files/$referenceWiseName-reminder-$productCode" . '.xlsx';
                $fullPath = "$basePath/$databaseFilePath";
                $schedule = $flashHourProduct->notificationSchedule;

                if (!$schedule) {
                    $scheduleData = [];
                    $scheduleData['notification_draft_id'] = $notificationDraft->id;
                    $scheduleData['notification_category_id'] = $notificationCat->id;
                    $scheduleData['title'] = $notificationDraft->title;
                    $scheduleData['message'] = $notificationDraft->body;
                    $scheduleData['start'] = $flashHourProduct->start_date;
                    $scheduleData['end'] = $flashHourProduct->end_date;
                    $scheduleData['file_name'] = $databaseFilePath;
                    $scheduleData['status'] = "active";
                    $flashHourProduct->notificationSchedule()->create($scheduleData);
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

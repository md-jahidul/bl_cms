<?php

namespace App\Console\Commands;

use App\Repositories\CampaignModalityReminderRepository;
use App\Repositories\CampaignNewModalityDetailRepository;
use App\Repositories\NotificationCategoryRepository;
use App\Repositories\NotificationDraftRepository;
use App\Repositories\NotificationScheduleRepository;
use App\Traits\FileTrait;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CampaignModalityReminderScheduler extends Command
{
    use FileTrait;

    protected const PROCESSED = 0;
    protected const IN_PROGRESS = 1;
    protected const CAMPAIGN_MODALITY_SLUG = "campaign_modality_reminder";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaign-modality-reminder:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a campaign modality reminder scheduled XLSX file';

    private $campaignNewModalityDetailRepository;
    /**
     * @var CampaignModalityReminderRepository
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
        CampaignNewModalityDetailRepository $campaignNewModalityDetailRepository,
        CampaignModalityReminderRepository $reminderRepository,
        NotificationCategoryRepository $notificationCategoryRepository,
        NotificationScheduleRepository $notificationScheduleRepository,
        NotificationDraftRepository $notificationDraftRepository
    ) {
        $this->campaignNewModalityDetailRepository = $campaignNewModalityDetailRepository;
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
                $productCodeWiseMsisdnList[$item->my_bl_campaign_detail_id][] = $item->msisdn;
                $item->update(['status' => self::PROCESSED]);
            }

            $productCodeWiseReminders = $reminderList->groupBy('my_bl_campaign_detail_id');
            foreach ($productCodeWiseReminders as $product) {
                $product = $product[0];
                $CampaignProduct = $this->campaignNewModalityDetailRepository->findOne($product->my_bl_campaign_detail_id);
                $notificationCat = $this->notificationCategoryRepository->findOneByProperties(
                    ['slug' => self::CAMPAIGN_MODALITY_SLUG]
                );
                $notificationDraft = $this->notificationDraftRepository->findOneByProperties(
                    ['category_id' => $notificationCat->id]
                );
                $productCode = $CampaignProduct->product_code;

                $referenceWiseName = str_replace('_', '-', self::CAMPAIGN_MODALITY_SLUG);

                $databaseFilePath = "notification-scheduler-files/$referenceWiseName-reminder-$productCode" . '.xlsx';
                $fullPath = "$basePath/$databaseFilePath";
                $schedule = $CampaignProduct->notificationSchedule;

                if (!$schedule) {
                    $scheduleData = [];
                    $scheduleData['notification_draft_id'] = $notificationDraft->id;
                    $scheduleData['notification_category_id'] = $notificationCat->id;
                    $scheduleData['title'] = $notificationDraft->title;
                    $scheduleData['message'] = $notificationDraft->body;
                    $scheduleData['start'] = $CampaignProduct->start_date;
                    $scheduleData['end'] = $CampaignProduct->end_date;
                    $scheduleData['file_name'] = $databaseFilePath;
                    $scheduleData['status'] = "active";
                    $CampaignProduct->notificationSchedule()->create($scheduleData);
                }
                $this->excelGenerator($productCodeWiseMsisdnList[$CampaignProduct->id], $fullPath);
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

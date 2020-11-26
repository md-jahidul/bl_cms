<?php

namespace App\Console\Commands;

use App\Jobs\NotificationSend;
use App\Models\NotificationSchedule;
use App\Services\NotificationService;
use App\Traits\FileTrait;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NotificationScheduler extends Command
{
    use FileTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executes a scheduled notification';

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
     * @param NotificationService $notificationService
     * @return mixed
     */
    public function handle(NotificationService $notificationService)
    {
        try {
            $user_phone = [];
            $currentTime = Carbon::now()->format('Y-m-d H:i:s');
            $activeSchedule = NotificationSchedule::where('start', '<=', $currentTime)
                ->where('end', '>=', $currentTime)
                ->where('status', 'active')
                ->first();

            if (!is_null($activeSchedule)) {
                $notification_id = $activeSchedule->notification_id;
                $category = $activeSchedule->notificationCategory;
                $path = $this->getPath($activeSchedule->file_name);
                $reader = ReaderFactory::createFromType(Type::XLSX);

                $reader->open($path);

                foreach ($reader->getSheetIterator() as $sheet) {
                    if ($sheet->getIndex() > 0) {
                        break;
                    }

                    foreach ($sheet->getRowIterator() as $row) {
                        $cells = $row->getCells();
                        $number = $cells[0]->getValue();
                        $user_phone [] = $number;

                        if (count($user_phone) == 300) {
                            $notification = $this->getNotificationArray($activeSchedule, $category, $user_phone);
                            NotificationSend::dispatch($notification, $notification_id, $user_phone,
                                $notificationService)
                                ->onQueue('notification');
                            $user_phone = [];
                        }
                    }
                }
                $reader->close();

                if (count($user_phone)) {
                    $notification = $this->getNotificationArray($activeSchedule, $category, $user_phone);
                    NotificationSend::dispatch($notification, $notification_id, $user_phone, $notificationService)
                        ->onQueue('notification');
                }

                // Setting the task status to completed to avoid duplicity
                NotificationSchedule::where('id', $activeSchedule->id)->update(['status' => 'completed']);
                Log::info('Success: Notification sending from excel');
                return [
                    'success' => true,
                    'message' => 'Scheduled Notification Sent Successfully'
                ];
            }
        } catch (\Exception $e) {
            Log::info('Error:' . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function getNotificationArray($activeSchedule, $category, array $userPhones): array
    {
        return [
            'title' => $activeSchedule->title,
            'body' => $activeSchedule->message,
            'category_slug' => $category->slug,
            'category_name' => $category->name,
            "sending_from" => "cms",
            "send_to_type" => "INDIVIDUALS",
            "recipients" => $userPhones,
            "is_interactive" => "NO",
            "data" => [
                "cid" => "1",
                "url" => "test.com",
                "component" => "offer",
            ],
        ];
    }
}

<?php

namespace App\Console\Commands;

use App\Jobs\NotificationSend;
use App\Models\NotificationDraft;
use App\Models\NotificationSchedule;
use App\Repositories\UserMuteNotificationCategoryRepository;
use App\Services\CustomerService;
use App\Services\NotificationService;
use App\Services\PushNotificationSendService;
use App\Traits\FileTrait;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
     * @param PushNotificationSendService $pushNotificationSendService
     * @param CustomerService $customerService
     * @param UserMuteNotificationCategoryRepository $userMuteNotificationCategoryRepository
     * @return mixed
     */
    public function handle(
        NotificationService $notificationService,
        PushNotificationSendService $pushNotificationSendService,
        CustomerService $customerService,
        UserMuteNotificationCategoryRepository $userMuteNotificationCategoryRepository
    ) {
        try {
            $userPhones = [];
            $currentTime = Carbon::now()->format('Y-m-d H:i:s');
            $activeSchedule = NotificationSchedule::where('start', '<=', $currentTime)
                ->where('end', '>=', $currentTime)
                ->where('status', 'active')
                ->first();

            if (!is_null($activeSchedule)) {
                $notification_id = $activeSchedule->notification_draft_id;
                $category = $activeSchedule->notificationCategory;
                $notificationDraft = $activeSchedule->notificationDraft;
                $checkCustomer = false;
                if ($notificationDraft->device_type != "all" || $notificationDraft->customer_type != "all") {
                    $checkCustomer = true;
                }
                $path = $this->getPath($activeSchedule->file_name);
                $reader = ReaderFactory::createFromType(Type::XLSX);

                $reader->open($path);

                $notificationData = [
                    'title' => $activeSchedule->title,
                    'message' => $activeSchedule->message,
                    'category_id' => $category->id,
                    'category_slug' => $category->slug,
                    'category_name' => $category->name,
                    'image_url' => $notificationDraft->image
                ];

                // $muteUsersPhone = $userMuteNotificationCategoryRepository->getUsersPhoneByCategory($category->id);

                /*
                 * Reading and parsing users from the uploaded spreadsheet
                 */
                foreach ($reader->getSheetIterator() as $sheet) {
                    if ($sheet->getIndex() > 0) {
                        break;
                    }
                    foreach ($sheet->getRowIterator() as $row) {
                        $cells = $row->getCells();
                        $userPhones [] = $cells[0]->getValue();;
                    }
                }
                $reader->close();

                /*
                 * Preparing chunks after removing users with notification off for this notification category
                 */
                // $filteredUserPhones = array_diff($userPhones, $muteUsersPhone);
                $filteredUserPhoneChunks = array_chunk($userPhones, 200);

                /*
                 * Dispatching chunks of users to notification send job
                 */

                $iteration = 1;

                $notificationInfo = NotificationDraft::find($notification_id);

                foreach ($filteredUserPhoneChunks as $userPhoneChunk) {

                    $userPhoneChunkFiltered = $userPhoneChunk;

                    if ($checkCustomer) {

                        // $userPhoneChunk = $customerService->getCustomerList([], $userPhoneChunk, $notification_id);

                        $sql = DB::connection('mysql_slave')
                            ->table('customers')
                            ->whereIn('phone', $userPhoneChunk);

                        if (!empty($notificationInfo->customer_type) && $notificationInfo->customer_type !== 'all') {
                            $sql = $sql->where('number_type', $notificationInfo->customer_type);
                            /*->pluck('phone')->toArray();*/
                        }

                        if (!empty($notificationInfo->device_type) && $notificationInfo->device_type !== 'all') {

                            $sql = $sql->where('device_type', $notificationInfo->device_type);

                            /*$userPhoneChunkFiltered = DB::connection('mysql_slave')
                                ->table('customers')
                                ->whereIn('phone', $userPhoneChunk)
                                ->where('device_type', $notificationInfo->device_type)
                                ->pluck('phone')->toArray();*/
                        }

                        $userPhoneChunkFiltered = $sql->pluck('phone')->toArray();
                    }

                    $notification = $pushNotificationSendService->getNotificationArray(
                        $notificationData,
                        $userPhoneChunkFiltered,
                        $notificationDraft
                    );

                    $delaySeconds = $iteration * 1;

                    NotificationSend::dispatch($notification, $notification_id, array_values($userPhoneChunkFiltered),
                        $notificationService, $activeSchedule)
                        ->onQueue('notification')->delay(Carbon::now()->addSeconds($delaySeconds));
                    $iteration++;
                }

                // Setting the task status to 'completed' to avoid duplicity from dispatching the same job
                NotificationSchedule::where('id', $activeSchedule->id)->update(['status' => 'completed']);
                Log::info('Success: Notification sending from excel');
                return [
                    'success' => true,
                    'message' => 'Notification Sent'
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

}

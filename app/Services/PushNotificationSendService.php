<?php

namespace App\Services;

use App\Repositories\NotificationDraftRepository;
use App\Repositories\NotificationRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;
use App\Http\Requests\NotificationRequest;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\File;

class PushNotificationSendService
{

    /**
     * @var NotificationRepository
     */
    protected $notificationRepository;

    /**
     * @var $NotificationDraftRepository
     */
    protected $notificationDraftRepository;


    /**
     * PushNotificationSendService constructor.
     * @param NotificationDraftRepository $notificationDraftRepository
     * @param NotificationRepository $notificationRepository
     */
    public function __construct(NotificationDraftRepository $notificationDraftRepository, NotificationRepository $notificationRepository)
    {
        $this->notificationDraftRepository = $notificationDraftRepository;
        $this->notificationRepository = $notificationRepository;
    }









}

<?php

namespace App\Services;

use App\Repositories\ContactRestoreLogRepository;
use Illuminate\Http\Request;

class ContactRestoreLogService
{
    /**
     * @var ContactRestoreLogRepository
     */
    protected $contactRestoreLogRepository;

    /**
     * ContactRestoreLogService constructor.
     * @param ContactRestoreLogRepository $contactRestoreLogRepository
     */
    public function __construct(ContactRestoreLogRepository $contactRestoreLogRepository)
    {
        $this->contactRestoreLogRepository = $contactRestoreLogRepository;
    }

    /**
     * @param Request $request
     * @param $number
     * @return array
     */
    public function getLogs(Request $request, $number)
    {
        return $this->contactRestoreLogRepository->getLogs($request, $number);
    }
}

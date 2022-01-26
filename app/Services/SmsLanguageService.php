<?php

namespace App\Services;

use App\Repositories\SmsLanguageRepository;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class SmsLanguageService
{
    use CrudTrait;

    /**
     * @var SmsLanguageRepository
     */
    private $smsLanguageRepository;

    /**
     * SmsLanguageService constructor.
     * @param SmsLanguageRepository $smsLanguageRepository
     */
    public function __construct(SmsLanguageRepository $smsLanguageRepository)
    {
        $this->smsLanguageRepository = $smsLanguageRepository;
        $this->setActionRepository($smsLanguageRepository);
    }

    /**
     * @param $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function saveData($data)
    {
        try {
            if ($data['status']) {
                $this->smsLanguageRepository->turnStatusToDraft($data['feature']);
            }
            $data['updated_by'] = Auth::user()->id;
            return $this->save($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    public function updateData($data, $id)
    {
        try {
            if ($data['status']) {
                $this->smsLanguageRepository->turnStatusToDraft($data['feature']);
            }
            $data['updated_by'] = Auth::user()->id;
            return $this->findOne($id)->update($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}

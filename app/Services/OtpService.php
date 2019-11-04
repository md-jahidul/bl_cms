<?php

namespace App\Services;

use App\Repositories\AppVersionRepository;
use App\Repositories\OtpConfigRepository;

class OtpService
{

    /**
     * @var AppVersionRepository
     */
    protected $otpRepository;


    /**
     * OtpService constructor.
     * @param OtpConfigRepository $otpRepository
     */
    public function __construct(OtpConfigRepository $otpRepository)
    {
        $this->otpRepository = $otpRepository;
    }


    /**
     * Version Info
     * @return mixed
     */
    public function getOtpConfigInfo()
    {
        return $this->otpRepository->findAll();
    }


    /**
     * @param $request
     * @return mixed
     */
    public function createOtpConfig($request)
    {
        return $this->otpRepository->create($request->all());
    }


    /**
     * Update otp config
     * @param $data
     * @param $config
     * @return mixed
     */
    public function updateOtpConfig($data, $config)
    {
        return  $config->update($data->all());
    }

    /**
     * @param $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteOtpConfig($id)
    {
        $config = $this->otpRepository->findOne($id);
        return $config->delete();
    }
}

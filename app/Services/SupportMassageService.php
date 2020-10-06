<?php

namespace App\Services;

use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use App\Repositories\SupportMassageRepository;
use Illuminate\Support\Facades\File;

class SupportMassageService
{
    use CrudTrait;

    /**
     * @var SupportMassageRepository
     */
    protected $supportMassageRepository;

    /**
     * StoreService constructor.
     * @param SupportMassageRepository $supportMassageRepository
     */
    public function __construct(SupportMassageRepository $supportMassageRepository)
    {
        $this->supportMassageRepository = $supportMassageRepository;
        $this->setActionRepository($supportMassageRepository);

    }


    /**
     * Retrieve store list
     *
     * @return mixed
     */
    public function getSupportMessageList()
    {
        return $this->supportMassageRepository->getSupportMessageList();
    }




}

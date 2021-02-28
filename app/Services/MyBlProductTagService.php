<?php

namespace App\Services;


use App\Repositories\MyBlProductTagRepository;
use App\Traits\CrudTrait;

class MyBlProductTagService
{
    use CrudTrait;
    /**
     * @var MyBlProductTagRepository
     */
    private $myBlProductTagRepository;

    /**
     * MyBlProductTagService constructor.
     * @param MyBlProductTagRepository $myBlProductTagRepository
     */
    public function __construct(MyBlProductTagRepository $myBlProductTagRepository)
   {
       $this->myBlProductTagRepository = $myBlProductTagRepository;
       $this->setActionRepository($myBlProductTagRepository);
   }

   public function store()
   {

   }
}

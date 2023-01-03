<?php
namespace App\Services;

use App\Repositories\ExploreCRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class ExploreCDetailsService
{
    use CrudTrait;
    
    protected $exploreCRepository;

    public function __construct(ExploreCRepository $exploreCRepository)
    {
        $this->exploreCRepository = $exploreCRepository;
        $this->setActionRepository($exploreCRepository);
    }

}

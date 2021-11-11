<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Repositories\AboutPageRepository;
use App\Repositories\MyblUsimEligibilityRepository;
use App\Repositories\PrizeRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class MyblUsimEligibilityService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var MyblUsimEligibilityRepository
     */
    private $usimEligibilityRepository;

    /**
     * AboutPageService constructor.
     * @param AboutPageRepository $aboutPageRepository
     */
    public function __construct(MyblUsimEligibilityRepository $usimEligibilityRepository)
    {
        $this->usimEligibilityRepository = $usimEligibilityRepository;
        $this->setActionRepository($usimEligibilityRepository);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getContent()
    {
        return $this->usimEligibilityRepository->getData();
    }

    public function upateUsimEligibilityData($data, $id)
    {
        $usimContentData = $this->findOne($id);
        if (request()->hasFile('image')) {
            $data['image'] = 'storage/' . $data['image']->store('usim-eligibility');
            if (isset($usimContentData->image)) {
                unlink($usimContentData->image);
            }
        }
        if ($usimContentData) {
            $usimContentData->update($data);
        } else {
//            dd($data);
            $this->save($data);
        }
        return response('USIM eligibility content save successfully!!');
    }
}

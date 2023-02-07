<?php


namespace App\Services;

use App\Repositories\FourGEligibilityMsgRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class FourGEligibilityMsgService
{
    use CrudTrait;

    /**
     * @var FourGEligibilityMsgRepository
     */
    private $fourGEligibilityMsgRepository;

    /**
     * TagCategoryService constructor.
     * @param FourGEligibilityMsgRepository $fourGEligibilityMsgRepository
     */
    public function __construct(FourGEligibilityMsgRepository $fourGEligibilityMsgRepository)
    {
        $this->fourGEligibilityMsgRepository = $fourGEligibilityMsgRepository;
        $this->setActionRepository($fourGEligibilityMsgRepository);
    }

    /**
     * Updating the TagCategory
     * @param $data
     * @return Response
     */
    public function updateEligibilityMsg($data, $id)
    {
        $msg = $this->findOne($id);
        $msg->update($data);
        return Response('Eligibility Messages updated successfully');
    }


    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteTagCategory($id)
    {
        $TagCategory = $this->findOne($id);
        $TagCategory->delete();
        return Response('Tag deleted successfully !');
    }
}

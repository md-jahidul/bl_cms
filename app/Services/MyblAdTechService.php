<?php


namespace App\Services;


use App\Repositories\MyblAdTechRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use DataTables;
use Carbon\Carbon;

class MyblAdTechService
{
    use CrudTrait;
    private $myblAdTechRepository;

    public function __construct(MyblAdTechRepository $myblAdTechRepository)
    {
        $this->myblAdTechRepository = $myblAdTechRepository;
        $this->setActionRepository($myblAdTechRepository);
    }

    public function save(array $data)
    {
        try {
            if($data['status'] == 1) {
                $this->myblAdTechRepository->allInactive();
            }
            $data['display_order'] = $this->findAll()->count() + 1;
            $data['image_url'] = 'storage/' . $data['image_url']->store('ad_tech');
            $this->myblAdTechRepository->save($data);

            return true;
        } catch (\Exception $e){

            return false;
        }
    }

    public function findOne($id, $relation = null)
    {
        return $this->myblAdTechRepository->findOne($id);
    }

    public function update($id, array $data)
    {
        try {
            if($data['status'] == 1) {
                $this->myblAdTechRepository->allInactive();
            }
            $adTech = $this->myblAdTechRepository->findOne($id);
            if (!empty($data['image_url'])) {
                $data['image_url'] = 'storage/' . $data['image_url']->store('ad_tech');
                if (isset($adTech) && file_exists($adTech->image_url)) {
                    unlink($adTech->image_url);
                }
            }

            return $adTech->update($data);
        } catch (\Exception $e) {

            Log::error('Error while update Ad Tech : ' . $e->getMessage());
            return false;
        }
    }

    public function updateOrdering($request)
    {
        $this->myblAdTechRepository->updateOrderingPosition($request);
        return new Response('Ordering has been successfully update');
    }
}

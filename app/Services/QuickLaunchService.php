<?php


namespace App\Services;


use App\Http\Helpers;
use App\Repositories\QuickLaunchRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class QuickLaunchService
{
    use CrudTrait;

    /**
     * @var QuickLaunchRepository
     */
    protected $quickLaunchRepository;

    /**
     * QuickLaunchService constructor.
     * @param QuickLaunchRepository $quickLaunchRepository
     */
    public function __construct(QuickLaunchRepository $quickLaunchRepository)
    {
        $this->quickLaunchRepository = $quickLaunchRepository;
        $this->setActionRepository($quickLaunchRepository);
    }

    /**
     * @return mixed
     */
    public function itemList()
    {
        return $this->quickLaunchRepository->getQuickLaunch();
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeQuickLaunchItem($data)
    {
        $count = count($this->quickLaunchRepository->findAll());
        $imageUrl = $this->imageUpload($data, 'image_url' , $data['title_en'], 'quick-launch-items');
        $data['image_url'] = env('APP_URL', 'http://localhost:8000'). '/quick-launch-items/'.$imageUrl;
        $data['display_order'] = ++$count;
        $this->save($data);
        return new Response('Quick Launch added successfully');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSortable($data)
    {
        $this->quickLaunchRepository->quickLaunchTableSort($data);
        return new Response('update successfully');
    }


    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updateQuickLaunch($data, $id)
    {
        $quickLaunch = $this->findOne($id);
        if (!empty($data['image_url'])){
            $imageUrl = $this->imageUpload($data, 'image_url' , $data['title_en'], 'quick-launch-items');
            $data['image_url'] = env('APP_URL', 'http://localhost:8000'). '/quick-launch-items/'.$imageUrl;
        }
        $quickLaunch->update($data);
        return Response('Quick launch updated successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteQuickLaunch($id)
    {
        $quickLaunch = $this->findOne($id);
        $quickLaunch->delete();
        return Response('Quick launch deleted successfully !');
    }

}

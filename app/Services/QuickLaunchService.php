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
     * @param $parent_id
     * @return mixed
     */
    public function itemList()
    {
        return $this->quickLaunchRepository->findAll();
    }

    public function imageUpload($request, $imageTitle, $location)
    {
        $file_name = str_replace(' ', '-', strtolower($imageTitle));
        $upload_date = date('Y-m-d-h-i-s');
        $image = request()->file('image_url');
        $fileType = $image->getClientOriginalExtension();
        $imageName = $upload_date.'_'.$file_name.'.' . $fileType;
        $directory = $location;
        $imageUrl = $imageName;
        $image->move($directory, $imageName);
        return $imageUrl;
    }


    /**
     * @param $data
     * @return Response
     */
    public function storeQuickLaunchItem($data)
    {
        $count = count($this->quickLaunchRepository->findAll());
        $imageUrl = $this->imageUpload($data, $data['en_title'], 'quick-launch-items');
        $data['image_url'] = env('APP_URL', 'http://localhost:8000'). '/quick-launch-items/'.$imageUrl;
        $data['display_order'] = ++$count;
        $this->save($data);
        return new Response('Quick Launch added successfully');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSort($data)
    {
        $this->menuRepository->menuTableSort($data);
        return new Response('Footer menu added successfully');
    }


    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updateQuickLaunch($data, $id)
    {
        $menu = $this->findOne($id);

        if (isset($data['image_url'])){
            echo "image found";
            di
        }
//        $imageUrl = $this->imageUpload($data, $data['en_title'], 'quick-launch-items');
//        $data['image_url'] = env('APP_URL', 'http://localhost:8000'). '/quick-launch-items/'.$imageUrl;


//        $menu->update($data);
//        return Response('Menu updated successfully');
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

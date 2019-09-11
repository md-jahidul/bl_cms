<?php


namespace App\Services;


use App\Http\Helpers;
use App\Repositories\QuickLaunchRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

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


    public function imageUpload($request, $location)
    {
        $file_name = str_replace(' ', '-', strtolower($request['en_title']));
        $upload_date = date('Y-m-d-h-i');

        $sliderImage = $request->file('image_url');
        $fileType = $sliderImage->getClientOriginalExtension();
        $imageName = $upload_date.'_'.$file_name.'.' . $fileType;

//        echo "<pre>";
//        print_r($imageName);
        $directory = $location;
        $imageUrl = $imageName;
        $sliderImage->move($directory, $imageName);
        return $imageUrl;
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeQuickLaunchItem($data)
    {

        $count = count($this->quickLaunchRepository->findAll());
//        $data['image_url'] = $this->imageUpload($data, 'quick-launch-items/');
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
    public function updateMenu($data, $id)
    {
        $menu = $this->findOne($id);
        $menu->update($data);
        return Response('Menu updated successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteMenu($id)
    {
        $menu = $this->findOne($id);
        $menu->delete();

        return [
            'message' => 'Menu delete successfully',
            'parent_id' => $menu->parent_id
        ];
    }

}

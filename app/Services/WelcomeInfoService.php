<?php
namespace App\Services;

use App\Repositories\WelcomeInfoRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class WelcomeInfoService
{

    use CrudTrait;


    /**
     * @var WelcomeInfoRepository
     */
    protected $welcomeInfoRepository;


    /**
     * WelcomeInfoService constructor.
     * @param WelcomeInfoRepository $welcomeInfoRepository
     */
    public function __construct(WelcomeInfoRepository $welcomeInfoRepository)
    {
        $this->welcomeInfoRepository = $welcomeInfoRepository;
        $this->setActionRepository($welcomeInfoRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeWelcomeInfo($data)
    {
        $data['icon'] = 'storage/'.$data['icon']->store('icon');
        $this->save($data);
        return new Response("Welcome Info has successfully been created");
    }

    /**
     * Updating the banner
     * @param $request
     * @param $wellcomeInfo
     * @return Response
     */
    public function updateWelcomeInfo($request, $wellcomeInfo)
    {
        $data = $request->all();
        if (isset($request->all()['icon'])) {
            unlink($wellcomeInfo->icon);
            $data['icon'] = 'storage/'.$request->all()['icon']->store('icon');
            $wellcomeInfo->update($data);
        } else {
            $data['icon'] = $wellcomeInfo->icon;
            $wellcomeInfo->update($data);
        }
        return Response('Welcome Info updated successfully !');
    }


    /**
     * @param $id
     */
    public function deleteWelcomeInfo($id)
    {
        // $slider-other-attr = $this->findOne($id);
        // $slider-other-attr->delete();
        // return Response('Slider deleted successfully !');
    }
}

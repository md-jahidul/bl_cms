<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\ShortCutRepository ;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use DB;


class ShortCutService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $shortCutRepository;


    /**
     * ShortCutService constructor.
     * @param ShortCutRepository $shortCutRepository
     */
    public function __construct(ShortCutRepository $shortCutRepository)
    {
        $this->shortCutRepository = $shortCutRepository;
        $this->setActionRepository($shortCutRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeShortCut($shortCut)
    {
        $shortCut['icon'] = 'storage/'.$shortCut['icon']->store('short_cuts_icon'); 
        $shortCut['component_identifier'] = strtolower(str_replace(" ","_",$shortCut['title']));
        $this->save($shortCut);
        return new Response("Short Cut has successfully been Added ");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateShortCut($request, $id)
    {
        $shortCut = $this->findOne($id);
        if(isset($request['icon'])){
            unlink($shortCut->icon);
            $request['icon'] = 'storage/'.$request['icon']->store('short_cuts_icon');
        }else{
            $request['icon'] = $shortCut->icon;
        }
        $request['component_identifier'] = strtolower(str_replace(" ","_",$request['title']));
        $shortCut->update($request);
        
        return new Response("Short-cut has successfully been updated");
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function destroyShortCut($id)
    {
        $shortcut =$this->findOne($id);
        unlink($shortcut['icon']);
        $shortcut->delete();
        return Response('Short-Cut deleted successfully !');
    }

}

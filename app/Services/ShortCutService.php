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
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use DB;
use Illuminate\Support\Facades\Log;

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



    public function getShortcutList()
    {
       return $this->shortCutRepository->getShortcutList();
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeShortCut($shortCut)
    {
        $shortCut['icon'] = 'storage/' . $shortCut['icon']->store('short_cuts_icon');
        $this->save($shortCut);
        return new Response("Shortcut has been successfully created");
    }

    /**
     * Updating the banner
     * @param $request
     * @param $id
     * @return Response
     */
    public function updateShortCut($request, $id)
    {
        $shortCut = $this->findOne($id);
        if (isset($request['icon'])) {
            try {
                unlink($shortCut->icon);
            } catch (\Exception $e) {
                Log::error('cannot remove shortcut icons');
            }
            $request['icon'] = 'storage/' . $request['icon']->store('short_cuts_icon');
        } else {
            $request['icon'] = $shortCut->icon;
        }
        $shortCut->update($request);

        return new Response("Shortcut has been successfully updated");
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function destroyShortCut($id)
    {
        $shortcut = $this->findOne($id);
        unlink($shortcut['icon']);
        $shortcut->delete();
        return Response('Shortcut has been successfully deleted');
    }


    /**
     * @param $request
     * @return Response
     */
    public function tableSortable($request)
    {
        $this->shortCutRepository->sortShortcutsList($request);
        return new Response('update successfully');
    }
}

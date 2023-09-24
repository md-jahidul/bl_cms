<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Helpers\Helper;
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
        if (isset($shortCut['other_info'])) {
            $shortCut['other_info'] = json_encode([
               'type' => strtolower($shortCut['component_identifier']),
               'content' => $shortCut['other_info']
            ]);
        }
        $version_code = Helper::versionCode($shortCut['android_version_code'], $shortCut['ios_version_code']);
        $shortCut = array_merge($shortCut, $version_code);
        unset($shortCut['android_version_code'], $shortCut['ios_version_code']);

       Helper::removeVersionControlRedisKey('shortcut');

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
        if (isset($request['other_info'])) {
            $request['other_info'] = json_encode([
                'type' => strtolower($request['component_identifier']),
                'content' => $request['other_info']
            ]);
        } else {
            $request['other_info'] = null;
        }

        $version_code = Helper::versionCode($request['android_version_code'], $request['ios_version_code']);
        $request = array_merge($request, $version_code);
        unset($request['android_version_code'], $request['ios_version_code']);
        Helper::removeVersionControlRedisKey('shortcut');

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
        Helper::removeVersionControlRedisKey('shortcut');

        return Response('Shortcut has been successfully deleted');
    }


    /**
     * @param $request
     * @return Response
     */
    public function tableSortable($request)
    {
        $this->shortCutRepository->sortShortcutsList($request);
        Helper::removeVersionControlRedisKey('shortcut');

        return new Response('update successfully');
    }
}

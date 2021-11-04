<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\WelcomeBannerRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class WelcomeBannerService
{
    use CrudTrait;

    /**
     * @var WelcomeBannerRepository
     */
    protected $welcomeBannerRepository;

    /**
     * @param WelcomeBannerRepository $welcomeBannerRepository
     */
    public function __construct(WelcomeBannerRepository $welcomeBannerRepository)
    {
        $this->welcomeBannerRepository = $welcomeBannerRepository;
        $this->setActionRepository($welcomeBannerRepository);
    }

    /**
     * Storing the welcome banner resource
     * @return Response
     */
    public function storeWelcomeBanner($data)
    {
        try {
            if (isset($data['banner_img'])) {
                $data['banner_img'] = 'storage/' . $data['banner_img']->store('welcome-banner');
            }

            $data['created_by'] = auth()->user()->id;

            $this->save($data);

            return new Response("Welcome Banner has been successfully created");
        } catch (\Exception $e) {
            return [
                'status' => 'Failed',
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Updating the welcome banner
     * @param $data
     * @param $id
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updateWelcomeBanner($data, $id)
    {
        try {
            $welcome_banner = $this->findOne($id);

            if (isset($data['banner_img'])) {
                $data['banner_img'] = 'storage/' . $data['banner_img']->store('welcome-banner');
            }

            $data['created_by'] = auth()->user()->id;

            $welcome_banner->update($data);

            return new Response("Welcome Banner has been successfully updated");
        } catch (\Exception $e) {
            return [
                'status' => 'Failed',
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteWelcomeBanner($id)
    {
        $welcome_banner = $this->findOne($id);
        unlink($welcome_banner->banner_img);
        $welcome_banner->delete();

        return new Response("Welcome Banner has been successfully updated");
    }
}

<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\AlRobotsRepository;
use App\Repositories\AmarOfferRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class AlRobotsService
{
    use CrudTrait;

    /**
     * @var AlRobotsRepository
     */
    private $alRobotsRepository;

    /**
     * AlRobotsRepository constructor.
     * @param AlRobotsRepository $alRobotsRepository
     */
    public function __construct(AlRobotsRepository $alRobotsRepository)
    {
        $this->alRobotsRepository = $alRobotsRepository;
        $this->setActionRepository($alRobotsRepository);
    }

    public function robotTxt()
    {
        return $this->alRobotsRepository->robotData();
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateRobotsTxt($data)
    {
        request()->validate([
            'txt' => 'required'
        ]);

        $robotTxt = $this->alRobotsRepository->robotData();
        if ($robotTxt) {
            $robotTxt->update($data);
        } else {
            $this->save($data);
        }
        return Response('Robots txt has been successfully updated');
    }
}

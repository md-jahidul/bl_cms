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
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AlRobotsService
{
    use CrudTrait;
    use FileTrait;

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

        $this->deleteFile('assetlite/server-files/robots.txt');
        $this->makeFile('assetlite/server-files/robots.txt', $data['txt']);

        $robotTxt = $this->alRobotsRepository->robotData();
        if ($robotTxt) {
            $data['updated_by'] = Auth::id();
            $robotTxt->update($data);
        } else {
            $data['created_by'] = Auth::id();
            $this->save($data);
        }
        return Response('Robots txt has been successfully updated');
    }


    /**
     * @return array
     */
    public function copyInRootDirectory(): array
    {
        $output = null;
        $retval = null;

        $source = env('SRC_DIRECTORY');
        $destination = env('DST_DIRECTORY');

        exec('cp'." ".$source.'robots.txt'." ".$destination, $output, $retval);

        return array($output, $retval);
    }
}

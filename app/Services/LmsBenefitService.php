<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 22/06/2020
 */

namespace App\Services;

use App\Repositories\EthicsRepository;
use App\Repositories\EthicsFilesRepository;
use App\Repositories\LmsBenefitRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;

class LmsBenefitService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var LmsBenefitRepository
     */
    private $benefitRepository;

    /**
     * LmsBenefitRepository constructor.
     * @param LmsBenefitRepository $benefitRepository
     */
    public function __construct(
        LmsBenefitRepository $benefitRepository
    ) {
        $this->benefitRepository = $benefitRepository;
        $this->setActionRepository($benefitRepository);
    }

    /**
     * Get ethics files
     * @return Response
     */
    public function getBenefit($slug)
    {
        return $this->benefitRepository->getBenefit($slug);
    }

    /**
     * update ethics page info
     * @param $request
     * @return array
     */
    public function saveBenefit($request)
    {
        try {
            //file upload in storege
            $fileDir = 'assetlite/images/loyalty/benefits';

            $filePath = $request['old_path'];
            if ($request['image_url'] != "") {
                $filePath = $this->upload($request['image_url'], $fileDir);

                //delete old web photo
                if ($request['old_path']) {
                    $this->deleteFile($request['image_url']);
                }
            }

            //save data in database
            $this->benefitRepository->saveFileData($filePath, $request);

            return [
                'success' => 1,
                'message' => "Page info updated"
            ];
        } catch (\Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Change file sorting
     * @return Response
     */
    public function changeFileSort($request)
    {
        return $this->benefitRepository->changeFileSorting($request);
    }

    /**
     * Change file sorting
     * @return Response
     */
    public function changeFileStatus($fileId)
    {
        return $this->benefitRepository->changeFileStatus($fileId);
    }

//    /**
//     * Change file sorting
//     * @return Response
//     */
//    public function getFileData($fileId)
//    {
//        return $this->benefitRepository->getFileData($fileId);
//    }

    /**
     * Delete file
     * @return int[]
     */
    public function deleteEthicsFile($fileId)
    {
        try {
            $file = $this->benefitRepository->getFileData($fileId);
            $filePath = $file->file_path;

            $this->benefitRepository->deleteFile($fileId);

            if ($filePath != "") {
                $this->deleteFile($filePath);
            }

            return [
                'success' => 1
            ];
        } catch (\Exception $e) {
            return [
                'success' => 0,
                'errors' => $e
            ];
        }
    }

}

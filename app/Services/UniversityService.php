<?php

namespace App\Services;

use App\Repositories\UniversityRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


class UniversityService
{
    use CrudTrait;

    /**
     * @var UniversityRepository
     */
    private $universityRepository;

    /**
     * UniversityRepository constructor.
     * @param UniversityRepository $universityRepository
     */
    public function __construct(UniversityRepository $universityRepository)
    {
        $this->universityRepository = $universityRepository;
        $this->setActionRepository($universityRepository);
    }

    /**
     * Storing the University resource
     * @return Response
     */
    public function storeUniversity($data)
    {
        $this->save($data);
        return new Response('University added successfully');
    }

    /**
     * Get Internet package
     * @return array
     */
    public function getUniversities($request)
    {
        return $this->universityRepository->getUniversityList($request);
    }

    /**
     * Upload/Save excel file
     * @return JsonResponse
     */
    public function saveExcel($request)
    {
        return $this->universityRepository->saveExcelFile($request);
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateUniversity($data, $id)
    {
        $university = $this->findOne($id);
        $university->update($data);
        return Response('University updated successfully !');
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function deleteUniversity($id)
    {
        return $this->universityRepository->deleteUniversity($id);

//        $university = $this->findOne($id);
//        $university->delete();
//        return Response('University deleted successfully !');
    }

}

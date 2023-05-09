<?php

namespace App\Repositories;
use App\Models\CourseTransactionStatus;

/**
 * Class CourseTransactionStatusRepository
 * @package App\Repositories
 */
class CourseTransactionStatusRepository extends BaseRepository
{
    /**
     * @var CourseTransactionStatus
     */
    protected $model;


    /**
     * CourseTransactionStatusRepository constructor.
     * @param CourseTransactionStatus $model
     */
    public function __construct(CourseTransactionStatus $model)
    {
        $this->model = $model;
    }


    /**
     * Store Transaction status
     *
     * @return mixed
    */
    public function storeCourseTransaction($data)
    {
        return $this->model->create($data);
    }

}

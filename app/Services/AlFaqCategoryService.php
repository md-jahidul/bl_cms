<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\AlFaqCategoryRepository;
use App\Traits\CrudTrait;
use http\Env\Response;
use Illuminate\Support\Facades\Auth;

class AlFaqCategoryService
{
    use CrudTrait;
    /**
     * @var AlFaqCategoryRepository
     */
    private $alFaqCategoryRepository;

    /**
     * DigitalServicesService constructor.
     * @param AlFaqCategoryRepository $alFaqCategoryRepository
     */
    public function __construct(AlFaqCategoryRepository $alFaqCategoryRepository)
    {
        $this->alFaqCategoryRepository = $alFaqCategoryRepository;
        $this->setActionRepository($alFaqCategoryRepository);
    }

    public function catUpdate($data, $id)
    {
        $category = $this->findOne($id);
        $data['updated_by'] = Auth::id();
        $category->update($data);
        return Response('Category update successfully');
    }

    public function getFaqsCategory($slug)
    {
        return $this->alFaqCategoryRepository->findOneByProperties(['slug' => $slug]);
    }
}

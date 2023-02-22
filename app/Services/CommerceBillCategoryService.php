<?php

namespace App\Services;

use App\Repositories\CommerceBillCategoryRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CommerceBillCategoryService
{
    use CrudTrait;
    private $commerceBillCategoryRepository;

    public function __construct(CommerceBillCategoryRepository $commerceBillCategoryRepository)
    {
        $this->commerceBillCategoryRepository = $commerceBillCategoryRepository;
        $this->setActionRepository($commerceBillCategoryRepository);
    }

    public function save(array $data)
    {
        $data['display_order'] = $this->findAll()->count() + 1;
        if (isset($data['logo'])) {
            $data['logo'] = 'storage/' . $data['logo']->store('commerce_bill_category');
        }
        $string = strtolower($data['title_en']);
        $data['slug'] = str_replace(" ", "_", $string);
        try {
            $this->commerceBillCategoryRepository->save($data);

            return true;
        } catch (\Exception $e){

            return false;
        }
    }

    public function findOne($id, $relation = null)
    {
        return $this->commerceBillCategoryRepository->findOne($id);
    }

    public function update($id, array $data)
    {
        $string = strtolower($data['title_en']);
        $data['slug'] = str_replace(" ", "_", $string);

        try {
            $category = $this->commerceBillCategoryRepository->findOne($id);
            if (!empty($data['logo'])) {
                $data['logo'] = 'storage/' . $data['logo']->store('commerce_bill_category');
                if (isset($category) && file_exists($category->logo)) {
                    unlink($category->logo);
                }
            }

            return $category->update($data);
        } catch (\Exception $e) {

            Log::error('Error while update Category : ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        return $this->commerceBillCategoryRepository->destroy($id);
    }

    public function tableSort($data)
    {
        $this->commerceBillCategoryRepository->manageTableSort($data);

        return new Response('Sorted successfully');
    }
}

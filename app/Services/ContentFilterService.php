<?php

namespace App\Services;

use App\Repositories\ContentFilterRepository;
use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ContentFilterService
{
    use CrudTrait;

    private $contentFilterRepository;

    public function __construct(ContentFilterRepository $contentFilterRepository)
    {
        $this->contentFilterRepository = $contentFilterRepository;
        $this->setActionRepository($contentFilterRepository);
    }

    public function save(array $data)
    {
        $data['display_order'] = $this->findAll()->count() + 1;
        try {
            $this->contentFilterRepository->save($data);

            return true;
        } catch (\Exception $e) {

            return false;
        }
    }

    public function findOne($id, $relation = null)
    {
        return $this->contentFilterRepository->findOne($id);
    }

    public function update($id, array $data)
    {
        try {

            $section = $this->contentFilterRepository->findOne($id);

            return $section->update($data);
        } catch (\Exception $e) {

            Log::error('Error while update section : ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        return $this->contentFilterRepository->destroy($id);
    }

    public function tableSort($data)
    {
        $this->contentFilterRepository->manageTableSort($data);

        return new Response('Sorted successfully');
    }
}

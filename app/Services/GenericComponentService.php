<?php

namespace App\Services;

use App\Repositories\GenericComponentRepository;
use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class GenericComponentService
{
    use CrudTrait;
    private $genericComponentRepository;

    public function __construct(GenericComponentRepository $genericComponentRepository)
    {
        $this->genericComponentRepository = $genericComponentRepository;
        $this->setActionRepository($genericComponentRepository);
    }

    public function save(array $data)
    {
        $data['component_key'] = str_replace(' ', '_', strtolower($data['title_en']));
        try {
            $this->genericComponentRepository->save($data);
            Redis::del('generic_component_data');

            return true;
        } catch (\Exception $e){

            return false;
        }
    }

    public function findOne($id, $relation = null)
    {
        return $this->genericComponentRepository->findOne($id);
    }

    public function update($id, array $data)
    {
        try {
            $section = $this->genericComponentRepository->findOne($id);
            $section->update($data);
            Redis::del('generic_component_data');

            return true;

        } catch (\Exception $e) {

            Log::error('Error while update section : ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        $this->genericComponentRepository->destroy($id);
        Redis::del('generic_component_data');

        return true;
    }
}

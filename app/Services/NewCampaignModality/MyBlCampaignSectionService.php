<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services\NewCampaignModality;

use App\Repositories\NewCampaignModality\MyBlCampaignSectionRepository;
use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

class MyBlCampaignSectionService
{
    use CrudTrait;
    private $myblCampaignSectionRepository;

    public function __construct(MyBlCampaignSectionRepository $myblCampaignSectionRepository)
    {
        $this->myblCampaignSectionRepository = $myblCampaignSectionRepository;
        $this->setActionRepository($myblCampaignSectionRepository);
    }

    public function save(array $data)
    {
        $data['display_order'] = $this->findAll()->count() + 1;

        $string = strtolower($data['title_en']);
        $data['slug'] = str_replace(" ", "_", $string);
        try {
            $this->myblCampaignSectionRepository->save($data);

            return true;
        } catch (\Exception $e){

            return false;
        }
    }

    public function findOne($id, $relation = null)
    {
        return $this->myblCampaignSectionRepository->findOne($id);
    }

    public function update($id, array $data)
    {
        $string = strtolower($data['title_en']);
        $data['slug'] = str_replace(" ", "_", $string);

        try {

            $section = $this->myblCampaignSectionRepository->findOne($id);

            return $section->update($data);
        } catch (\Exception $e) {

            Log::error('Error while update section : ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        return $this->myblCampaignSectionRepository->destroy($id);
    }

    public function tableSort($data)
    {
        $this->myblCampaignSectionRepository->manageTableSort($data);

        return new Response('Sorted successfully');
    }
}

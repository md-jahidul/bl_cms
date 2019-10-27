<?php


namespace App\Services;

use App\Models\PartnerCategory;
use App\Repositories\PartnerRepository;
use App\Repositories\PrizeRepository;
use App\Repositories\RoleRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class RoleService
{
    use CrudTrait;

    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * RoleService constructor.
     * @param RoleRepository $roleRepository
     */

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->setActionRepository($roleRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeRole($data)
    {
        $this->save($data);
        return new Response('Role added successfully');
    }



    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updatePartner($data, $id)
    {
        $partner = $this->findOne($id);
        if (!empty($data['company_logo'])) {
            $imageUrl = $this->imageUpload($data, "company_logo", $data['company_name_en'], 'images/partners-logo');
            $data['company_logo'] = env('APP_URL', 'http://localhost:8000').'/images/partners-logo/'. $imageUrl;
        }
        $partner->update($data);
        return Response('Partner update successfully !');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deletePartner($id)
    {
        $partner = $this->findOne($id);
        $partner->delete();
        return Response('Partner delete successfully');
    }
}

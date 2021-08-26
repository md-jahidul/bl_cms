<?php

namespace App\Services;


use App\Repositories\DynamicUrlRedirectionRepository;
use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DynamicUrlRedirectionService
{
    use CrudTrait;
    /**
     * @var DynamicUrlRedirectionRepository
     */
    private $redirectionRepository;

    /**
     * DynamicUrlRedirectionService constructor.
     * @param DynamicUrlRedirectionRepository $redirectionRepository
     */
    public function __construct(DynamicUrlRedirectionRepository $redirectionRepository)
    {
        $this->redirectionRepository = $redirectionRepository;
        $this->setActionRepository($redirectionRepository);
    }

    /**
     * Stores data to the DB
     * @param $data
     * @return Model
     */
    public function storeData($data)
    {
        $data['created_by'] = Auth::user()->id;
        $data['from_url'] = str_replace(' ', '', $data['from_url']);
        $data['to_url'] = str_replace(' ', '', $data['to_url']);
        return $this->save($data);
    }

    /**
     * Updates data to the specified row
     * @param array $data
     * @param $id
     * @return bool
     */
    public function updateData(array $data, $id)
    {
        if (isset($data['from_url']) && $data['to_url']) {
            $data['from_url'] = str_replace(' ', '', $data['from_url']);
            $data['to_url'] = str_replace(' ', '', $data['to_url']);
        }
        return $this->findOne($id)->update($data);
    }

    /**
     * Checks and returns boolean if an from url is already exists or not
     * @param $fromUrl
     * @return bool
     */
    public function ifRedirectionExist($fromUrl): bool
    {
        return $this->findBy(['from_url' => $fromUrl])->count() ? true : false;
    }
}

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

    public function storeData($data)
    {
        $data['created_by'] = Auth::user()->id;
        $data['from_url'] = str_replace(' ', '', $data['from_url']);
        $data['to_url'] = str_replace(' ', '', $data['to_url']);
        return $this->save($data);
    }

    public function updateData(array $data, $id)
    {
        if (isset($data['from_url']) && $data['to_url']) {
            $data['from_url'] = str_replace(' ', '', $data['from_url']);
            $data['to_url'] = str_replace(' ', '', $data['to_url']);
        }
        return $this->findOne($id)->update($data);
    }

}

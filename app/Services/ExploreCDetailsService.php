<?php
namespace App\Services;

use App\Repositories\ExploreCDetailsRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class ExploreCDetailsService
{
    use CrudTrait;
    
    protected $exploreCDetailsRepository;

    public function __construct( ExploreCDetailsRepository $exploreCDetailsRepository)
    {
        $this->exploreCDetailsRepository = $exploreCDetailsRepository;
        $this->setActionRepository($exploreCDetailsRepository);
    }

    public function getList($type)
    {
        // return $this->exploreCDetailsRepository->getAll();
        return $this->exploreCDetailsRepository->findByProperties(['type' => $type]);
    }

    public function getPage($id)
    {
        return $this->exploreCDetailsRepository->findOrFail($id);
    }

    public function savePage($data, $type)
    {
        try {
            $data['type'] = $type;
            $data['url_slug'] = str_replace(str_split('\/:*?" _<>|'), '-', strtolower($data['url_slug']));
            unset($data['_token']);
            $this->exploreCDetailsRepository->savePage($data);
            $response = [
                'success' => 1,
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
        return $response;
    }

    public function deletePage($id)
    {
        try {
            $this->exploreCDetailsRepository->findOrFail($id)->delete();
            $response = [
                'success' => 1,
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
        return $response;
    }

}

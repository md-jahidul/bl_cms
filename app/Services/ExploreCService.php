<?php
namespace App\Services;

use App\Repositories\ExploreCRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class ExploreCService
{
    use CrudTrait;
    
    protected $exploreCRepository;

    public function __construct(ExploreCRepository $exploreCRepository)
    {
        $this->exploreCRepository = $exploreCRepository;
        $this->setActionRepository($exploreCRepository);
    }



    public function exploreCList()
    {

        return $this->findAll();

    }

    public function store($data)
    {
        if (isset($data['img'])) {
            $data['img'] = 'storage/' . $data['img']->store('explore_c/images');
        }

        $this->save($data);
       
        return new Response("Explore C has been successfully created");
    }
    public function updateExploreC($data, $id){

        if (isset($data['img'])) {
            $data['img'] = 'storage/' . $data['img']->store('explore_c/images');
        }
        
        $exploreC = $this->findOne($id);
        $exploreC->update($data);

       return new Response("Explore C has been successfully Updated");
    }
    public function destroy($id){

       $exploreC = $this->findOne($id);
       $exploreC->delete();

       return new Response("Explore C has been successfully deleted");
    }


}

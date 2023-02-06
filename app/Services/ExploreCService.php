<?php
namespace App\Services;

use App\Repositories\ExploreCRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ExploreCService
{
    use CrudTrait;
    use FileTrait;
    
    protected $exploreCRepository;

    public function __construct(ExploreCRepository $exploreCRepository)
    {
        $this->exploreCRepository = $exploreCRepository;
        $this->setActionRepository($exploreCRepository);
    }



    public function exploreCList()
    {

        $orderBy = ['column' => 'display_order', 'direction' => 'asc'];
        return $this->findAll('', '', $orderBy);

    }

    public function store($data)
    {

        if (isset($data['image'])) 
        {
            $data['image'] = $this->upload($data['image'], 'assetlite/images/explore_c');
        }

        if( isset($data['image_mobile'])) 
        {
            $data['image_mobile'] = $this->upload($data['image_mobile'], 'assetlite/images/explore_c');
        }

        $countExploreCs = $this->exploreCRepository->findAll();
        $data['display_order'] = count($countExploreCs) + 1;

        $data['slug_en'] = Str::slug($data['slug_en']);
        $data['slug_bn'] = Str::slug($data['slug_bn']);

        $this->save($data);
       
        return new Response("Explore C has been successfully created");
    }
    public function updateExploreC($data, $id){
        
        $exploreC = $this->findOne($id);


        if (isset($data['image'])) 
        {
            $data['image'] = $this->upload($data['image'], 'assetlite/images/explore_c');
            $this->deleteFile($exploreC->image);
        }

        if( isset($data['image_mobile'])) 
        {
            $data['image_mobile'] = $this->upload($data['image_mobile'], 'assetlite/images/explore_c');
            $this->deleteFile($exploreC->image_mobile);
        }

        $data['slug_en'] = Str::slug($data['slug_en']);
        $data['slug_bn'] = Str::slug($data['slug_bn']);

        // if ($exploreC->slug_en == $data['slug_en']) {
        //     unset($data['slug_en']);
        // }
        // if ($exploreC->slug_bn == $data['slug_bn']) {
        //     unset($data['slug_bn']);
        // }

        // return $data;

        $exploreC->update($data);

       return new Response("Explore C has been successfully Updated");
    }
    public function destroy($id){

       $exploreC = $this->findOne($id);
       $exploreC->delete();

       return new Response("Explore C has been successfully deleted");
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSortable($data)
    {
        // return new Response($data['position']);
        
        $this->exploreCRepository->exploreCTableSort($data);
        return new Response('update successfully');
    }


}

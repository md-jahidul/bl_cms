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

        /**
         * Multiple btn start
         * shuvo
         */
        $results = [];
        if (isset($data['multi_item']) && !empty($data['multi_item'])) {
            $request_multi = $data['multi_item'];
            $item_count = isset($data['multi_item_count']) ? $data['multi_item_count'] : 0;
            for ($i = 1; $i <= $item_count; $i++) {
                foreach ($data['multi_item'] as $key => $value) {
                    $sub_data = [];
                    $check_index = explode('-', $key);
                    if ($check_index[1] == $i) {
                        $results[$i][$check_index[0]] = $value;
                    }
                }
            }
        }

        $data['multiple_attributes'] = (count($results) > 1) ? array_values($results) : null;

        /**
         * Multiple btn end
         */

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

        /**
         * Multiple btn Start
         * shuvo
         */
        $results = [];
        if (isset($data['multi_item']) && !empty($data['multi_item'])) {
            $request_multi = $data['multi_item'];
            $item_count = isset($data['multi_item_count']) ? $data['multi_item_count'] : 0;
            for ($i = 1; $i <= $item_count; $i++) {
                foreach ($data['multi_item'] as $key => $value) {
                    // print_r($value);
                    $sub_data = [];
                    $check_index = explode('-', $key);
                    if ($check_index[1] == $i) {
                        $results[$i][$check_index[0]] = $value;
                    }
                }
            }
            // return [$results, $data['multi_item']];
        }

        // get original data
        $new_multiple_attributes = $exploreC->multiple_attributes ?? null;

        //contains all the inputs from the form as an array
        $input_multiple_attributes = isset($results) ? array_values($results) : null;
        // return $data['multi_item'];

        $data['multiple_attributes'] = $input_multiple_attributes;
        /**
         * Multiple btn End
         */

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

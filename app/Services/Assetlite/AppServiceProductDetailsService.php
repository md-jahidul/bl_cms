<?php

namespace App\Services\Assetlite;

//use App\Repositories\AppServiceProductegoryRepository;

use App\Repositories\AppServiceProductDetailsRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Repositories\ComponentRepository;
use Illuminate\Http\Response;

class AppServiceProductDetailsService
{
	use CrudTrait;
	use FileTrait;
	const PAGE_TYPE = 'app_services';


	/**
	 * @var $appServiceProductDetailsRepository
	 */
	protected $appServiceProductDetailsRepository;
	/**
	 * @var AppServiceProductDetailsRepository
	 */

	/**
	 * @var $componentRepository
	 */
	protected $componentRepository;


	/**
	 * AppServiceProductService constructor.
	 * @param AppServiceProductDetailsRepository $appServiceProductDetailsRepository
	 */
	public function __construct(AppServiceProductDetailsRepository $appServiceProductDetailsRepository, ComponentRepository $componentRepository)
	{
		$this->appServiceProductDetailsRepository = $appServiceProductDetailsRepository;
		$this->componentRepository = $componentRepository;
		$this->setActionRepository($appServiceProductDetailsRepository);
	}

	public function sectionList($product_id)
	{
		$data = [];
		$data['section_body'] = $this->appServiceProductDetailsRepository->findSection($product_id);
		$data['fixed_section'] = $this->appServiceProductDetailsRepository->fixedSection($product_id);
		return $data;
	}

	/**
	 * @param $data
	 * @return Response
	 */
	public function storeAppServiceProductDetails($data, $tab_type, $product_id)
	{
		# Save sections data
		$sections_data = $data['sections'];

		// dd($data);
		
		
		$sections_data['product_id'] = $product_id;
		$sections_saved_data = $this->save($sections_data);

		if( isset($sections_saved_data->id) && !empty($sections_saved_data->id) ){
			# Save Component data                     
			$component_data = $data['component'];

			if( !empty($component_data) && count($component_data) > 0 ){
				foreach ($component_data as $key => $value) {

					$value['section_details_id'] = $sections_saved_data->id;
					$value['page_type'] = self::PAGE_TYPE;

					if (request()->hasFile('component.'.$key.'.image_url')) {
						$value['image'] = $this->upload($data['component'][$key]['image_url'], 'assetlite/images/app-service/product-details');
					}

					# Multiple item to save
					if( request()->filled('component.'.$key.'.multi_item') ){

						$request_multi = $value['multi_item'];
						$item_count = isset($value['multi_item_count']) ? $value['multi_item_count'] : 0;
						$results = [];
						for ($i = 1; $i <= $item_count; $i++) {
						    foreach ($request_multi as $m_key => $m_value) {
						        $sub_data = [];
						        $check_index = explode('-', $m_key);

						        if ($check_index[1] == $i) {
						            if ( request()->hasFile('component.'.$key.'.multi_item.'.$m_key) ) {

						            	// dd( request()->hasFile('component.'.$key.'.multi_item.'.$m_key) );
						                $m_value = $this->upload($data['component'][$key]['multi_item'][$m_key], 'assetlite/images/app-service/product/details');

						            }

						            $results[$i][$check_index[0]] = $m_value;
						            
						        }
						    }
						}

						$value['multiple_attributes'] = !empty($results) ? json_encode($results) : null;

					}

					
					# other attributes to save
					if( !empty($value['other_attr']) && count($value['other_attr']) > 0 ){
						$value['other_attributes'] = json_encode($value['other_attr']);
					}

					$this->componentRepository->save($value);
				}
			}

			

			return new Response('App Service details section component added successfully');
		}
		else{
			return new Response('Something went wrong! App Service details section component not added');
		}
		

		
	}

	/**
	 * [updateAppServiceDetailsComponent description]
	 * @param  [type] $data        [description]
	 * @param  [type] $compoent_id [description]
	 * @return [type]              [description]
	 */
	public function updateAppServiceDetailsComponent($data, $compoent_id, $key = null){

		$component = $this->componentRepository->findOne($compoent_id);
		
		if( isset($data['image_url']) && !empty($data['image_url']) ){
			$data['image'] = $this->upload($data['image_url'], 'assetlite/images/app-service/product-details');
		}

		if( isset($data['other_attr']) && !empty($data['other_attr']) ){
			$data['other_attributes'] = json_encode($data['other_attr']);
		}

		if( isset($data['multi_item']) && !empty($data['multi_item']) ){

			// dd($data['multi_item']);

			$request_multi = $data['multi_item'];
			$item_count = isset($data['multi_item_count']) ? $data['multi_item_count'] : 0;
			$results = [];
			for ($i = 1; $i <= $item_count; $i++) {
			    foreach ($request_multi as $m_key => $m_value) {
			        $sub_data = [];
			        $check_index = explode('-', $m_key);

			        if ($check_index[1] == $i) {
			            if ( request()->hasFile('component.'.$key.'.multi_item.'.$m_key) ) {
			                $m_value = $this->upload($data['multi_item'][$m_key], 'assetlite/images/app-service/product/details');
			            }

			            $results[$i][$check_index[0]] = $m_value;
			            
			        }
			    }
			}

			
			# get existing multiattr data
			$existing_multi_data = $component->multiple_attributes;

			if( !empty($existing_multi_data) ){
				$existing_multi_data = json_decode($existing_multi_data, true);

				$last_array_id = end($existing_multi_data)['id'];
				$last_display_order_id = end($existing_multi_data)['display_order'];

				$new_results = array_map(function($value) use ($last_array_id, $last_display_order_id){

					$value['id'] = ($value['id'] + $last_array_id);
					$value['display_order'] = $value['id'];

					return $value;

				}, $results);

			}

			$final_results = array_merge($existing_multi_data, $new_results);

			$data['multiple_attributes'] = !empty($final_results) ? json_encode($final_results) : null;

		}

		$component->update($data);

	}


	public function getSectionColumnInfoByID($section_id, $column_names = [])
	{
		return $this->appServiceProductDetailsRepository->findOneByProperties(['id' => $section_id], $column_names);
	}


	/**
	 * @param $data
	 * @param $id
	 * @return ResponseFactory|Response
	 */
	public function updateAppServiceDetailsSection($data, $id)
	{
		$appServiceProduct = $this->findOne($id);
		$appServiceProduct->update($data);
		return Response('App Service Section updated successfully');
	}

	/**
	 * @param $id
	 * @return ResponseFactory|Response
	 * @throws Exception
	 */
	public function deleteAppServiceProduct($id)
	{
		$appServiceCat = $this->findOne($id);
		$this->deleteFile($appServiceCat->product_img_url);
		$appServiceCat->delete();
		return Response('App Service Tab deleted successfully !');
	}

	public function fixedSectionUpdate($data, $tab_type, $product_id)
	{
		if (request()->hasFile('image')) {
			$data['image'] = $this->upload($data['image'], 'assetlite/images/app-service/product-details');
		}
		$data['tab_type'] = $tab_type;
		$data['product_id'] = $product_id;
		$findFixedSection = $this->appServiceProductDetailsRepository->checkFixedSection($product_id);

		if (!$findFixedSection) {
			$this->save($data);
		} else {
			if (!isset($data['other_attributes'])) {
				$data['other_attributes'] = null;
			}
			$this->deleteFile($findFixedSection['image']);
			$findFixedSection->update($data);
		}
		return Response('App Service Section Update Successfully');
	}


	/**
	 * [getJsonSectionComponentList description]
	 * @param  [type] $product_id [description]
	 * @return [type]             [description]
	 */
	public function getJsonSectionComponentList($section_id){

		$results = [];

		$section_list_component = $this->appServiceProductDetailsRepository->findOne($section_id, 'sectionComponent');

		$results['sections'] = $section_list_component;

		if( !empty($section_list_component->sectionComponent) && count($section_list_component->sectionComponent) > 0 ){
			foreach ($section_list_component->sectionComponent as $key => $value) {
			   $results['component'][] = $value;

			   if( isset($value->multiple_attributes) && !empty($value->multiple_attributes) ){
			   	$res = json_decode($value->multiple_attributes, true);
			   	usort($res, function($a, $b){return strcmp($a["display_order"], $b["display_order"]);});

			   	$results['component'][$key]['multiple_attributes'] = json_encode($res);
			   }

			   # get component type
			   $results['primary_component_type'] = $value->component_type;
			}
		}
		

	   return $results;

	}

	/**
	 * [getSectionComponentByID description]
	 * @param  [type] $section_id [description]
	 * @return [type]             [description]
	 */
	public function getSectionComponentByID($section_id){

		return $this->appServiceProductDetailsRepository->findOne($section_id, 'sectionComponent');

	}

	/**
	 * [tableSortable description]
	 * @return [type] [description]
	 */
	public function tableSortable($data){
		$this->appServiceProductDetailsRepository->sectionsTableSort($data);
		return new Response('update successfully');
	}

}

<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\AlSlider;
use App\Models\AppServiceCategory;
use App\Models\AppServiceProduct;
use App\Models\AppServiceProductDetail;
use App\Models\Component;

class ComponentRepository extends BaseRepository
{
	 public $modelName = Component::class;


	 /**
	  * Component multiple attribute sort
	  * @param  [type] $request [description]
	  * @return [type]          [description]
	  */
	 public function multiAttrTableSort($request)
	 {

	 	$component_id = $request->component_id;

	 	$component_data = $this->model->findOrFail($component_id);

	 	if( !empty($component_data->multiple_attributes) ){

	 		$multi_attr = json_decode($component_data->multiple_attributes, true);

	 		$new_multiattr = null;
	 		$positions = $request->position;

	 		// dd($request->all());

	 		foreach ($positions as $position) {
	 		    $menu_id = $position[0]; // slider id / id
	 		    $new_order = $position[1]; // order position

	 		    $new_multiattr = array_map(function($value) use($menu_id, $new_order){

	 		    	if( $value['id'] == $menu_id ){

	 		    		$value['display_order'] = $new_order;

	 		    	}
	 		    	
	 		    	return $value;

	 		    }, $multi_attr);

	 		} // End foreach

	 	}

	 	// dd($new_multiattr);

	 	if( !empty($new_multiattr) && count($new_multiattr) > 0 ){

	 		$component_data->multiple_attributes = json_encode($new_multiattr);


	 		$component_data->update();

	 		return true;
	 	}
	 	else{
	 		return false;
	 	}

	 	
		
	 }


} // Class end

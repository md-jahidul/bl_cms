<?php

namespace App\Http\Controllers\AssetLite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use App\Services\Assetlite\ComponentService;
use App\Services\Assetlite\AppServiceProductDetailsService;


class ComponentController extends Controller
{
   
   /**
    * [$componentService description]
    * @var [object]
    */
   private $componentService;

   /**
    * [$appServiceProductDetailsService]
    * @var [type]
    */
   private $appServiceProductDetailsService;

   /**
    * [__construct description]
    * @param ComponentService $componentService [description]
    */
	public function __construct(
		ComponentService $componentService, 
		AppServiceProductDetailsService $appServiceProductDetailsService
	)
	{
		$this->componentService = $componentService;
		$this->appServiceProductDetailsService = $appServiceProductDetailsService;
	}


	/**
	 * [conponentList description]
	 * @param  [type] $tab_type   [description]
	 * @param  [type] $product_id [description]
	 * @return [type]             [description]
	 */
	public function conponentList($tab_type, $section_id)
	{

		$component_list = $this->componentService->componentList($section_id);

		$section_data = $this->appServiceProductDetailsService->getSectionColumnInfoByID($section_id, ['multiple_component', 'product_id']);

		$section_has_multiple_component = isset($section_data->multiple_component) ? $section_data->multiple_component : null;
		

		$data['tab_type'] = $tab_type;
		$data['section_id'] = $section_id;
		$data['product_id'] = isset($section_data->product_id) ? $section_data->product_id : null;



		return view('admin.app-service.details.components.index', compact('data', 'component_list', 'section_has_multiple_component'));

	}

	/**
	 * [conponentCreate description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function conponentCreate(Request $request)
	{

		$component_type = $request->input('component_type', '');
		$data['tab_type'] = $request->input('tab_type', '');
		$data['section_id'] = $request->input('section_id', '');

		return view('admin.app-service.details.components.create', compact('data', 'component_type'));

	}


	public function conponentStore(Request $request)
	{

		$response = $this->componentService->storeComponentDetails($request->all());

		$section_id = $request->input('section_details_id');
		$tab_type = $request->input('tab_type');

		Session::flash('message', 'Component added successfuly');
		return redirect( url("app-service/component/$tab_type/$section_id") );

	}


	public function conponentEdit($type, $id)
	{

		$appServiceProduct = $this->componentService->findOne($id);

		$component_type = $appServiceProduct->component_type;
		$data['tab_type'] = $type;
		$data['section_id'] = $appServiceProduct->section_details_id;

		// return view('admin.app-service.details.components.edit', compact('data', 'component_type'));
		return view('admin.app-service.details.components.edit', compact('appServiceProduct', 'data', 'component_type'));

	}


}

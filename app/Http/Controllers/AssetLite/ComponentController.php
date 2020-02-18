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

class ComponentController extends Controller
{
   
   /**
    * [$componentService description]
    * @var [object]
    */
   private $componentService;

   /**
    * [__construct description]
    * @param ComponentService $componentService [description]
    */
	public function __construct(ComponentService $componentService)
	{
		$this->componentService = $componentService;
	}


	/**
	 * [conponentList description]
	 * @param  [type] $tab_type   [description]
	 * @param  [type] $product_id [description]
	 * @return [type]             [description]
	 */
	public function conponentList($tab_type, $section_id){

		$component_list = $this->componentService->componentList();

		// dd($component_list);

		$data['tab_type'] = $tab_type;
		$data['section_id'] = $section_id;
		return view('admin.app-service.details.components.index', compact('data', 'component_list'));

	}

	/**
	 * [conponentCreate description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function conponentCreate(Request $request){

		$component_type = $request->input('component_type', '');
		$data['tab_type'] = $request->input('tab_type', '');
		$data['section_id'] = $request->input('section_id', '');

		return view('admin.app-service.details.components.create', compact('data', 'component_type'));

	}


	public function conponentStore(Request $request){


		$response = $this->componentService->storeComponentDetails($request->all());

		$section_id = $request->input('section_details_id');
		$tab_type = $request->input('tab_type');

		// dd($section_id);

		Session::flash('message', 'Component added successfuly');
		// return redirect(url("app-service/details/$tab_type/$product_id"));
		return redirect( url("app-service/component/$tab_type/$section_id") );


		// $data['tab_type'] = $tab_type;
		// $data['section_id'] = $section_id;

		// return view('admin.app-service.details.components.index', compact('data', 'component_list'));

	}

}

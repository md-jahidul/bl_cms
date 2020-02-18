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


	public function conponentCreate(Request $request){

		$component_type = $request->input('component_type', '');
		$data['tab_type'] = $request->input('tab_type', '');
		$data['section_id'] = $request->input('section_id', '');

		return view('admin.app-service.details.components.create', compact('data', 'component_type'));

	}


}

<?php

namespace App\Http\Controllers\AssetLite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\EcarrerService;
use App\Services\EcarrerItemService;
use App\Http\Controllers\AssetLite\ConfigController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class EcarrerItemController extends Controller
{
    
	/**
	 * ecarrer service
	 * @var [type]
	 */
   private $ecarrerItemService;

    public function __construct(EcarrerItemService $ecarrerItemService)
    {
        $this->ecarrerItemService = $ecarrerItemService;
        $this->middleware('auth');
    }


	/**
	 * [index description]
	 * @param  [type] $parent_id [description]
	 * @return [type]            [description]
	 */
	public function index($parent_id){

     $all_items = $this->ecarrerItemService->getItems($parent_id);
		
     return view('admin.ecarrer-items.index', compact('parent_id', 'all_items'));

	}

	/**
	 * [generalCreate create general section]
	 * @return [type] [description]
	 */
	public function create($parent_id){

		$ecarrer_section_slug = $this->ecarrerItemService->getEcarrerSectionSlugByID($parent_id);

		return view('admin.ecarrer-items.create', compact('parent_id', 'ecarrer_section_slug'));
	}

	/**
	 * Store general section on create
	 * @return [type] [description]
	 */
	public function store(Request $request, $parent_id){

		$image_upload_size = ConfigController::adminImageUploadSize();
		$image_upload_type = ConfigController::adminImageUploadType();
		
		# Check Image upload validation
		$validator = Validator::make($request->all(), [
		    'title' => 'required',
		    'image_url' => 'nullable|mimes:'.$image_upload_type.'|max:'.$image_upload_size // 2M
		]);
		if ($validator->fails()) {
		    Session::flash('error', $validator->messages()->first());
		    return redirect("ecarrer-items/$parent_id/list");
		}
		

		$this->ecarrerItemService->storeEcarrerItem($request->all(), $parent_id);

		Session::flash('message', 'Section created successfully!');
		return redirect("ecarrer-items/$parent_id/list");

	}

	/**
	 * Edit general section
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function edit($parent_id, $id){

		# TODO: Validation check
		$ecarrer_item = $this->ecarrerItemService->getSingleItemByIds($parent_id, $id);

		$ecarrer_section_slug = $this->ecarrerItemService->getEcarrerSectionSlugByID($parent_id);

		return view('admin.ecarrer-items.edit', compact('ecarrer_item', 'parent_id', 'ecarrer_section_slug'));

	}

	/**
	 * Update general section
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function update(Request $request, $parent_id, $id)
	{

		$image_upload_size = ConfigController::adminImageUploadSize();
		$image_upload_type = ConfigController::adminImageUploadType();
		
		# Check Image upload validation
		$validator = Validator::make($request->all(), [
		    'title' => 'required',
		    'image_url' => 'nullable|mimes:'.$image_upload_type.'|max:'.$image_upload_size // 2M
		]);
		if ($validator->fails()) {
		    Session::flash('error', $validator->messages()->first());
		    return redirect("ecarrer-items/$parent_id/list");
		}

		$this->ecarrerItemService->updateEcarrerItem($request->all(), $id);

		Session::flash('message', 'Item updated successfully!');
		return redirect("ecarrer-items/$parent_id/list");

	}


	public function destroy($parent_id, $id){

		$response = $this->ecarrerItemService->deleteItem($id);
		Session::flash('message', $response->getContent());
		return redirect("ecarrer-items/$parent_id/list");

	}

}

<?php

namespace App\Http\Controllers\AssetLite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\EcarrerService;
use App\Http\Controllers\AssetLite\ConfigController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class EcarrerController extends Controller
{
    
	/**
	 * ecarrer service
	 * @var [type]
	 */
   private $ecarrerService;

    public function __construct(EcarrerService $ecarrerService)
    {
        $this->ecarrerService = $ecarrerService;
        $this->middleware('auth');
    }


	/**
	 * [generalIndex description]
	 * @return [type] [description]
	 */
	public function generalIndex(){

     $general_section = $this->ecarrerService->generalSections();
		
     return view('admin.ecarrer.general.index', compact('general_section'));

	}

	/**
	 * [generalCreate create general section]
	 * @return [type] [description]
	 */
	public function generalCreate(){

		return view('admin.ecarrer.general.create');
	}

	/**
	 * Store general section on create
	 * @return [type] [description]
	 */
	public function generalStore(Request $request){

		$image_upload_size = ConfigController::adminImageUploadSize();
		$image_upload_type = ConfigController::adminImageUploadType();
		
		# Check Image upload validation
		$validator = Validator::make($request->all(), [
		    'title' => 'required',
		    'slug' => 'required',
		    'image_url' => 'nullable|mimes:'.$image_upload_type.'|max:'.$image_upload_size // 2M
		]);
		if ($validator->fails()) {
		    Session::flash('error', $validator->messages()->first());
		    return redirect('life-at-banglalink/general');
		}

		$this->ecarrerService->storeEcarrerGeneralSection($request->all());

		Session::flash('message', 'Section created successfully!');
		return redirect('life-at-banglalink/general');

	}

	/**
	 * Edit general section
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function generalEdit($id){

		$general_section = $this->ecarrerService->generalSectionById($id);
		return view('admin.ecarrer.general.edit', compact('general_section'));

	}

	/**
	 * Update general section
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function generalUpdate(Request $request, $id){

		$image_upload_size = ConfigController::adminImageUploadSize();
		$image_upload_type = ConfigController::adminImageUploadType();
		
		# Check Image upload validation
		$validator = Validator::make($request->all(), [
		    'title' => 'required',
		    'slug' => 'required',
		    'image_url' => 'nullable|mimes:'.$image_upload_type.'|max:'.$image_upload_size // 2M
		]);
		if ($validator->fails()) {
		    Session::flash('error', $validator->messages()->first());
		    return redirect('life-at-banglalink/general');
		}

		$this->ecarrerService->updateEcarrerGeneralSection($request->all(), $id);

		Session::flash('message', 'Section updated successfully!');
		return redirect('life-at-banglalink/general');

	}

	/**
	 * [generalDestroy description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function generalDestroy($id){

		$response = $this->ecarrerService->generalDelete($id);
		Session::flash('message', $response->getContent());
		return redirect("life-at-banglalink/general");

	}

}

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
	 * Available eCarrer portals category
	 * # life_at_bl_general
	 * # life_at_bl_teams
	 * # life_at_bl_events
	 * # life_at_bl_diversity
	 */

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

     $categoryTypes = 'life_at_bl_general';

     $sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);
		
     return view('admin.ecarrer.general.index', compact('sections'));

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

		$data_types['category'] = 'life_at_bl_general';
		$data_types['has_items'] = 1;
		# route slug
		$data_types['route_slug'] = $this->ecarrerService->getRouteSlug($request->path());

		$this->ecarrerService->storeEcarrerSection($request->all(), $data_types);

		Session::flash('message', 'Section created successfully!');
		return redirect('life-at-banglalink/general');

	}

	/**
	 * Edit general section
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function generalEdit($id){

		$section = $this->ecarrerService->generalSectionById($id);

		return view('admin.ecarrer.general.edit', compact('section'));

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

		$this->ecarrerService->updateEcarrerSection($request->all(), $id);

		Session::flash('message', 'Section updated successfully!');
		return redirect('life-at-banglalink/general');

	}

	/**
	 * [generalDestroy description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function generalDestroy($id){

		$response = $this->ecarrerService->sectionDelete($id);
		Session::flash('message', $response->getContent());
		return redirect("life-at-banglalink/general");

	}


	/**
	 * Life at banglalink teams section list
	 * @return [type] [description]
	 */
	public function teamsIndex(){

		$categoryTypes = 'life_at_bl_teams';

		$sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);
		
		return view('admin.ecarrer.teams.index', compact('sections'));

	}

	/**
	 * eCarrer life at banglalink teams
	 * @return [type] [description]
	 */
	public function teamsCreate(){

		return view('admin.ecarrer.teams.create');
	}

	/**
	 * eCarrer life at banglalink teams store on create
	 * @return [type] [description]
	 */
	public function teamsStore(Request $request){

		$validator = Validator::make($request->all(), [
		    'title' => 'required',
		    'slug' => 'required'
		]);
		if ($validator->fails()) {
		    Session::flash('error', $validator->messages()->first());
		    return redirect('life-at-banglalink/teams');
		}

		$data_types['category'] = 'life_at_bl_teams';
		$data_types['has_items'] = 1;
		# route slug
		$data_types['route_slug'] = $this->ecarrerService->getRouteSlug($request->path());

		$this->ecarrerService->storeEcarrerSection($request->all(), $data_types);

		Session::flash('message', 'Section created successfully!');
		return redirect('life-at-banglalink/teams');
	}


	/**
	 * eCarrer life at banglalink teams
	 * @return [type] [description]
	 */
	public function teamsEdit($id){

		$sections = $this->ecarrerService->generalSectionById($id);
		return view('admin.ecarrer.teams.edit', compact('sections'));
	}


	/**
	 * Update general section
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function teamsUpdate(Request $request, $id){

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
		    return redirect('life-at-banglalink/teams');
		}

		$this->ecarrerService->updateEcarrerSection($request->all(), $id);

		Session::flash('message', 'Section updated successfully!');
		return redirect('life-at-banglalink/teams');

	}


	public function teamsDestroy($id){

		$response = $this->ecarrerService->sectionDelete($id);
		Session::flash('message', $response->getContent());
		return redirect("life-at-banglalink/teams");

	}


	/**
	 * Life at banglalink diversity section list
	 * @return [type] [description]
	 */
	public function diversityIndex(){

		$categoryTypes = 'life_at_bl_diversity';

		$sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);
		
		return view('admin.ecarrer.diversity.index', compact('sections'));

	}

	/**
	 * eCarrer life at banglalink diversity
	 * @return [type] [description]
	 */
	public function diversityCreate(){

		return view('admin.ecarrer.diversity.create');
	}

	/**
	 * eCarrer life at banglalink diversity store on create
	 * @return [type] [description]
	 */
	public function diversityStore(Request $request){

		$validator = Validator::make($request->all(), [
		    'title' => 'required',
		    'slug' => 'required'
		]);
		if ($validator->fails()) {
		    Session::flash('error', $validator->messages()->first());
		    return redirect('life-at-banglalink/diversity');
		}

		$data_types['category'] = 'life_at_bl_diversity';
		$data_types['has_items'] = 1;
		# route slug
		$data_types['route_slug'] = $this->ecarrerService->getRouteSlug($request->path());

		$this->ecarrerService->storeEcarrerSection($request->all(), $data_types);

		Session::flash('message', 'Section created successfully!');
		return redirect('life-at-banglalink/diversity');
	}


	/**
	 * eCarrer life at banglalink diversity
	 * @return [type] [description]
	 */
	public function diversityEdit($id){

		$sections = $this->ecarrerService->generalSectionById($id);
		return view('admin.ecarrer.diversity.edit', compact('sections'));
	}


	/**
	 * Update general section
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function diversityUpdate(Request $request, $id){

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
		    return redirect('life-at-banglalink/diversity');
		}

		$this->ecarrerService->updateEcarrerSection($request->all(), $id);

		Session::flash('message', 'Section updated successfully!');
		return redirect('life-at-banglalink/diversity');

	}

	/**
	 * [diversityDestroy description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function diversityDestroy($id){

		$response = $this->ecarrerService->sectionDelete($id);
		Session::flash('message', $response->getContent());
		return redirect("life-at-banglalink/diversity");

	}
	

	/**
	 * Life at banglalink events section list
	 * @return [type] [description]
	 */
	public function eventsIndex(){

		$categoryTypes = 'life_at_bl_events';

		$sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);
		
		return view('admin.ecarrer.events.index', compact('sections'));

	}

	/**
	 * eCarrer life at banglalink events
	 * @return [type] [description]
	 */
	public function eventsCreate(){

		return view('admin.ecarrer.events.create');
	}

	/**
	 * eCarrer life at banglalink events store on create
	 * @return [type] [description]
	 */
	public function eventsStore(Request $request){

		$validator = Validator::make($request->all(), [
		    'title' => 'required',
		    'slug' => 'required'
		]);
		if ($validator->fails()) {
		    Session::flash('error', $validator->messages()->first());
		    return redirect('life-at-banglalink/events');
		}

		$data_types['category'] = 'life_at_bl_events';
		$data_types['has_items'] = 1;
		# route slug
		$data_types['route_slug'] = $this->ecarrerService->getRouteSlug($request->path());

		$data_types['route_slug'] = $this->ecarrerService->getRouteSlug($request->path());

		$additional_info = null;
		if( $request->filled('sider_info') ){
			$additional_info['sider_info'] = $request->input('sider_info');
		}

		if( !empty($additional_info) ){
			$data_types['additional_info'] = json_encode($additional_info);
		}
	
		$this->ecarrerService->storeEcarrerSection($request->all(), $data_types);

		Session::flash('message', 'Section created successfully!');
		return redirect('life-at-banglalink/events');
	}


	/**
	 * eCarrer life at banglalink events
	 * @return [type] [description]
	 */
	public function eventsEdit($id){

		$sections = $this->ecarrerService->generalSectionById($id);
		return view('admin.ecarrer.events.edit', compact('sections'));
	}


	/**
	 * Update general section
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function eventsUpdate(Request $request, $id){

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
		    return redirect('life-at-banglalink/events');
		}

		$additional_info = null;
		if( $request->filled('sider_info') ){
			$additional_info['sider_info'] = $request->input('sider_info');
		}

		if( !empty($additional_info) ){
			$data_types['additional_info'] = json_encode($additional_info);
		}

		$this->ecarrerService->updateEcarrerSection($request->all(), $id, $data_types);

		Session::flash('message', 'Section updated successfully!');
		return redirect('life-at-banglalink/events');

	}

	/**
	 * [eventsDestroy description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function eventsDestroy($id){

		$response = $this->ecarrerService->sectionDelete($id);
		Session::flash('message', $response->getContent());
		return redirect("life-at-banglalink/events");

	}


}

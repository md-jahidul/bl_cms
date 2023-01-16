<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\EcareerPortalRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\EcareerService;
use App\Http\Controllers\AssetLite\ConfigController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EcareerController extends Controller {
    /**
     * Available eCarrer portals category
     * # life_at_bl_general
     * # life_at_bl_teams
     * # life_at_bl_events
     * # life_at_bl_diversity
     * # life_at_bl_topbanner
     * # life_at_bl_contact
     * # vacancy_pioneer
     * # vacancy_viconbox
     * # programs_progeneral
     * # programs_proiconbox
     * # programs_photogallery
     * # programs_sapbatches
     * # programs_ennovatorbatches
     * # programs_top_tab_title
     */

    /**
     * ecarrer service
     * @var [type]
     */
    private $ecarrerService;

    public function __construct(EcareerService $ecarrerService) {
        $this->ecarrerService = $ecarrerService;
        $this->middleware('auth');
    }

    /**
     * [generalIndex description]
     * @return [type] [description]
     */
    public function generalIndex() {

        $categoryTypes = 'life_at_bl_general';

        $sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);

        return view('admin.ecarrer.general.index', compact('sections'));
    }


    /**
     * [generalCreate create general section]
     * @return [type] [description]
     */
    public function generalCreate() {

        return view('admin.ecarrer.general.create');
    }

    /**
     * Store general section on create
     * @return [type] [description]
     */
    public function generalStore(Request $request) {

        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();

        # Check Image upload validation
        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'slug' => 'required',
                    'image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size // 2M
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('life-at-banglalink/general');
        }

        $data_types['category'] = 'life_at_bl_general';
        $data_types['has_items'] = 1;
        # route slug
        $data_types['route_slug'] = $this->ecarrerService->getRouteSlug($request->path());


        $additional_info = null;
        if ($request->filled('sider_info')) {
            $additional_info['sider_info'] = $request->input('sider_info');
        }

        if (!empty($additional_info)) {
            $data_types['additional_info'] = json_encode($additional_info);
        }
        $this->ecarrerService->storeEcarrerSection($request->all(), $data_types);

        Session::flash('message', 'Section created successfully!');
        return redirect('life-at-banglalink/general');
    }

    /**
     * Edit general section
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function generalEdit($id) {
        $sections = $this->ecarrerService->generalSectionById($id);
        return view('admin.ecarrer.general.edit', compact('sections'));
    }

    /**
     * Update general section
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function generalUpdate(Request $request, $id) {

        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();

        # Check Image upload validation
        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'slug' => 'required',
                    'image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size // 2M
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('life-at-banglalink/general');
        }


        $data_types = null;
        $additional_info = null;
        if ($request->filled('sider_info')) {
            $additional_info['sider_info'] = $request->input('sider_info');
        }

        if (!empty($additional_info)) {
            $data_types['additional_info'] = json_encode($additional_info);
        }

        $this->ecarrerService->updateEcarrerSection($request->all(), $id, $data_types);

        Session::flash('message', 'Section updated successfully!');
        return redirect('life-at-banglalink/general');
    }

    /**
     * [generalDestroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function generalDestroy($id) {

        $response = $this->ecarrerService->sectionDelete($id);
        Session::flash('message', $response->getContent());
        return redirect("life-at-banglalink/general");
    }

    /**
     * [generalDestroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function generalSort(Request $request) {
        return $this->ecarrerService->tableSortable($request->position);
    }


    /**
     * Life at banglalink teams section list
     * @return [type] [description]
     */
    public function teamsIndex() {

        $categoryTypes = 'life_at_bl_teams';

        $sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);

        return view('admin.ecarrer.teams.index', compact('sections'));
    }

    /**
     * eCarrer life at banglalink teams
     * @return [type] [description]
     */
    public function teamsCreate() {

        return view('admin.ecarrer.teams.create');
    }

    /**
     * eCarrer life at banglalink teams store on create
     * @return [type] [description]
     */
    public function teamsStore(Request $request) {

        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'slug' => 'required'
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('life-at-banglalink/teams');
        }

        $data_types['category'] = 'life_at_bl_teams';

        $category_type = $request->input('category_type', null);
        if (!empty($category_type) && $category_type == 'teams_title') {
            $data_types['has_items'] = 0;
        } else if (!empty($category_type) && $category_type == 'teams_tab_section') {
            $data_types['has_items'] = 1;
        } else {
            $data_types['has_items'] = 1;
        }


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
    public function teamsEdit($id) {

        $sections = $this->ecarrerService->generalSectionById($id);
        return view('admin.ecarrer.teams.edit', compact('sections'));
    }

    /**
     * Update general section
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function teamsUpdate(Request $request, $id) {

        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();

        # Check Image upload validation
        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'slug' => 'required',
                    'image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size // 2M
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('life-at-banglalink/teams');
        }


        $data_types = null;

        $category_type = $request->input('category_type', null);
        if (!empty($category_type) && $category_type == 'teams_title') {
            $data_types['has_items'] = 0;
        } else if (!empty($category_type) && $category_type == 'teams_tab_section') {
            $data_types['has_items'] = 1;
        } else {
            $data_types['has_items'] = 1;
        }

        $this->ecarrerService->updateEcarrerSection($request->all(), $id, $data_types);

        Session::flash('message', 'Section updated successfully!');
        return redirect('life-at-banglalink/teams');
    }

    public function teamsDestroy($id) {

        $response = $this->ecarrerService->sectionDelete($id);
        Session::flash('message', $response->getContent());
        return redirect("life-at-banglalink/teams");
    }

    /**
     * Life at banglalink diversity section list
     * @return [type] [description]
     */
    public function diversityIndex() {

        $categoryTypes = 'life_at_bl_diversity';

        $sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);

        return view('admin.ecarrer.diversity.index', compact('sections'));
    }

    /**
     * eCarrer life at banglalink diversity
     * @return [type] [description]
     */
    public function diversityCreate() {

        return view('admin.ecarrer.diversity.create');
    }

    /**
     * eCarrer life at banglalink diversity store on create
     * @return [type] [description]
     */
    public function diversityStore(Request $request) {

        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
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
    public function diversityEdit($id) {

        $sections = $this->ecarrerService->generalSectionById($id);
        return view('admin.ecarrer.diversity.edit', compact('sections'));
    }

    /**
     * Update general section
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function diversityUpdate(Request $request, $id) {

        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();

        # Check Image upload validation
        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'slug' => 'required',
                    'image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size // 2M
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
    public function diversityDestroy($id) {

        $response = $this->ecarrerService->sectionDelete($id);
        Session::flash('message', $response->getContent());
        return redirect("life-at-banglalink/diversity");
    }

    /**
     * Life at banglalink events section list
     * @return [type] [description]
     */
    public function eventsIndex() {

        $categoryTypes = 'life_at_bl_events';

        $sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);

        return view('admin.ecarrer.events.index', compact('sections'));
    }

    /**
     * eCarrer life at banglalink events
     * @return [type] [description]
     */
    public function eventsCreate() {

        return view('admin.ecarrer.events.create');
    }

    /**
     * eCarrer life at banglalink events store on create
     * @return [type] [description]
     */
    public function eventsStore(Request $request) {

        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
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


        $additional_info = null;
        if ($request->filled('sider_info')) {
            $additional_info['sider_info'] = $request->input('sider_info');
        }

        if (!empty($additional_info)) {
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
    public function eventsEdit($id) {

        $sections = $this->ecarrerService->generalSectionById($id);
        return view('admin.ecarrer.events.edit', compact('sections'));
    }

    /**
     * Update general section
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function eventsUpdate(Request $request, $id) {

        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();

        # Check Image upload validation
        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'slug' => 'required',
                    'image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size // 2M
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('life-at-banglalink/events');
        }

        $data_types = null;
        $additional_info = null;
        if ($request->filled('sider_info')) {
            $additional_info['sider_info'] = $request->input('sider_info');
        }

        if (!empty($additional_info)) {
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
    public function eventsDestroy($id) {

        $response = $this->ecarrerService->sectionDelete($id);
        Session::flash('message', $response->getContent());
        return redirect("life-at-banglalink/events");
    }

    /**
     * Life at banglalink topbanner section list
     * @return [type] [description]
     */
    public function topbannerIndex() {

        $categoryTypes = 'life_at_bl_topbanner';

        $sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);

        return view('admin.ecarrer.topbanner.index', compact('sections'));
    }

    /**
     * eCarrer life at banglalink topbanner
     * @return [type] [description]
     */
    public function topbannerCreate() {

        return view('admin.ecarrer.topbanner.create');
    }

    /**
     * eCarrer life at banglalink topbanner store on create
     * @return [type] [description]
     */
    public function topbannerStore(Request $request) {

        $validator = Validator::make($request->all(), [
                    'title_en' => 'required'
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('life-at-banglalink/topbanner');
        }

        $data_types['category'] = 'life_at_bl_topbanner';
        $data_types['has_items'] = 0;
        # route slug
        $data_types['route_slug'] = $this->ecarrerService->getRouteSlug($request->path());

        # do not store now
        // $this->ecarrerService->storeEcarrerSection($request->all(), $data_types);

        Session::flash('message', 'Banner created successfully!');
        return redirect('life-at-banglalink/topbanner');
    }

    /**
     * eCarrer life at banglalink topbanner
     * @return [type] [description]
     */
    public function topbannerEdit($id) {

        $sections = $this->ecarrerService->generalSectionById($id);
        return view('admin.ecarrer.topbanner.edit', compact('sections'));
    }

    /**
     * Update general section
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function topbannerUpdate(EcareerPortalRequest $request, $id) {

        $response = $this->ecarrerService->updateMainSection($request->except(['slug']), $id);

        if ($response['success'] == 1) {
            Session::flash('message', 'Section updated successfully!');
        } else if($response['success'] == 2){
            Session::flash('error', "The banner name is not unique!");
        }else{
            Session::flash('error', $response['message']);
        }
        return redirect('life-at-banglalink/topbanner');
    }

    /**
     * [topbannerDestroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function topbannerDestroy($id) {

        $response = $this->ecarrerService->sectionDelete($id);
        Session::flash('message', $response->getContent());
        return redirect("life-at-banglalink/topbanner");
    }

    /**
     * Life at banglalink contact section list
     * @return [type] [description]
     */
    public function contactIndex() {

        $categoryTypes = 'life_at_bl_contact';

        $sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);

        return view('admin.ecarrer.contact.index', compact('sections'));
    }

    /**
     * eCarrer life at banglalink contact
     * @return [type] [description]
     */
    public function contactCreate() {

        return view('admin.ecarrer.contact.create');
    }

    /**
     * eCarrer life at banglalink contact store on create
     * @return [type] [description]
     */
    public function contactStore(Request $request) {

        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'slug' => 'required'
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('life-at-banglalink/contact');
        }

        $data_types['category'] = 'life_at_bl_contact';

        $category_type = $request->input('category_type', null);
        if (!empty($category_type) && $category_type == 'connect_us_social') {
            $data_types['has_items'] = 1;
        } else if (!empty($category_type) && $category_type == 'contact_us') {
            $data_types['has_items'] = 0;
        } else {
            $data_types['has_items'] = 0;
        }


        # route slug
        $data_types['route_slug'] = $this->ecarrerService->getRouteSlug($request->path());

        $this->ecarrerService->storeEcarrerSection($request->all(), $data_types);

        Session::flash('message', 'Section created successfully!');
        return redirect('life-at-banglalink/contact');
    }

    /**
     * eCarrer life at banglalink contact
     * @return [type] [description]
     */
    public function contactEdit($id) {

        $sections = $this->ecarrerService->generalSectionById($id);
        return view('admin.ecarrer.contact.edit', compact('sections'));
    }

    /**
     * Update general section
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function contactUpdate(Request $request, $id) {

        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();

        # Check Image upload validation
        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    // 'slug' => 'required',
                    'image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size // 2M
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('life-at-banglalink/contact');
        }

        $data_types = null;

        $category_type = $request->input('category_type', null);
        if (!empty($category_type) && $category_type == 'connect_us_social') {
            $data_types['has_items'] = 1;
        } else if (!empty($category_type) && $category_type == 'contact_us') {
            $data_types['has_items'] = 0;
        } else {
            $data_types['has_items'] = 0;
        }

        $this->ecarrerService->updateEcarrerSection($request->all(), $id, $data_types);

        Session::flash('message', 'Section updated successfully!');
        return redirect('life-at-banglalink/contact');
    }

    /**
     * [contactDestroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function contactDestroy($id) {

        $response = $this->ecarrerService->sectionDelete($id);
        Session::flash('message', $response->getContent());
        return redirect("life-at-banglalink/contact");
    }

    /**
     * Life at banglalink pioneer section list
     * @return [type] [description]
     */
    public function pioneerIndex() {

        $categoryTypes = 'vacancy_pioneer';

        $sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);

        return view('admin.ecarrer.pioneer.index', compact('sections'));
    }

    /**
     * eCarrer life at banglalink pioneer
     * @return [type] [description]
     */
    public function pioneerCreate() {

        return view('admin.ecarrer.pioneer.create');
    }

    /**
     * eCarrer life at banglalink pioneer store on create
     * @return [type] [description]
     */
    public function pioneerStore(Request $request) {

        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'slug' => 'required'
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('vacancy/pioneer');
        }

        $data_types['category'] = 'vacancy_pioneer';

        $data_types['has_items'] = 0;

        # route slug
        $data_types['route_slug'] = $this->ecarrerService->getRouteSlug($request->path());

        $this->ecarrerService->storeEcarrerSection($request->all(), $data_types);

        Session::flash('message', 'Section created successfully!');
        return redirect('vacancy/pioneer');
    }

    /**
     * eCarrer life at banglalink pioneer
     * @return [type] [description]
     */
    public function pioneerEdit($id) {

        $sections = $this->ecarrerService->generalSectionById($id);
        return view('admin.ecarrer.pioneer.edit', compact('sections'));
    }

    /**
     * Update general section
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function pioneerUpdate(Request $request, $id) {

        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();

        # Check Image upload validation
        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    // 'slug' => 'required',
                    'image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size // 2M
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('vacancy/pioneer');
        }

        $data_types = null;

        $this->ecarrerService->updateEcarrerSection($request->all(), $id, $data_types);

        Session::flash('message', 'Section updated successfully!');
        return redirect('vacancy/pioneer');
    }

    /**
     * [pioneerDestroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function pioneerDestroy($id) {

        $response = $this->ecarrerService->sectionDelete($id);
        Session::flash('message', $response->getContent());
        return redirect("vacancy/pioneer");
    }

    /**
     * Life at banglalink viconbox section list
     * @return [type] [description]
     */
    public function viconboxIndex() {

        $categoryTypes = 'vacancy_viconbox';

        $sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);

        return view('admin.ecarrer.viconbox.index', compact('sections'));
    }

    /**
     * eCarrer life at banglalink viconbox
     * @return [type] [description]
     */
    public function viconboxCreate() {

        return view('admin.ecarrer.viconbox.create');
    }

    /**
     * eCarrer life at banglalink viconbox store on create
     * @return [type] [description]
     */
    public function viconboxStore(Request $request) {

        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'slug' => 'required'
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('vacancy/viconbox');
        }

        $data_types['category'] = 'vacancy_viconbox';

        $data_types['has_items'] = 0;

        # route slug
        $data_types['route_slug'] = $this->ecarrerService->getRouteSlug($request->path());

        $this->ecarrerService->storeEcarrerSection($request->all(), $data_types);

        Session::flash('message', 'Item created successfully!');
        return redirect('vacancy/viconbox');
    }

    /**
     * eCarrer life at banglalink viconbox
     * @return [type] [description]
     */
    public function viconboxEdit($id) {

        $sections = $this->ecarrerService->generalSectionById($id);
        return view('admin.ecarrer.viconbox.edit', compact('sections'));
    }

    /**
     * Update general section
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function viconboxUpdate(Request $request, $id) {

        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();

        # Check Image upload validation
        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    // 'slug' => 'required',
                    'image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size // 2M
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('vacancy/viconbox');
        }

        $data_types = null;

        $this->ecarrerService->updateEcarrerSection($request->all(), $id, $data_types);

        Session::flash('message', 'Item updated successfully!');
        return redirect('vacancy/viconbox');
    }

    /**
     * [viconboxDestroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function viconboxDestroy($id) {

        $response = $this->ecarrerService->sectionDelete($id);
        Session::flash('message', $response->getContent());
        return redirect("vacancy/viconbox");
    }

    /**
     * programs progeneral section list
     * @return [type] [description]
     */
    public function progeneralIndex($sections_type) {
        $categoryTypes = 'programs_progeneral';

        $sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);
        return view('admin.ecarrer.progeneral.index', compact('sections', 'sections_type'));
    }

    /**
     * eCarrer programs progeneral
     * @return [type] [description]
     */
    public function progeneralCreate($sections_type) {
        $categoryTypes = 'programs_progeneral';
        $sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);
        return view('admin.ecarrer.progeneral.create', compact('sections_type'));
    }

    /**
     * eCarrer programs progeneral store on create
     * @return [type] [description]
     */
    public function progeneralStore(Request $request) {

        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'sections_type' => 'required',
                    'slug' => 'required'
        ]);

        $section_type = $request->input('sections_type');

        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect("programs/progeneral/$section_type");
        }

        $data_types['category'] = 'programs_progeneral';

        $data_types['has_items'] = 1;

        # route slug
        $data_types['route_slug'] = $this->ecarrerService->getRouteSlug($request->path(), $section_type);

        # Additional info
        $additional_info = null;
        if ($request->filled('programs_sections')) {
            $additional_info['additional_type'] = $request->input('programs_sections');
        }

        if (!empty($additional_info)) {
            $data_types['additional_info'] = json_encode($additional_info);
        }


        $this->ecarrerService->storeEcarrerSection($request->all(), $data_types);

        Session::flash('message', 'Section created successfully!');
        return redirect("programs/progeneral/$section_type");
    }

    /**
     * eCarrer programs progeneral
     * @return [type] [description]
     */
    public function progeneralEdit($id, $sections_type) {

        $sections = $this->ecarrerService->generalSectionById($id);
        return view('admin.ecarrer.progeneral.edit', compact('sections', 'sections_type'));
    }

    /**
     * Update general section
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function progeneralUpdate(Request $request, $id) {

        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();



        # Check Image upload validation
        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'sections_type' => 'required',
                    // 'slug' => 'required',
                    'image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size // 2M
        ]);

        $section_type = $request->input('sections_type');

        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect("programs/progeneral/$section_type");
        }


        $data_types = null;

        $additional_info = null;
        if ($request->filled('programs_sections')) {
            $additional_info['additional_type'] = $request->input('programs_sections');
        }

        if (!empty($additional_info)) {
            $data_types['additional_info'] = json_encode($additional_info);
        }

        $this->ecarrerService->updateEcarrerSection($request->all(), $id, $data_types);

        Session::flash('message', 'Section updated successfully!');
        return redirect("programs/progeneral/$section_type");
    }

    /**
     * [progeneralDestroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function progeneralDestroy($id) {

        $response = $this->ecarrerService->sectionDelete($id);
        Session::flash('message', $response->getContent());
        return redirect("programs/progeneral");
    }

    /**
     * programs proiconbox section list
     * @return [type] [description]
     */
    public function proiconboxIndex() {

        $categoryTypes = 'programs_proiconbox';

        $sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);

        return view('admin.ecarrer.proiconbox.index', compact('sections'));
    }

    /**
     * eCarrer programs proiconbox
     * @return [type] [description]
     */
    public function proiconboxCreate() {

        return view('admin.ecarrer.proiconbox.create');
    }

    /**
     * eCarrer programs proiconbox store on create
     * @return [type] [description]
     */
    public function proiconboxStore(Request $request) {

        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'slug' => 'required'
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('programs/proiconbox');
        }

        $data_types['category'] = 'programs_proiconbox';

        $data_types['has_items'] = 1;

        # route slug
        $data_types['route_slug'] = $this->ecarrerService->getRouteSlug($request->path());

        # Additional info
        $additional_info = null;
        if ($request->filled('programs_sections')) {
            $additional_info['additional_type'] = $request->input('programs_sections');
        }

        if (!empty($additional_info)) {
            $data_types['additional_info'] = json_encode($additional_info);
        }


        $this->ecarrerService->storeEcarrerSection($request->all(), $data_types);

        Session::flash('message', 'Section created successfully!');
        return redirect('programs/proiconbox');
    }

    /**
     * eCarrer programs proiconbox
     * @return [type] [description]
     */
    public function proiconboxEdit($id) {

        $sections = $this->ecarrerService->generalSectionById($id);
        return view('admin.ecarrer.proiconbox.edit', compact('sections'));
    }

    /**
     * Update general section
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function proiconboxUpdate(Request $request, $id) {

        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();

        # Check Image upload validation
        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    // 'slug' => 'required',
                    'image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size // 2M
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('programs/proiconbox');
        }

        $data_types = null;

        $additional_info = null;
        if ($request->filled('programs_sections')) {
            $additional_info['additional_type'] = $request->input('programs_sections');
        }

        if (!empty($additional_info)) {
            $data_types['additional_info'] = json_encode($additional_info);
        }

        $this->ecarrerService->updateEcarrerSection($request->all(), $id, $data_types);

        Session::flash('message', 'Section updated successfully!');
        return redirect('programs/proiconbox');
    }

    /**
     * [proiconboxDestroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function proiconboxDestroy($id) {

        $response = $this->ecarrerService->sectionDelete($id);
        Session::flash('message', $response->getContent());
        return redirect("programs/proiconbox");
    }

    /**
     * Programs photogallery section list
     * @return [type] [description]
     */
    public function photogalleryIndex() {

        $categoryTypes = 'programs_photogallery';

        $sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);

        return view('admin.ecarrer.photogallery.index', compact('sections'));
    }

    /**
     * eCarrer programs photogallery
     * @return [type] [description]
     */
    public function photogalleryCreate() {

        return view('admin.ecarrer.photogallery.create');
    }

    /**
     * eCarrer life at banglalink photogallery store on create
     * @return [type] [description]
     */
    public function photogalleryStore(Request $request) {

        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'slug' => 'required'
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('programs/photogallery');
        }

        $data_types['category'] = 'programs_photogallery';
        $data_types['has_items'] = 1;
        # route slug
        $data_types['route_slug'] = $this->ecarrerService->getRouteSlug($request->path());


        $additional_info = null;
        if ($request->filled('sider_info')) {
            $additional_info['sider_info'] = $request->input('sider_info');
        }

        if (!empty($additional_info)) {
            $data_types['additional_info'] = json_encode($additional_info);
        }

        $this->ecarrerService->storeEcarrerSection($request->all(), $data_types);

        Session::flash('message', 'Section created successfully!');
        return redirect('programs/photogallery');
    }

    /**
     * eCarrer life at banglalink photogallery
     * @return [type] [description]
     */
    public function photogalleryEdit($id) {

        $sections = $this->ecarrerService->generalSectionById($id);
        return view('admin.ecarrer.photogallery.edit', compact('sections'));
    }

    /**
     * Update general section
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function photogalleryUpdate(Request $request, $id) {

        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();

        # Check Image upload validation
        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'slug' => 'required',
                    'image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size // 2M
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('programs/photogallery');
        }

        $data_types = null;
        $additional_info = null;
        if ($request->filled('sider_info')) {
            $additional_info['sider_info'] = $request->input('sider_info');
        }

        if (!empty($additional_info)) {
            $data_types['additional_info'] = json_encode($additional_info);
        }

        $this->ecarrerService->updateEcarrerSection($request->all(), $id, $data_types);

        Session::flash('message', 'Section updated successfully!');
        return redirect('programs/photogallery');
    }

    /**
     * [photogalleryDestroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function photogalleryDestroy($id) {

        $response = $this->ecarrerService->sectionDelete($id);
        Session::flash('message', $response->getContent());
        return redirect("programs/photogallery");
    }

    /**
     * Programs sapbatches section list
     * @return [type] [description]
     */
    public function sapbatchesIndex() {

        $categoryTypes = 'programs_sapbatches';

        $sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);

        return view('admin.ecarrer.sapbatches.index', compact('sections'));
    }

    /**
     * eCarrer programs sapbatches
     * @return [type] [description]
     */
    public function sapbatchesCreate() {

        return view('admin.ecarrer.sapbatches.create');
    }

    /**
     * eCarrer life at banglalink sapbatches store on create
     * @return [type] [description]
     */
    public function sapbatchesStore(Request $request) {

        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'slug' => 'required'
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('programs/sapbatches');
        }

        $data_types['category'] = 'programs_sapbatches';

        if ($request->filled('category_type') && $request->input('category_type') == 'batch_title') {
            $data_types['has_items'] = 0;
        } else {
            $data_types['has_items'] = 1;
        }

        # route slug
        $data_types['route_slug'] = $this->ecarrerService->getRouteSlug($request->path());


        $additional_info = null;
        if ($request->filled('sider_info')) {
            $additional_info['sider_info'] = $request->input('sider_info');
        }

        if (!empty($additional_info)) {
            $data_types['additional_info'] = json_encode($additional_info);
        }

        $this->ecarrerService->storeEcarrerSection($request->all(), $data_types);

        Session::flash('message', 'Section created successfully!');
        return redirect('programs/sapbatches');
    }

    /**
     * eCarrer life at banglalink sapbatches
     * @return [type] [description]
     */
    public function sapbatchesEdit($id) {

        $sections = $this->ecarrerService->generalSectionById($id);
        return view('admin.ecarrer.sapbatches.edit', compact('sections'));
    }

    /**
     * Update general section
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function sapbatchesUpdate(Request $request, $id) {

        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();

        # Check Image upload validation
        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'slug' => 'required',
                    'image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size // 2M
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('programs/sapbatches');
        }

        $data_types = null;
        $additional_info = null;
        if ($request->filled('sider_info')) {
            $additional_info['sider_info'] = $request->input('sider_info');
        }

        if (!empty($additional_info)) {
            $data_types['additional_info'] = json_encode($additional_info);
        }


        if ($request->filled('category_type') && $request->input('category_type') == 'batch_title') {
            $data_types['has_items'] = 0;
        } else {
            $data_types['has_items'] = 1;
        }

        $this->ecarrerService->updateEcarrerSection($request->all(), $id, $data_types);

        Session::flash('message', 'Section updated successfully!');
        return redirect('programs/sapbatches');
    }

    /**
     * [sapbatchesDestroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function sapbatchesDestroy($id) {

        $response = $this->ecarrerService->sectionDelete($id);
        Session::flash('message', $response->getContent());
        return redirect("programs/sapbatches");
    }

    /**
     * Programs ennovatorbatches section list
     * @return [type] [description]
     */
    public function ennovatorbatchesIndex() {

        $categoryTypes = 'programs_ennovatorbatches';

        $sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);

        return view('admin.ecarrer.ennovatorbatches.index', compact('sections'));
    }

    /**
     * eCarrer programs ennovatorbatches
     * @return [type] [description]
     */
    public function ennovatorbatchesCreate() {

        return view('admin.ecarrer.ennovatorbatches.create');
    }

    /**
     * eCarrer life at banglalink ennovatorbatches store on create
     * @return [type] [description]
     */
    public function ennovatorbatchesStore(Request $request) {

        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'slug' => 'required'
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('programs/ennovatorbatches');
        }

        $data_types['category'] = 'programs_ennovatorbatches';

        if ($request->filled('category_type') && $request->input('category_type') == 'batch_title') {
            $data_types['has_items'] = 0;
        } else {
            $data_types['has_items'] = 1;
        }

        # route slug
        $data_types['route_slug'] = $this->ecarrerService->getRouteSlug($request->path());


        $additional_info = null;
        if ($request->filled('sider_info')) {
            $additional_info['sider_info'] = $request->input('sider_info');
        }

        if (!empty($additional_info)) {
            $data_types['additional_info'] = json_encode($additional_info);
        }

        $this->ecarrerService->storeEcarrerSection($request->all(), $data_types);

        Session::flash('message', 'Section created successfully!');
        return redirect('programs/ennovatorbatches');
    }

    /**
     * eCarrer life at banglalink ennovatorbatches
     * @return [type] [description]
     */
    public function ennovatorbatchesEdit($id) {

        $sections = $this->ecarrerService->generalSectionById($id);
        return view('admin.ecarrer.ennovatorbatches.edit', compact('sections'));
    }

    /**
     * Update general section
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function ennovatorbatchesUpdate(Request $request, $id) {

        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();

        # Check Image upload validation
        $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'slug' => 'required',
                    'image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size // 2M
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('programs/ennovatorbatches');
        }

        $data_types = null;
        $additional_info = null;
        if ($request->filled('sider_info')) {
            $additional_info['sider_info'] = $request->input('sider_info');
        }

        if (!empty($additional_info)) {
            $data_types['additional_info'] = json_encode($additional_info);
        }


        if ($request->filled('category_type') && $request->input('category_type') == 'batch_title') {
            $data_types['has_items'] = 0;
        } else {
            $data_types['has_items'] = 1;
        }

        $this->ecarrerService->updateEcarrerSection($request->all(), $id, $data_types);

        Session::flash('message', 'Section updated successfully!');
        return redirect('programs/ennovatorbatches');
    }

    /**
     * [ennovatorbatchesDestroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function ennovatorbatchesDestroy($id) {

        $response = $this->ecarrerService->sectionDelete($id);
        Session::flash('message', $response->getContent());
        return redirect("programs/ennovatorbatches");
    }

    /**
     * Life at banglalink topbanner section list
     * @return [type] [description]
     */
    public function tabTitleIndex() {

        $categoryTypes = 'programs_top_tab_title';

        $sections = $this->ecarrerService->ecarrerSectionsList($categoryTypes);

        return view('admin.ecarrer.tabtitle.index', compact('sections'));
    }

    /**
     * eCarrer life at banglalink topbanner
     * @return [type] [description]
     */
    // public function tabTitleCreate(){
    // 	return view('admin.ecarrer.topbanner.create');
    // }

    /**
     * eCarrer life at banglalink topbanner store on create
     * @return [type] [description]
     */
    // public function tabTitleStore(Request $request){
    // 	$validator = Validator::make($request->all(), [
    // 	    'title_en' => 'required'
    // 	]);
    // 	if ($validator->fails()) {
    // 	    Session::flash('error', $validator->messages()->first());
    // 	    return redirect('life-at-banglalink/topbanner');
    // 	}
    // 	$data_types['category'] = 'programs_top_tab_title';
    // 	$data_types['has_items'] = 0;
    // 	# route slug
    // 	$data_types['route_slug'] = $this->ecarrerService->getRouteSlug($request->path());
    // 	# do not store now
    // 	// $this->ecarrerService->storeEcarrerSection($request->all(), $data_types);
    // 	Session::flash('message', 'Banner created successfully!');
    // 	return redirect('life-at-banglalink/topbanner');
    // }

    /**
     * eCarrer life at banglalink topbanner
     * @return [type] [description]
     */
    public function tabTitleEdit($id) {

        $sections = $this->ecarrerService->generalSectionById($id);
        return view('admin.ecarrer.tabtitle.edit', compact('sections'));
    }

    /**
     * Update general section
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function tabTitleUpdate(EcareerPortalRequest $request, $id) {
        $this->ecarrerService->updateSubSection($request->except(['slug']), $id);

        Session::flash('message', 'Banner updated successfully!');
		return redirect('programs/tab-title');
    }

}

// Class end

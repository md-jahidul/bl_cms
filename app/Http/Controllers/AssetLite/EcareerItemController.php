<?php

namespace App\Http\Controllers\AssetLite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\EcareerService;
use App\Services\EcareerItemService;
use App\Http\Controllers\AssetLite\ConfigController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class EcareerItemController extends Controller
{

    /**
     * ecarrer service
     * @var [type]
     */
    private $ecarrerItemService;

    public function __construct(EcareerItemService $ecarrerItemService)
    {
        $this->ecarrerItemService = $ecarrerItemService;
        $this->middleware('auth');
    }


    /**
     * [index description]
     * @param  [type] $parent_id [description]
     * @return [type]            [description]
     */
    public function index($parent_id)
    {

        $all_items = $this->ecarrerItemService->getItems($parent_id);
        $route_slug = $this->ecarrerItemService->getParentRouteSlug($parent_id);

        $parent_categories = $this->ecarrerItemService->getParentCategories($parent_id);

        return view('admin.ecarrer-items.index', compact('parent_id', 'all_items', 'route_slug', 'parent_categories'));

    }

    /**
     * [generalCreate create general section]
     * @return [type] [description]
     */
    public function create($parent_id)
    {

        $ecarrer_section_slug = $this->ecarrerItemService->getEcarrerSectionSlugByID($parent_id);

        $parent_data = $this->ecarrerItemService->getEcarrerParentDataByID($parent_id);

        if (!empty($parent_data->additional_info)) {
            $check_type = json_decode($parent_data->additional_info);

            if (!empty($check_type->additional_type)) {
                $parent_data->check_type = $check_type->additional_type;
            }
        }

        $parent_categories = $this->ecarrerItemService->getParentCategories($parent_id);

        return view('admin.ecarrer-items.create', compact('parent_id', 'ecarrer_section_slug', 'parent_data', 'parent_categories'));
    }

    /**
     * Store general section on create
     * @return [type] [description]
     */
    public function store(Request $request, $parent_id)
    {

        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();

        # Check Image upload validation
        $validator = Validator::make($request->all(), [

            'image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size, // 2M
        'image_name' => 'nullable|unique:ecareer_portal_items,image_name', // 2M
		    'image_name_bn' => 'nullable|unique:ecareer_portal_items,image_name_bn' // 2M

		]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect("ecarrer-items/$parent_id/create")->withInput();
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
    public function edit($parent_id, $id)
    {

        # TODO: Validation check
        $ecarrer_item = $this->ecarrerItemService->getSingleItemByIds($parent_id, $id);

        $ecarrer_section_slug = $this->ecarrerItemService->getEcarrerSectionSlugByID($parent_id);

        $parent_data = $this->ecarrerItemService->getEcarrerParentDataByID($parent_id);

        if (!empty($parent_data->additional_info)) {
            $check_type = json_decode($parent_data->additional_info);

            if (!empty($check_type->additional_type)) {
                $parent_data->check_type = $check_type->additional_type;
            }
        }

        $parent_categories = $this->ecarrerItemService->getParentCategories($parent_id);

        return view('admin.ecarrer-items.edit', compact('ecarrer_item', 'parent_id', 'ecarrer_section_slug', 'parent_data', 'parent_categories'));

    }

    /**
     * Update general section
     * @param Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $parent_id, $id)
    {
        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();

        # Check Image upload validation
        $validator = Validator::make($request->all(), [
//		    'title_en' => 'required',
            'image_url' => 'nullable|mimes:' . $image_upload_type . '|max:' . $image_upload_size, // 2M
            'image_name' => 'nullable|unique:ecareer_portal_items,image_name,' . $id, // 2M
		    'image_name_bn' => 'nullable|unique:ecareer_portal_items,image_name_bn,' . $id // 2M
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect("ecarrer-items/$parent_id/$id/edit");
        }
        $this->ecarrerItemService->updateEcarrerItem($request->all(), $id);

        Session::flash('message', 'Item updated successfully!');
        return redirect("ecarrer-items/$parent_id/list");

    }

    /**
     * [destroy description]
     * @param  [type] $parent_id [description]
     * @param  [type] $id        [description]
     * @return [type]            [description]
     */
    public function destroy($parent_id, $id)
    {

        $response = $this->ecarrerItemService->deleteItem($id);
        Session::flash('message', $response->getContent());
        return redirect("ecarrer-items/$parent_id/list");

    }


    //delete item photo only
    public function deletePhoto($id)
    {
        $response = $this->ecarrerItemService->deleteItemPhoto($id);
        return $response;
    }

    /**
     * [ecarrerItemSortable description]
     * @param Request $request [description]
     * @return [type]           [description]
     */
    public function ecarrerItemSortable(Request $request)
    {

        $this->ecarrerItemService->tableSortable($request);

    }


}

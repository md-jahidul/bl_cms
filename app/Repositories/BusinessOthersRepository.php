<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessOthers;
use Illuminate\Support\Facades\Auth;

class BusinessOthersRepository extends BaseRepository {

    public $modelName = BusinessOthers::class;

    public function getOtherService($type, $serviceId) {
        $servces = $this->model->orderBy('sort');

        if ($serviceId > 0) {
            $servces->where('id', '!=', $serviceId);
            $servces->where('status', 1);
        }
        if ($type != "") {
            $servces->where('type', $type);
        }else{
            $servces->whereRaw("type NOT IN ('business-solution', 'iot', 'others')");
        }

        $data = $servces->get();

        return $data;
    }

    public function saveService($photoWeb, $photoMob, $bannerWeb, $bannerMob, $iconPath, $request,$cardData) {
        $service = $this->model;

        if ($iconPath != "") {
            $service->icon = $iconPath;
        }

        if ($photoWeb != "") {
            $service->banner_photo = $photoWeb;
        }
        if ($photoMob != "") {
            $service->banner_image_mobile = $photoMob;
        }

        if ($bannerWeb != "") {
            $service->details_banner_web = $bannerWeb;
        }
        if ($bannerMob != "") {
            $service->details_banner_mobile = $bannerMob;
        }
        if ($cardData['cardWeb'] != "") {
            $service->details_card_web = $cardData['cardWeb'];
        }
        if ($cardData['cardMob'] != "") {
            $service->details_card_mob = $cardData['cardMob'];
        }

        $service->details_banner_name = $request->details_banner_name;
        $service->details_banner_name_bn = $request->details_banner_name_bn;
        $service->details_alt_text = $request->details_alt_text;
        $service->details_alt_text_bn = $request->details_alt_text_bn;


        $service->alt_text = $request->alt_text;
        $service->alt_text_bn = $request->alt_text_bn;
        $service->banner_name = $request->banner_name;
        $service->banner_name_bn = $request->banner_name_bn;
        $service->url_slug = $request->url_slug;
        $service->url_slug_bn = $request->url_slug_bn;
        $service->schema_markup = $request->schema_markup;
        $service->page_header = $request->page_header;
        $service->page_header_bn = $request->page_header_bn;

        $service->name = $request->name_en;
        $service->name_bn = $request->name_bn;
        $service->home_short_details_en = $request->home_short_details_en;
        $service->home_short_details_bn = $request->home_short_details_bn;

        $service->short_details = $request->short_details_en;
        $service->short_details_bn = $request->short_details_bn;

        $service->offer_details_en = $request->offer_details_en;
        $service->offer_details_bn = $request->offer_details_bn;

        $service->type = $request->type;
        $service->created_by = Auth::id();
        $service->save();
        return $service->id;
    }

    public function changeHomeShowStatus($serviceId) {
        try {

            $package = $this->model->findOrFail($serviceId);

            $status = $package->home_show == 1 ? 0 : 1;
            $package->home_show = $status;
            $package->save();

            $response = [
                'success' => 1,
                'show_status' => $status,
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'errors' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    public function assignHomeSlider($serviceId) {
        try {

            $package = $this->model->findOrFail($serviceId);

            $status = $package->in_home_slider == 1 ? 0 : 1;
            $package->in_home_slider = $status;
            $package->save();

            $response = [
                'success' => 1,
                'show_status' => $status,
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'errors' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    public function changeStatus($serviceId) {
        try {

            $package = $this->model->findOrFail($serviceId);

            $status = $package->status == 1 ? 0 : 1;
            $package->status = $status;
            $package->save();

            $response = [
                'success' => 1,
                'status' => $status,
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'errors' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    public function changeServiceSorting($request) {
        try {

            $positions = $request->position;
            foreach ($positions as $position) {
                $packageId = $position[0];
                $new_position = $position[1];
                $update = $this->model->findOrFail($packageId);
                $update['sort'] = $new_position;
                $update->update();
            }

            $response = [
                'success' => 1,
                'message' => 'Success',
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    public function getServiceById($serviceId, $type) {
        if ($type == 'corona') {
            $service = $this->model->where('type', $serviceId)->first();
        } else {
            $service = $this->model->findOrFail($serviceId);
        }

        return $service;
    }

    public function updateService($photoWeb, $photoMob, $bannerWeb, $bannerMob, $iconPath, $request,$cardData) {
        $serviceId = $request->service_id;
        $service = $this->model->findOrFail($serviceId);



        $service->name = $request->name;
        if ($photoWeb != "") {
            $service->banner_photo = $photoWeb;
        }
        if ($photoMob != "") {
            $service->banner_image_mobile = $photoMob;
        }
        if ($iconPath != "") {
            $service->icon = $iconPath;
        }

        if ($bannerWeb != "") {
            $service->details_banner_web = $bannerWeb;
        }
        if ($bannerMob != "") {
            $service->details_banner_mobile = $bannerMob;
        }
        
        if ($cardData['cardWeb'] != "") {
            $service->details_card_web = $cardData['cardWeb'];
        }
        if ($cardData['cardMob'] != "") {
            $service->details_card_mob = $cardData['cardMob'];
        }

        $service->details_banner_name = $request->details_banner_name;
        $service->details_banner_name_bn = $request->details_banner_name_bn;
        $service->details_alt_text = $request->details_alt_text;
        $service->details_alt_text_bn = $request->details_alt_text_bn;

        $service->alt_text = $request->alt_text;
        $service->alt_text_bn = $request->alt_text_bn;
        $service->banner_name = $request->banner_name;
        $service->banner_name_bn = $request->banner_name_bn;
        $service->url_slug = $request->url_slug;
        $service->url_slug_bn = $request->url_slug_bn;
        $service->schema_markup = $request->schema_markup;
        $service->page_header = $request->page_header;
        $service->page_header_bn = $request->page_header_bn;

        $service->name = $request->name_en;
        $service->name_bn = $request->name_bn;

        $service->home_short_details_en = $request->home_short_details_en;
        $service->home_short_details_bn = $request->home_short_details_bn;

        $service->short_details = $request->short_details_en;
        $service->short_details_bn = $request->short_details_bn;

        $service->offer_details_en = $request->offer_details_en;
        $service->offer_details_bn = $request->offer_details_bn;

        $service->type = $request->type;
        $service->updated_by = Auth::id();
        return $service->save();
    }

    public function getEnterEnterpriseSol($id = null)
    {
        $data = $this->model->where('type', 'business-solution')
            ->select('id', 'name');
        if ($id) {
            $data->where('id', $id);
            return $data->first();
        }
        return $data->get();
    }

}

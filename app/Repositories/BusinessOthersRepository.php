<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessOthers;

class BusinessOthersRepository extends BaseRepository {

    public $modelName = BusinessOthers::class;
    
     public function getOtherService($type, $serviceId) {
        $servces = $this->model->orderBy('sort');
        
        if($serviceId > 0){
            $servces->where('id', '!=', $serviceId);
            $servces->where('status', 1);
        }
        if($type != ""){
            $servces->where('type', $type);
        }
        
        $data = $servces->get();
        
        return $data;
    }

    public function saveService($bannerPath, $iconPath, $request) {
        $service = $this->model;

        if ($bannerPath != "") {
            $service->banner_photo = $bannerPath;
        }
        if ($iconPath != "") {
            $service->icon = $iconPath;
        }

        $service->alt_text = $request->alt_text;
        
        $service->name = $request->name_en;
        $service->name_bn = $request->name_bn;
        $service->home_short_details_en = $request->home_short_details_en;
        $service->home_short_details_bn = $request->home_short_details_bn;
        
        $service->short_details = $request->short_details_en;
        $service->short_details_bn = $request->short_details_bn;
        
        $service->offer_details_en = $request->offer_details_en;
        $service->offer_details_bn = $request->offer_details_bn;
        
        $service->type = $request->type;
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

    public function getServiceById($serviceId) {
        $service = $this->model->findOrFail($serviceId);
        return $service;
    }

    public function updateService($bannerPath, $iconPath, $request) {
        $serviceId = $request->service_id;
        $service = $this->model->findOrFail($serviceId);

        
        
        $service->name = $request->name;
        if ($bannerPath != "") {
            $service->banner_photo = $bannerPath;
        }
        if ($iconPath != "") {
            $service->icon = $iconPath;
        }
          $service->alt_text = $request->alt_text;
        
        $service->name = $request->name_en;
        $service->name_bn = $request->name_bn;
        
        $service->home_short_details_en = $request->home_short_details_en;
        $service->home_short_details_bn = $request->home_short_details_bn;
        
        $service->short_details = $request->short_details_en;
        $service->short_details_bn = $request->short_details_bn;
        
        $service->offer_details_en = $request->offer_details_en;
        $service->offer_details_bn = $request->offer_details_bn;
        
        $service->type = $request->type;
        return $service->save();
    }

}

<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessPackages;

class BusinessPackageRepository extends BaseRepository {

    public $modelName = BusinessPackages::class;

    public function getPackageList($packageId = 0) {

        $packages = $this->model->orderBy('sort');

        if ($packageId > 0) {
            $packages->where('id', '!=', $packageId);
        }

        $data = $packages->get();

        return $data;
    }

    public function changePackageSorting($request) {
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

    public function changeHomeShowStatus($packageId) {
        try {

            $package = $this->model->findOrFail($packageId);

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

    public function changeStatus($packageId) {
        try {

            $package = $this->model->findOrFail($packageId);

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

    public function savePackage($filePath, $request) {
        $package = $this->model;

        if ($filePath != "") {
            $package->banner_photo = $filePath;
        }
        $package->alt_text = $request->alt_text;


        $package->name = $request->name_en;
        $package->name_bn = $request->name_bn;

        $package->short_details = $request->short_details_en;
        $package->short_details_bn = $request->short_details_bn;

        $package->main_details = $request->package_details_en;
        $package->main_details_bn = $request->package_details_bn;

        $package->offer_details = $request->offer_details_en;
        $package->offer_details_bn = $request->offer_details_bn;

        $package->save();
        return $package->id;
    }

    public function getPackageById($packageId) {
        $packages = $this->model->findOrFail($packageId);
        return $packages;
    }

    public function updatePackage($filePath, $request) {
        $packageId = $request->package_id;
        $package = $this->model->findOrFail($packageId);

        if ($filePath != "") {
            $package->banner_photo = $filePath;
        }
        $package->alt_text = $request->alt_text;

        $package->name = $request->name_en;
        $package->name_bn = $request->name_bn;

        $package->short_details = $request->short_details_en;
        $package->short_details_bn = $request->short_details_bn;

        $package->main_details = $request->package_details_en;
        $package->main_details_bn = $request->package_details_bn;

        $package->offer_details = $request->offer_details_en;
        $package->offer_details_bn = $request->offer_details_bn;

        return $package->save();
    }

}

<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessPackages;
use Illuminate\Support\Facades\Auth;

class BusinessPackageRepository extends BaseRepository
{

    public $modelName = BusinessPackages::class;

    public function getPackageList($packageId = 0)
    {

        $packages = $this->model->orderBy('sort');

        if ($packageId > 0) {
            $packages->where('id', '!=', $packageId);
        }

        $data = $packages->get();

        return $data;
    }

    public function changePackageSorting($request)
    {
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

    public function changeHomeShowStatus($packageId)
    {
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

    public function changeStatus($packageId)
    {
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

    public function savePackage($cardWeb, $cardMob, $bannerWeb, $bannerMob, $request)
    {
        $package = $this->model;


        $package->card_banner_web = $cardWeb;
        $package->card_banner_mobile = $cardMob;
        $package->card_banner_alt_text = $request->card_banner_alt_text;

        $package->banner_photo = $bannerWeb;
        $package->banner_image_mobile = $bannerMob;
        $package->alt_text = $request->alt_text;

        $package->banner_title_en = $request->banner_title_en;
        $package->banner_title_bn = $request->banner_title_bn;
        $package->banner_desc_en = $request->banner_desc_en;
        $package->banner_desc_bn = $request->banner_desc_bn;

        $package->banner_name = $request->banner_name;
        $package->url_slug = $request->url_slug;
        $package->url_slug_bn = $request->url_slug_bn;
        $package->schema_markup = $request->schema_markup;
        $package->page_header = $request->page_header;
        $package->page_header_bn = $request->page_header_bn;

        $package->name = $request->name_en;
        $package->name_bn = $request->name_bn;

        $package->short_details = $request->short_details_en;
        $package->short_details_bn = $request->short_details_bn;

        $package->main_details = $request->package_details_en;
        $package->main_details_bn = $request->package_details_bn;

        $package->offer_details = $request->offer_details_en;
        $package->offer_details_bn = $request->offer_details_bn;

        $package->created_by = Auth::id();

        $package->save();
        return $package->id;
    }

    public function getPackageById($packageId)
    {
        return $this->model->findOrFail($packageId);
    }

    public function updatePackage($cardWeb, $cardMob, $bannerWeb, $bannerMob, $request)
    {
        $packageId = $request->package_id;
        $package = $this->model->findOrFail($packageId);

        if ($cardWeb != "") {
            $package->card_banner_web = $cardWeb;
        }
        if ($cardMob != "") {
            $package->card_banner_mobile = $cardMob;
        }
        $package->card_banner_alt_text = $request->card_banner_alt_text;

        if ($bannerWeb != "") {
            $package->banner_photo = $bannerWeb;
        }
        if ($bannerMob != "") {
            $package->banner_image_mobile = $bannerMob;
        }
        $package->alt_text = $request->alt_text;
        $package->banner_name = $request->banner_name;

        $package->banner_title_en = $request->banner_title_en;
        $package->banner_title_bn = $request->banner_title_bn;
        $package->banner_desc_en = $request->banner_desc_en;
        $package->banner_desc_bn = $request->banner_desc_bn;

        $package->url_slug = $request->url_slug;
        $package->url_slug_bn = $request->url_slug_bn;
        $package->schema_markup = $request->schema_markup;
        $package->page_header = $request->page_header;
        $package->page_header_bn = $request->page_header_bn;

        $package->name = $request->name_en;
        $package->name_bn = $request->name_bn;

        $package->short_details = $request->short_details_en;
        $package->short_details_bn = $request->short_details_bn;

        $package->main_details = $request->package_details_en;
        $package->main_details_bn = $request->package_details_bn;

        $package->offer_details = $request->offer_details_en;
        $package->offer_details_bn = $request->offer_details_bn;
        $package->updated_by = Auth::id();
        return $package->save();
    }

    public function getBusinessPack($packageId = null)
    {
        $data = $this->model
            ->select('id', 'name');
        if ($packageId) {
            $data->where('id', $packageId);
            return $data->first();
        }
        return $data->get();
    }

}

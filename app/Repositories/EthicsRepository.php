<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 22/06/2020
 */

namespace App\Repositories;

use App\Models\EthicsPageInfo;

class EthicsRepository extends BaseRepository {

    public $modelName = EthicsPageInfo::class;

    public function getPageInfo() {
        $pageInfo = $this->model->first();
        return $pageInfo;
    }


    public function updatePageInfo($webPath, $mobilePath, $request) {
            $page = $this->model->findOrFail($request->page_id);
            $page->page_name_en = $request->page_name_en;
            $page->page_name_bn = $request->page_name_bn;
            $page->banner_desc_en = $request->banner_desc_en;
            $page->banner_desc_bn = $request->banner_desc_bn;
            $page->banner_web = $webPath;
            $page->banner_mobile = $mobilePath;
            $page->banner_name = $request->banner_name;
            $page->banner_name_bn = $request->banner_name_bn;
            $page->alt_text = $request->alt_text;
            $page->alt_text_bn = $request->alt_text_bn;
            $page->page_header = $request->page_header;
            $page->page_header_bn = $request->page_header_bn;
            $page->schema_markup = $request->schema_markup;
            $page->save();
            return $page;
    }





}

<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\FreeProductDisburseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MyBlFreeProductDisburseController extends Controller
{
    public $freeProductDisburseService;
    public function __construct(FreeProductDisburseService $freeProductDisburseService)
    {
        $this->freeProductDisburseService = $freeProductDisburseService;
    }

    public function freeProductDisburseUploadPanel()
    {
        return view('admin.free-product-disburse');
    }

    public function uploadFreeProductDisburseExcel(Request $request)
    {
        try {
            $file = $request->file('free_product_disburse_file');

            $path = $file->storeAs(
                'free_product_disburse/' . strtotime(now() . '/'),
                "free_product_disburse" . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            $path = Storage::disk('public')->path($path);

            $this->freeProductDisburseService->saveMsisdns($path);

            $response = [
                'success' => 'SUCCESS'
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 'FAILED',
                'errors' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }
}

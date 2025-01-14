<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\ProductCoreService;
use App\Services\StoreLocatorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreLocatorEntryController extends Controller
{
    /**
     * @var ProductCoreService
     */
    protected $service;

    public function __construct(StoreLocatorService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function index()
    {
        return view('store_locator_entry');
    }

    public function uploadStoresByExcel(Request $request)
    {
        try {
            $file = $request->file('store_file');
            $path = $file->storeAs(
                'stores/' . strtotime(now() . '/'),
                "stores" . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            $path = Storage::disk('public')->path($path);

            $this->service->mapDataFromExcel($path);

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

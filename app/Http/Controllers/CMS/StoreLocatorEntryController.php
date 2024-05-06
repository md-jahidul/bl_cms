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
    /**
     * @var StoreLocatorService
     */
    private $storeLocatorService;

    public function __construct(StoreLocatorService $storeLocatorService)
    {
        $this->middleware('auth');
        $this->storeLocatorService = $storeLocatorService;
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

            $this->storeLocatorService->mapDataFromExcel($path);

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

    public function deleteAllLocators()
    {
        return $this->storeLocatorService->deleteAllData();
    }
}

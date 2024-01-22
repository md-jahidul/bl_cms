<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

use App\Services\MyBlServiceComponentService;
use App\Repositories\MyBlServiceRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class MyBlServiceController extends Controller
{
    use CrudTrait;

    /**
     * @var MyBlServiceRepository
     */
    private $blService;

    public function __construct(
        MyBlServiceComponentService $blService
    )
    {
        $this->blService = $blService;

    }

    public function index()
    {
        $services = $this->blService->getServices();
        return view('admin.my-bl-services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.my-bl-services.create');
    }

    public function store(Request $request)
    {
        $flag = $this->blService->store($request->all());
        if ($flag) {
            Session::flash('success', 'Slider Created Successfully');
        } else {
            Session::flash('error', 'Slider Created Failed');
        }

        return redirect('my-bl-services');
    }


    public function edit($service_id)
    {

        $service = $this->blService->findOne($service_id);

        $android_version_code = implode('-', [$service['android_version_code_min'], $service['android_version_code_max']]);
        $ios_version_code = implode('-', [$service['ios_version_code_min'], $service['ios_version_code_max']]);
        $service->android_version_code = $android_version_code;
        $service->ios_version_code = $ios_version_code;
        return view('admin.my-bl-services.edit', compact('service'));
    }


    public function update(Request $request, $service_id)
    {
        $success = $this->blService->updateService($request->all(), $service_id);
        if ($success) {
            Session::flash('success', 'Slider Updtaed Successfully');
        } else {
            Session::flash('error', 'Slider Updated Failed');
        }

        return redirect('my-bl-services');
    }

    public function tableSortable($data)
    {
        $this->blService->servicesTableSort($data);
        return new Response('Sequence has been successfully update');
    }

    public function updatePosition(Request $request)
    {
        $positions = $request->all();
        foreach ($positions['position'] as $position) {
            $service = $this->blService->findOrFail($position[0]);
            $service->update(['sequence' => $position[1]]);
        }
        return "success";
    }


    public function destroy($id)
    {
        $this->blService->deleteService($id);
        return redirect('my-bl-services')->with('success', 'Service deleted successfully.');
    }

}

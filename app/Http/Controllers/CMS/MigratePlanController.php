<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\MigratePlanService;
use Illuminate\Http\Request;

class MigratePlanController extends Controller
{
    /**
     * @var MigratePlanService
     */
    protected $migratePlanService;


    /**
     * MigratePlanController constructor.
     * @param MigratePlanService $migratePlanService
     */
    public function __construct(MigratePlanService $migratePlanService) {
        $this->migratePlanService = $migratePlanService;
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = $this->migratePlanService->findAll();
        return view('admin.migrate-plan.index')
            ->with('plans', $plans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans = $this->migratePlanService->findAll();

        return view('admin.migrate-plan.create')
            ->with('plans', $plans);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plan = $this->migratePlanService->storeMigratePlan($request->all());
        $content = $plan->getContent();
        session()->flash('message', $content);
        return redirect(route('migrate-plan.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = $this->migratePlanService->findOne($id);

        return view('admin.migrate-plan.index')
            ->with('plan', $plan);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = $this->migratePlanService->findOne($id);
        return view('admin.migrate-plan.create')
            ->with('plan', $plan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NotificationRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $plan = $this->migratePlanService->updateMigratePlan($request->all(), $id);
        $content = $plan->getContent();
        session()->flash('success', $content);
        return redirect(route('migrate-plan.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     * @throws \Exception
     */
    public function destroy($id)
    {
        $plan =$this->migratePlanService->deleteMigratePlan($id);
        session()->flash('error', $plan->getContent());
        return url('migrate-plan');
    }

    /**
     * @param Request $request
     */
   /* public function myblStoreSortable(Request $request)
    {
        $this->migratePlanService->tableSortable($request);
    }*/

}

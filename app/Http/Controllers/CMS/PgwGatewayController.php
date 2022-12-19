<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PgwGatewayService;
use DB;

class PgwGatewayController extends Controller
{
    //
     /**
     * @var pgwGatewayService
     */
    private $pgwGatewayService;


    /**
     * PgwGatewayController constructor.
     * @param pgwGatewayService $pgwGatewayService
     */
    public function __construct(PgwGatewayService $pgwGatewayService)
    {
        $this->pgwGatewayService = $pgwGatewayService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pgwGateways = $this->pgwGatewayService->findAll(); 
        return view('admin.pgw-gateway.index',compact('pgwGateways'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session()->flash('message', $this->pgwGatewayService->storePgwGateway($request->all())->getContent());
        return redirect(route('pgw-gateway.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            return view('admin.pgw-gateway.index')
                ->with('pgwGateways', $this->pgwGatewayService->findAll())
                ->with('pgwGateways_info', $this->pgwGatewayService->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        session()->flash('success', $this->pgwGatewayService->updatePgwGateway($request->all(), $id)->getContent());
        return redirect(route('pgw-gateway.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->flash('error', $this->pgwGatewayService->destroyPgwGateway($id)->getContent());
        return url('pgw-gateway');
    }
}

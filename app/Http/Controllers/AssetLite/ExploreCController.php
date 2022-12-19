<?php

namespace App\Http\Controllers\AssetLite;

use App\Enums\ExplorCStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExploreCRequest;
use App\Services\ExploreCService;

class ExploreCController extends Controller
{
    protected $exploreCService;

    public function __construct( ExploreCService $exploreCService)
    {
        $this->exploreCService = $exploreCService;
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exploreCs = $this->exploreCService->exploreCList();

        return view('admin.explore-c.index', compact('exploreCs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.explore-c.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExploreCRequest $request)
    {
        // // $data = [];
        // if ($request->file('img')) {
        //     $file = $request->img;
        //     $path = $file->storeAs(
        //         'explore_c/images',
        //         'explore_c_' . strtotime(now()) . '.' . $file->getClientOriginalExtension(),
        //         'public'
        //     );

        //     $img = $path;
        // }
        // $data = $request->all();
        // $data['img'] = $img;
        session()->flash('message', $this->exploreCService->store($request->all())->getContent());
        return redirect(route('explore-c.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $exploreC = $this->exploreCService->findOne($id);

        return view('admin.explore-c.edit', compact('exploreC'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExploreCRequest $request, $id)
    {
        session()->flash('message', $this->exploreCService->updateExploreC($request->all(), $id)->getContent());
        return redirect(route('explore-c.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->flash('message', $this->exploreCService->destroy($id)->getContent());
        return redirect(route('test-teams.index'));
        
    }

}

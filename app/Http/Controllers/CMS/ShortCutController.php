<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Models\ShortCut;
use App\Http\Controllers\Controller;

class ShortCutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.short_cuts.index')->with('short_cuts',ShortCut::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.short_cuts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tittle' => 'required|unique:shortcuts|max:10',
            'icon' => 'required|image|mimes:jpeg,jpg,png'
        ]);

        $request = $request->all();
        //dd($request);
        $request['icon'] = 'storage/'.$request['icon']->store('short_cuts_icon'); 
        $request['component_identifier'] = strtolower(str_replace(" ","_",$request['tittle']));
       
        ShortCut::create($request);
        session()->flash('status',"short cut has successfully been created");
        return redirect(route('short_cuts.index'));
        
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
        return view('admin.short_cuts.index')
                    ->with('short_cuts',ShortCut::all())
                    ->with('short_cut_info',ShortCut::FindorFail($id));
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
        $request->validate([
            'tittle' => 'required|unique:shortcuts|max:30'
        ]);
        $short_cut = ShortCut::FindorFail($id);
        $request = $request->all();
        if(isset($request['icon'])){
            unlink($short_cut->icon);
            $request['icon'] = 'storage/'.$request['icon']->store('short_cuts_icon');
        }else{
            $request['icon'] = $short_cut->icon;
        }
        $request['component_identifier'] = strtolower(str_replace(" ","_",$request['tittle']));
        $short_cut->update($request);
        session()->flash('status',"short cut has successfully been updated");
        return redirect(route('short_cuts.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shortcut = ShortCut::FindorFail($id);
        // return $shortcut;
        unlink($shortcut['icon']);
        $shortcut->delete();
        session()->flash('danger',"short cut has successfully been deleted");
        return redirect(route('short_cuts.index'));
    }
}

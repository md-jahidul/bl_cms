<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShortCut;
use App\Models\ShortcutUser;
use App\Models\Users;
use DB;

class UserShortcutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(auth()->user()->shortcuts);
        $data = DB::table('shortcut_user')
                    ->join('users', 'users.id', '=', 'shortcut_user.user_id')
                    ->join('shortcuts', 'shortcuts.id', '=', 'shortcut_user.shortcut_id')
                    ->select('shortcut_user.serial', 'shortcuts.tittle', 'shortcuts.id')
                    ->where('users.id', '=', auth()->user()->id)
                    ->orderBy('shortcut_user.serial', 'asc')
                    ->get();
        $list_of_shortcuts = [];
        foreach ($data->all() as $single_data) {
            $list_of_shortcuts[] = $single_data->tittle;
        }
        //dd(ShortCut::all());
        
        return view('admin.short_cuts.add_shortcut')
                ->with('short_cuts', ShortCut::all())
                ->with('added_short_cuts', $data)
                ->with('list_of_shortcuts', $list_of_shortcuts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        if (isset($request->all()['shortcut'])) {
            $request->validate([
                'shortcut' => 'max:5',
            ]);
        }
       
        
        if (!empty(DB::table('shortcut_user')->where('user_id', auth()->user()->id)->get()->all())) {
            DB::table('shortcut_user')->where('user_id', auth()->user()->id)->delete();
        }
         
         //dd($request->all()['shortcut']);
        if (isset($request->all()['shortcut'])) {
            $request = $request->all();
            foreach ($request['shortcut'] as $key => $short_cut) {
                ShortcutUser::create([
                    'user_id' => auth()->user()->id,
                    'shortcut_id' => $short_cut,
                    'serial' => $key + 1
                    ]);
                     //dd($request);
            }
                
            session()->flash('status', "short cuts has successfully been added");
        } else {
            session()->flash('danger', "All short cuts has successfully been removed");
        }
        return redirect(route('UserShortcut.index'));
    }
    public function serialUpdate(Request $request, $id)
    {
        
        $request = $request->all();
        unset($request['_token']);
        unset($request['_method']);
        if (count(array_unique($request)) != count($request)) {
            session()->flash('danger', "You cannot have priority twice");
            return redirect(route('UserShortcut.index'));
        }
        if (in_array('0', $request)) {
            session()->flash('danger', "You cannot have 0 as priority");
            return redirect(route('UserShortcut.index'));
        }
        
        foreach ($request as $key => $serial) {
            DB::table('shortcut_user')->where('shortcut_id', $key)->update(['serial' => $serial]);
        }
        session()->flash('status', "serial has successfully updated");
        return redirect(route('UserShortcut.index'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\CMS;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::with('children')->where('parent_id', 0)->orderBy('display_order', 'ASC')->get();
        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      

        // dd(request()->all());


        try {
            $menu_count = (new Menu())->get()->count();
            Menu::create([
                'parent_id' => 0,
                'name' => $request->name,
                'en_label_text' => request()->en_label_text,
                'bn_label_text' => $request->bn_label_text,
                'url' => $request->url,
                'code' => str_replace( " ", "", ucwords( strtolower($request->name) ) ),
                "external_site" => $request->external_site,
                'status' => $request->status,
                'display_order' => ($menu_count == 0) ? 1 : ++$menu_count
            ]);
            return redirect('menu');
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage());
        }
    }

    public function parentMenuSortable(Request $request){

        $positions = $request->position;
        foreach ($positions as $position){
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = Menu::findOrFail($menu_id);
            $update_menu['display_order'] = $new_position;
            $update_menu->save();
        }
        return "success";
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
     * Create the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function childList($id)
    {
        $parent_id = $id;
        $child_menus = Menu::with('parent')->where('parent_id', $id)->get();
        return view('admin.menu.child-menu.child-list', compact('child_menus', 'parent_id'));
    }

    public function childForm($parent_id)
    {
        return view('admin.menu.child-menu.create', compact('parent_id'));
    }

    public function childStore(Request $request)
    {
        try {
            $parent_id = $request->parent_id;
            Menu::create([
                'parent_id' => $parent_id,
                'name' => $request->name,
                'url' => $request->url,
                'status' => $request->status,
                'display_order' => 1,
            ]);
            return redirect(url("menu/$parent_id/child_menu"));
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage());
        }
    }

    public function childEdit($id){
        try {
            $child_edit = Menu::findORFail($id);
            return view('admin.menu.child-menu.edit', compact('child_edit'));
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage());
        }
    }

    public function childUpdate(Request $request, $id){
        try {
            $child_edit = Menu::findORFail($id);
            $parent_id = $child_edit->parent_id;
            $child_edit->update($request->all());
            return redirect(url("menu/$parent_id/child_menu"));
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage());
        }
    }

    public function childSubList($id){
        $parent_id = $id;
        $child_sub_lists = Menu::with('parent')->where('parent_id', $id)->get();
        return view('admin.menu.child-sub-menu.child-sub-list', compact('child_sub_lists', 'parent_id'));
    }

    public function childSubForm($parent_id)
    {
        return view('admin.menu.child-menu.create', compact('parent_id'));
    }




    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            return view('admin.menu.edit', compact('menu'));
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage());
        }
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
        try {
            $menu = Menu::findOrFail($id);
            $menu->update($request->all());
            return redirect('menu');
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $menu->delete();
            return redirect('menu');
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage());
        }
    }
}

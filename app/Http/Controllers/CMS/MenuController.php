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
        try {
//            $menus = Menu::where('parent_id', 0)->get();

            $menus = Menu::with('children')->where('parent_id', 0)->get();

            return view('admin.menu.index', compact('menus'));
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage());
        }
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

        try {
            $menu_count = (new Menu())->get()->count();
            Menu::create([
                'parent_id' => 0,
                'name' => $request->name,
                'url' => $request->url,
                'status' => $request->status,
                'display_order' => ($menu_count == 0) ? 1 : ++$menu_count
            ]);
            return redirect('menu');
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage());
        }
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

//        return $child_menus;

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

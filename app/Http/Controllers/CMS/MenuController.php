<?php

namespace App\Http\Controllers\CMS;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{

    protected $menuItems = [];
    private function getInfo($id){
        return (new Menu)->find($id, ['id','name','parent_id']);
    }


    public function getBradcamInfo($parent_id)
    {
        $temp = (new Menu)->find($parent_id, ['id','name','parent_id']);
        $this->menuItems[] = $temp;
        return $temp['parent_id'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($parent_id = 0)
    {
        $menus = Menu::where('parent_id', $parent_id)->orderBy('display_order', 'ASC')->get();
        $menu_id = $parent_id;


        while ( $menu_id != 0 ){
            $menu_id = $this->getBradcamInfo($menu_id);
        }

        $liHtml = '';
        for($i = count($this->menuItems) - 1; $i >= 0; $i--){
            $liHtml .= '<li class="breadcrumb-item active">' .  $this->menuItems[$i]['name']  . '</li><br/>';
        }

        return view('admin.menu.index', compact('menus','parent_id','liHtml'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($parent_id = 0)
    {
        return view('admin.menu.create', compact('parent_id'));
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

            $menu_count = (new Menu())->where('parent_id', $request->parent_id )->get()->count();
            Menu::create([
                'parent_id' => request()->parent_id,
                'name' => $request->name,
                'en_label_text' => request()->en_label_text,
                'bn_label_text' => $request->bn_label_text,
                'url' => $request->url,
                'code' => str_replace( " ", "", ucwords( strtolower($request->name) ) ),
                "external_site" => $request->external_site,
                'status' => $request->status,
                'display_order' => ($menu_count == 0) ? 1 : ++$menu_count
            ]);

            Session::flash('message', 'Menu saved successfully');
            return request()->parent_id == 0 ? redirect('menu') : redirect(url("menu/$request->parent_id/child-menu"));
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
            Session::flash('message', 'Menu updated successfully');
            return $menu->parent_id == 0 ? redirect('menu') : redirect(url("menu/$request->parent_id/child-menu"));
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
            Session::flash('message', 'Menu delete successfully');
            return $menu->parent_id == 0 ? url('menu') : url("menu/$menu->parent_id/child-menu");
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage());
        }
    }
}

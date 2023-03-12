<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\AlSliderService;
use App\Services\GenericShortcutMasterService;
use Illuminate\Http\Request;

class GenericShortcutMasterController extends Controller
{
    /**
     * @var GenericShortcutMasterService
     */
    public $genericShortcutMasterService;

    public function __construct(
        GenericShortcutMasterService $genericShortcutMasterService
    ) {
        $this->genericShortcutMasterService = $genericShortcutMasterService;
    }

    public function index()
    {
        $shortcuts = $this->genericShortcutMasterService->findAll();
        return view('admin.generic-shortcut.master.index', compact('shortcuts'));
    }

    public function create()
    {
        return view('admin.generic-shortcut.master.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'title_en' => 'required|max:200',
            'title_bn' => 'required|max:200',
            'component_for' => 'required'
        ]);

        $this->genericShortcutMasterService->save($request->all());
        return redirect()->route('generic-shortcut-master.index')->with('success', "Generic Shortcut Meta Data Saved Successfully");
    }

    public function edit($id)
    {
        $shortcut = $this->genericShortcutMasterService->findOne($id);
        return view('admin.generic-shortcut.master.create', compact('shortcut'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_en' => 'required|max:200',
            'title_bn' => 'required|max:200',
            'component_for' => 'required'
        ]);

        $this->genericShortcutMasterService->findOne($id)->update($request->all());
        return redirect()->route('generic-shortcut-master.index')->with('success', "Generic Shortcut Meta Data Updated Successfully");
    }

    public function destroy($id)
    {
        $this->genericShortcutMasterService->findOne($id)->delete();
        return url('generic-shortcut-master');
    }
}

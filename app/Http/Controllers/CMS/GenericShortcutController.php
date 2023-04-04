<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Services\GenericShortcutMasterService;
use App\Services\GenericShortcutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GenericShortcutController extends Controller
{
    protected $genericShortcutService;

    protected $genericShortcutMasterService;

    public function __construct(
        GenericShortcutService $genericShortcutService,
        GenericShortcutMasterService $genericShortcutMasterService
    ) {
        $this->genericShortcutService = $genericShortcutService;
        $this->genericShortcutMasterService = $genericShortcutMasterService;
    }

    public function index($id)
    {
        $shortcut = $this->genericShortcutMasterService->findOne($id);
        $actionList = Helper::navigationActionList();
        return view('admin.generic-shortcut.shortcuts.index', compact('shortcut', 'actionList'));
    }

    public function create($masterShortcutID)
    {
        return view('admin.generic-shortcut.shortcuts.create', compact('masterShortcutID'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
           'title_en' => 'required|max:200',
           'title_bn' =>  'required|max:200',
           'customer_type' => 'required',
           'component_identifier' => 'required',
           'icon' => 'required'
        ]);

        $this->genericShortcutService->saveGenericShortcut($request->all());
        return redirect()->route('generic-shortcut', $request->generic_shortcut_master_id)->with('success', "Generic Shortcut Saved Successfully");
    }

    public function edit($id)
    {
        $shortcut = $this->genericShortcutService->findOne($id);

        return view('admin.generic-shortcut.shortcuts.create', compact('shortcut'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'title_en' => 'required|max:50',
            'title_bn' =>  'required|max:50',
            'customer_type' => 'required',
            'component_identifier' => 'required'
        ]);

        $this->genericShortcutService->updateGenericShortcut($request->all(), $id);
        return redirect()->route('generic-shortcut', $request->generic_shortcut_master_id)->with('success', "Generic Shortcut Updated Successfully");
    }

    public function delete($id): RedirectResponse
    {
        $this->genericShortcutService->findOne($id)->delete();

        return redirect()->back()->with('success', "Generic Shortcut Deleted");
    }
}

<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\GenericComponentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GenericComponentController extends Controller
{
    private $genericComponentService;
    public function __construct(GenericComponentService $genericComponentService)
    {
        $this->genericComponentService = $genericComponentService;
    }
    public function index()
    {
        $components = $this->genericComponentService->findAll();
        return view('admin.generic-components.index', compact('components'));
    }

    public function create()
    {
        return view('admin.generic-components.create');
    }

    public function store(Request $request)
    {
        if ($this->genericComponentService->save($request->all())) {
            Session::flash('success', 'Component Create Successfully');
        } else {
            Session::flash('danger', 'Component Create Failed');
        }

        return redirect('generic-components');
    }

    public function edit($id)
    {
        $component =  $this->genericComponentService->findOne($id);

        return view('admin.generic-components.edit', compact('component'));
    }

    public function update(Request $request, $id)
    {
        if ($this->genericComponentService->update($id, $request->all())) {
            Session::flash('success', 'Component Update Successfully');
        } else {
            Session::flash('danger', 'Component Update Failed');
        }
        return redirect('generic-components');
    }

    public function delete($id)
    {
        if ($this->genericComponentService->delete($id)) {
            Session::flash('success', 'Component Delete Successfully');
        } else {
            Session::flash('danger', 'Component Delete Failed');
        }
        return redirect('generic-components');
    }
}

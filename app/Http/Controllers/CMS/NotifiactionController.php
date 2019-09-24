<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotifiactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifiactionCategories = $this->notifiactionCategorieService->findAll();
        return view('admin.notification.notifiacation-categorie.index')->with('notifiactionCategories',$notifiactionCategories);
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
        session()->flash('success',$this->notifiactionCategorieService->storeNotifiactionCategorie($request->all())->getContent());
        return redirect(route('nearByOffer.index'));

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
        return view('admin.offer-nearby.edit')
                ->with('nearByOffer',$this->notifiactionCategorieService->findOne($id));
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
        session()->flash('success',$this->notifiactionCategorieService->updateNotifiactionCategorie($request->all(),$nearByOffer)->getContent());
        return redirect(route('nearByOffer.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->flash('success',$this->notifiactionCategorieService->deleteNotifiactionCategorie($id));
        return redirect(route('nearByOffer.index'));
    }
}

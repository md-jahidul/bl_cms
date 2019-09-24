<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\NotifiactionCategorieService;
use App\Http\Requests\NotifiactionCategorieRequest;

class NotifiactionCategorieController extends Controller
{

    /**
     * @var NotifiactionCategorieService
     */
    private $notifiactionCategorieService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * NotifiactionCategorieService constructor.
     * @param NotifiactionCategorieService $NotifiactionCategorieService
     */
    public function __construct(NotifiactionCategorieService $notifiactionCategorieService)
    {
        $this->notifiactionCategorieService = $notifiactionCategorieService;
    }

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
    public function store(NotifiactionCategorieRequest $request)
    {
        session()->flash('success',$this->notifiactionCategorieService->storeNotifiactionCategorie($request->all())->getContent());
        return redirect(route('notifiactionCategorie.index'));

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
        $notifiactionCategories = $this->notifiactionCategorieService->findAll();
        $notifiactionCategorie = $this->notifiactionCategorieService->findOne($id);

        return view('admin.notification.notifiacation-categorie.index')
                    ->with('notifiactionCategorie',$notifiactionCategorie)
                    ->with('notifiactionCategories',$notifiactionCategories);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NotifiactionCategorieRequest $request, $id)
    { 
        session()->flash('success',$this->notifiactionCategorieService->updateNotifiactionCategorie($request->all(),$id)->getContent());
        return redirect(route('notifiactionCategorie.index'));
        
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
        return redirect(route('notifiactionCategorie.index'));
        
    }
}

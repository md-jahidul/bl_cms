<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\NotifiactionCategorieService;
use App\Services\NotifiactionService;
use App\Http\Requests\NotificationRequest;

class NotifiactionController extends Controller
{

    /**
     * @var NotifiactionService
     */
    private $notifiactionService;
    private $notifiactionCategorieService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * NotifiactionService constructor.
     * @param NotifiactionService $Notifiactionervice
     */
    public function __construct(NotifiactionService $notifiactionService,NotifiactionCategorieService $notifiactionCategorieService)
    {
        $this->notifiactionService = $notifiactionService;
        $this->notifiactionCategorieService = $notifiactionCategorieService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $notifiactions = $this->notifiactionService->findAll();
        $cat =  $this->notifiactionCategorieService->findAll();
        return view('admin.notification.notification.index')
                ->with('cat',$cat)
                ->with('notifiactions',$notifiactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->notifiactionCategorieService->findAll();
        return view('admin.notification.notification.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationRequest $request)
    {
        //dd($request->all());
        session()->flash('success',$this->notifiactionService->storeNotifiaction($request->all())->getContent());
        return redirect(route('notifiaction.index'));

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
        $categories = $this->notifiactionCategorieService->findAll();
        return view('admin.notification.notification.edit')
                ->with('categories',$categories)
                ->with('notifiaction',$this->notifiactionService->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NotificationRequest $request, $id)
    {
        //dd($request);
        session()->flash('success',$this->notifiactionService->updateNotifiaction($request->all(),$id)->getContent());
        return redirect(route('notifiaction.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        session()->flash('success',$this->notifiactionService->deleteNotifiaction($id));
        return redirect(route('notifiaction.index'));
    }
}

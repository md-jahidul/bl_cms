<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\NotificationCategoryService;
use App\Http\Requests\NotificationCategoryRequest;
use Illuminate\Http\Response;

class NotificationCategoryController extends Controller
{

    /**
     * @var NotificationCategoryService
     */
    private $notificationCategoryService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * NotificationcategoryService constructor.
     * @param NotificationCategoryService $notificationCategoryService
     */
    public function __construct(NotificationCategoryService $notificationCategoryService)
    {
        $this->notificationCategoryService = $notificationCategoryService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $notificationCategories = $this->notificationCategoryService->findAll();
        return view('admin.notification.notification-category.index')->with('notificationCategories', $notificationCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.notification.notification-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(NotificationCategoryRequest $request)
    {
        session()->flash('message', $this->notificationCategoryService->storeNotificationCategory($request->all())->getContent());
        return redirect(route('notificationCategory.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $notificationCategories = $this->notificationCategoryService->findAll();
        $notificationCategory = $this->notificationCategoryService->findOne($id);

        return view('admin.notification.notification-category.index')
                    ->with('notificationCategory', $notificationCategory)
                    ->with('notificationCategories', $notificationCategories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(NotificationCategoryRequest $request, $id)
    {
        session()->flash('success', $this->notificationCategoryService->updateNotificationCategory($request->all(), $id)->getContent());
        return redirect(route('notificationCategory.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        session()->flash('error', $this->notificationCategoryService->deleteNotificationCategory($id)->getContent());
        return url('notificationCategory');
    }
}

<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\RecurringScheduleHourService;
use Illuminate\Http\Request;

class RecurringScheduleHourController extends Controller
{
    /**
     * @var RecurringScheduleHourService
     */
    private $recurringScheduleHourService;

    /**
     * RecurringScheduleHourController constructor.
     * @param RecurringScheduleHourService $recurringScheduleHourService
     */
    public function __construct(RecurringScheduleHourService $recurringScheduleHourService)
    {
        $this->recurringScheduleHourService = $recurringScheduleHourService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $timeSlots = $this->recurringScheduleHourService->findBy(['used' => false]);
        return view('admin.app-launch-popup.schedule-hours.index', compact('timeSlots'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->recurringScheduleHourService->store($request->all())) {
            return redirect()->back()->with('success', 'Time slot added successfully');
        } else {
            return redirect()->back()->with('error', 'Time slot did not added!');
        }
    }

    public function destroy($id)
    {
        if ($this->recurringScheduleHourService->delete($id)) {
            return redirect()->back()->with('success', 'Time slot deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Time slot can not be deleted!');
        }
    }
}

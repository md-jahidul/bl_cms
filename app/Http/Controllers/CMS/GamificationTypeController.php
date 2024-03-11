<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\GamificationTypeRequest;
use App\Services\GamificationTypeService;
use App\Services\TriviaGamificationService;
use Illuminate\Http\Request;


class GamificationTypeController extends Controller
{
    protected  $gamificationTypeService;
    /**
     * @var TriviaGamificationService
     */
    private $triviaGamificationService;

    public function __construct(
        GamificationTypeService $gamificationTypeService,
        TriviaGamificationService $triviaGamificationService
    ) {
        $this->gamificationTypeService = $gamificationTypeService;
        $this->triviaGamificationService = $triviaGamificationService;
    }

    public function index()
    {
        $gamificationTypes = $this->gamificationTypeService->getGamificationTypes();
        return view('admin.gamification-type.index', compact('gamificationTypes'));
    }


    public function create()
    {
        $gamifications = $this->triviaGamificationService->findBy(['status' => 1]);
        return view('admin.gamification-type.create', compact('gamifications'));
    }


    public function store(GamificationTypeRequest $request)
    {
        if($this->gamificationTypeService->storeGamificationTypes($request->all())) {
            session()->flash('message', 'Gamification Type Created Successfully');
        } else {
            session()->flash('error', 'Gamification Type Created Failed');
        }

        return redirect('gamification-type');
    }


    public function edit($gamificationTypeId)
    {
        $gamificationType = $this->gamificationTypeService->findOne($gamificationTypeId);
        $gamificationsList = $this->triviaGamificationService->findBy(['status' => 1]);

        $preferredOrder = $gamificationType->trivia_gamification_ids;

        # Sort the collection based on the preferred order of IDs
        $gamifications = $gamificationsList->sortBy(function ($item) use ($preferredOrder) {
            return array_search($item['id'], $preferredOrder);
        });

        # Remove the items with preferred order IDs from the collection
        $gamifications = $gamifications->reject(function ($item) use ($preferredOrder) {
            return in_array($item['id'], $preferredOrder);
        });

        # Item pushed based on preferred order ID's position to the sorted collection
        foreach ($preferredOrder as $key =>  $id) {
            $item = $gamificationsList->firstWhere('id', $id);
            if ($item) {
                $gamifications->splice($key, 0, [$item]);
            }
        }

        return view('admin.gamification-type.edit', compact('gamificationType','gamifications'));
    }


    public function update(GamificationTypeRequest $request, $gamificationTypeId)
    {
        if($this->gamificationTypeService->updateGamificationType($request->all(), $gamificationTypeId)) {
            session()->flash('message', 'Gamification Type Updated Successfully');
        } else {
            session()->flash('error', 'Gamification Type Updated Failed');
        }

        return redirect('gamification-type');
    }

    public function updatePosition(Request $request)
    {
        return $this->gamificationTypeService->tableSortable($request);
    }


    public function destroy($gamificationTypeId)
    {
        $gamificationType = $this->gamificationTypeService->findOne($gamificationTypeId);

        if ($gamificationType) {
            $this->gamificationTypeService->deleteGamificationType($gamificationTypeId);
            session()->flash('error', 'Gamification Type Deleted Successfully');
        } else {
            session()->flash('error', 'Gamification Type Deleted Failed');
        }

        return redirect()->back();
    }
}

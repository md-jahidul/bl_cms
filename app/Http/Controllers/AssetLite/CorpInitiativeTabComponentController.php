<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\CorpInitiativeTabComponentService;
use App\Services\CorporateInitiativeTabService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CorpInitiativeTabComponentController extends Controller
{
    /**
     * @var CorpInitiativeTabComponentService
     */
    private $initiativeTabComponentService;
    /**
     * @var CorporateInitiativeTabService
     */
    private $initiativeTabService;

    public function __construct(
        CorpInitiativeTabComponentService $initiativeTabComponentService,
        CorporateInitiativeTabService $initiativeTabService
    ) {
        $this->initiativeTabComponentService = $initiativeTabComponentService;
        $this->initiativeTabService = $initiativeTabService;
    }

    protected $componentTypes = [
        'batch_component' => 'Batch Component',
        'events_activities' => 'Events Activities',
        'icon_box' => 'Icon Box',
        'mentors_component' => 'Mentors Component',
        'news_component' => 'News Component',
        'news_event' => 'News and Event',
        'partner' => 'Partner',
        'tutorial_step' => 'Tutorial Step',
        'winners' => 'Winners',
        'young_future' => 'Young Future',
    ];

    public function componentList($tabId)
    {
        $tab = $this->initiativeTabService->findOne($tabId);
        $components = $this->initiativeTabComponentService->componentList($tabId);
        return view('admin.corporate-responsibility.initiative.components.index', compact('components', 'tab'));
    }

    /**
     * @param $tabId
     * @return Application|Factory|View
     */
    public function componentCreateForm($tabId)
    {
        $componentTypes = $this->componentTypes;

        return view('admin.corporate-responsibility.initiative.components.create', compact('componentTypes', 'tabId'));
    }

    public function componentStore(Request $request, $tabId)
    {
//        dd($request->all());
        $response = $this->initiativeTabComponentService->componentStore($request->all(), $tabId);
        Session::flash('success', $response->content());
        return redirect(route('initiative_component.index', [$tabId]));
    }

    public function componentEditForm($tabId, $id)
    {
        $componentTypes = $this->componentTypes;
        $component = $this->initiativeTabComponentService->findComponent($id);
        $multipleItem = $component['multiple_attributes'];
//        dd($component['multiComponent']);
        return view('admin.corporate-responsibility.initiative.components.edit', compact('component', 'multipleItem', 'componentTypes', 'tabId'));
    }

    /**
     * @param Request $request
     * @param $pageId
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function componentUpdate(Request $request, $tabId, $id)
    {
        $response = $this->initiativeTabComponentService->componentUpdate($request->all(), $id);
        Session::flash('success', $response->content());
        return redirect(route('initiative_component.index', [$tabId]));
    }

    public function componentSortable(Request $request)
    {
        $this->initiativeTabComponentService->tableSortable($request);
    }

    /**
     * @param $tabId
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function componentDestroy($tabId, $id)
    {
        $this->initiativeTabComponentService->deleteComponent($id);
        return url(route('initiative_component.index', [$tabId]));
    }
}

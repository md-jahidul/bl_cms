<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\AlFaqCategoryService;
use App\Services\AlFaqService;
use App\Services\Assetlite\ComponentService;
use App\Services\BeAPartnerService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class BeAPartnerController extends Controller
{
    /**
     * @var BeAPartnerService
     */
    private $beAPartnerService;

    protected const PAGE_TYPE = 'be_a_partner';
    protected const BE_A_PARTNER_ID = 1;

    protected $componentTypes = [
//        'large_title_with_text' => 'Large Title With Text',
//        'medium_title_with_text' => 'Medium Title With Text',
//        'small_title_with_text' => 'Small Title With Text',
//        'text_and_button' => 'Text And Button',
//        'text_component' => 'Text Component',
//        'table_component' => 'Table Component',
//        'bullet_text' => 'Bullet Text',
//        'multiple_image' => 'Multiple Image',
        'accordion_text' => 'Accordion Text'
    ];
    /**
     * @var ComponentService
     */
    private $componentService;

    /**
     * RolesController constructor.
     * @param BeAPartnerService $beAPartnerService
     * @param ComponentService $componentService
     */
    public function __construct(
        BeAPartnerService $beAPartnerService,
        ComponentService $componentService
    ) {
        $this->beAPartnerService = $beAPartnerService;
        $this->componentService = $componentService;
    }

    public function getBeAPartner()
    {
        $beAPartner = $this->beAPartnerService->beAPartnerData();
        $components = $this->componentService->componentList(self::BE_A_PARTNER_ID, self::PAGE_TYPE);
        return view('admin.be-a-partner.landing-page', compact('beAPartner', 'components'));
    }

    public function beAPartnerEdit($id)
    {
        $beAPartner = $this->beAPartnerService->findOrFail($id);
        return view('admin.be-a-partner.landing-page-edit', compact('beAPartner'));
    }

    public function beAPartnerSave(Request $request, $id)
    {
        $response = $this->beAPartnerService->beAPartnerUpdate($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('be-a-partner');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $slug
     * @return Application|Factory|View
     */
    public function componentCreateForm()
    {
        $componentTypes = $this->componentTypes;
        return view('admin.be-a-partner.components.create', compact('componentTypes'));
    }

    public function componentStore(Request $request)
    {
        $response = $this->componentService->componentStore($request->all(), self::BE_A_PARTNER_ID, self::PAGE_TYPE);
        Session::flash('message', $response->getContent());
        return redirect('be-a-partner');
    }

    public function componentEditForm($id)
    {
        $componentTypes = $this->componentTypes;
        $component = $this->componentService->findOne($id);
        return view('admin.be-a-partner.components.edit', compact('component', 'componentTypes'));
    }

    /**
     * @param Request $request
     * @param $pageId
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function componentUpdate(Request $request, $id)
    {
        $response = $this->componentService->componentUpdate($request->all(), $id);
        Session::flash('success', $response->content());
        return redirect('be-a-partner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param $slug
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function componentDelete($id)
    {
        $this->componentService->deleteComponent($id);
        return url("be-a-partner");
    }
}

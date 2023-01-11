<?php

namespace App\Http\Controllers\CMS\FIFA;

use App\Http\Controllers\Controller;
use App\Repositories\FifaDeeplinkRepository;
use Illuminate\Http\Request;

class FifaDeeplinkController extends Controller
{

    protected $fifaDeeplinkRepository;

    public function __construct(FifaDeeplinkRepository $fifaDeeplinkRepository)
    {
        $this->fifaDeeplinkRepository = $fifaDeeplinkRepository;
    }

    public function index()
    {

        $fifaDeeplinkItem = $this->fifaDeeplinkRepository->findAll();

        return view('admin.fifa-wc.deeplink', compact('fifaDeeplinkItem'));
    }

    public function store(Request $request)
    {
        $data['category_name'] = 'fifa';
        $data['detail_id'] = $request->detail_id;
        $data['slug'] = $request->detail_id;

        $response = $this->fifaDeeplinkRepository->save($data);
        session()->flash('message', 'Create Successfully');
        return redirect(route('fifa-deeplink'));
    }

    public function destroy($id)
    {
        $deeplink = $this->fifaDeeplinkRepository->findOne($id);
        $this->fifaDeeplinkRepository->delete($deeplink);

        return url(route('fifa-deeplink'));
    }

}

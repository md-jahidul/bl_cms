<?php

namespace App\Http\Controllers\AssetLite;

use App\Repositories\ReferralCodeRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ReferralListController extends Controller
{
    /**
     * @var ReferralCodeRepository
     */
    private $referralCodeRepository;

    /**
     * ReferralListController constructor.
     * @param ReferralCodeRepository $referralCodeRepository
     */
    public function __construct(ReferralCodeRepository $referralCodeRepository)
    {
        $this->referralCodeRepository = $referralCodeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $referralList = $this->referralCodeRepository->findAll('', ['apps' => function ($q) {
            $q->select('id', 'name_en');
        }]);
        return view('admin.app-service.referral-list.index', compact('referralList'));
    }
}

<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\SaveLearnPriyojonContentRequest;
use App\Http\Requests\SaveTermsAndConditionsRequest;
use App\Models\MyBlLearnPriyojonContent;
use App\Models\TermsConditions;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class LearnPriyojonContentController
 * @package App\Http\Controllers\CMS
 */
class LearnPriyojonContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return Application|Factory|View
     */
    public function show()
    {
        $contents = MyBlLearnPriyojonContent::where('platform', 'app')->first();

        return view('admin.learn-priyojon.show', compact('contents'));
    }

    /**
     * @param  SaveLearnPriyojonContentRequest  $request
     */
    public function store(SaveLearnPriyojonContentRequest $request)
    {
        MyBlLearnPriyojonContent::updateOrCreate([
           'platform' => 'app'
        ], [
           'contents' => $request->contents
        ]);

        return redirect()->route('learn-priyojon.show');
    }
}

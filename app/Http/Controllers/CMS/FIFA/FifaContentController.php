<?php

namespace App\Http\Controllers\CMS\FIFA;

use App\Http\Controllers\Controller;
use App\Models\FIFA\Match;
use App\Repositories\FifaContentRepository;
use App\Repositories\MatchRepository;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;

class FifaContentController extends Controller
{
    protected $fifaContentRepository;

    public function __construct(FifaContentRepository  $fifaContentRepository){
        $this->fifaContentRepository = $fifaContentRepository;
    }

    public function createOrEdit()
    {
        $content  = $this->fifaContentRepository->getFifaContent();

        return view('admin.fifa-wc.createOrEdit', compact('content'));
    }

    public function store(Request $request)
    {
        $content  = $this->fifaContentRepository->getFifaContent();

        if (!is_null($content)) {
            $content = $content->first();
            $data = [];
            if (isset($request->image)) {
                $data['image'] = 'storage/' . $request->image->store('fifa_wc');
            }

            if ($content->update($data)) {
                Session::flash('message', 'Team Update successful');
            } else {
                Session::flash('danger', 'Team Update Failed');
            }

        } else {
            $data['image'] = 'storage/' . $request->image->store('fifa_wc');
            if ($this->fifaContentRepository->create($data)) {
                Session::flash('success', 'Content Store Successfully');
            } else {
                Session::flash('danger', 'Content Stored Failed');
            }
        }

        return redirect('fifa-content');
    }
}

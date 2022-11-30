<?php

namespace App\Http\Controllers\CMS\FIFA;

use App\Http\Controllers\Controller;
use App\Models\FIFA\Match;
use App\Repositories\MatchRepository;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MatchController extends Controller
{


    private $matchRepository, $teamRepository;

    public function __construct(MatchRepository $matchRepository, TeamRepository $teamRepository){

        $this->matchRepository = $matchRepository;
        $this->teamRepository = $teamRepository;
    }
    public function index()
    {
        $matches = $this->matchRepository->findAll();

        return view('admin.fifa-wc.match.index', compact('matches'));
    }


    public function create()
    {
        $teams = $this->teamRepository->findAll();
        return view('admin.fifa-wc.match.create', compact('teams'));
    }


    public function store(Request $request)
    {
        $data = $this->dataFormat($request);

        if ($this->matchRepository->create($data)) {
            Session::flash('success', 'Match store successful');
        } else {
            Session::flash('danger', 'Match Stored Failed');
        }

        return redirect('matches');
    }



    public function edit($matchId)
    {
        $match = $this->matchRepository->findOne($matchId);
        $teams = $this->teamRepository->findAll();

        return view('admin.fifa-wc.match.edit', compact('teams', 'match'));
    }


    public function update(Request $request, $matchId)
    {
        $data = $this->dataFormat($request);
        $match = $this->matchRepository->findOne($matchId);

        if ($match->update($data)) {
            Session::flash('success', 'Match Update successful');
        } else {
            Session::flash('danger', 'Match Update Failed');
        }

        return redirect('matches');
    }


    public function destroy($matchId)
    {
        $match = $this->matchRepository->findOne($matchId);

        if ($this->matchRepository->delete($match)) {
            Session::flash('message', 'Match Delete successful');
        } else {
            Session::flash('danger', 'Match Delete Failed');
        }

        return redirect('matches');
    }

    public function dataFormat($request)
    {
        $data['home_team_id'] = $request->home_team_id;
        $data['away_team_id'] = $request->away_team_id;
        $data['start_time'] = $request->start_time;
        $data['ticketing_time'] = $request->ticketing_time;
        $data['signed_cookie'] = $request->signed_cookie;
        $data['url'] = $request->url;
        $data['status'] = $request->status;
        $data['number_of_seats'] = $request->number_of_seats;
        if (isset($request->is_hidden)) {
            $data['is_hidden'] = $request->is_hidden;
        }

        return $data;
    }

    public function signedCookie()
    {
        $matches = $this->matchRepository->findAll();

        return view('admin.fifa-wc.match.signed-cookie', compact('matches'));
    }

    public function generateCookie($matchId)
    {
//        $result = trim(shell_exec("/app/mybl/opt/python3.11/bin/python3 /app/mybl/www/generate_signed_cookie/signed_cookies.py {$matchId} 2>&1"));
        $result = trim(shell_exec("/usr/bin/python3 /app/blcms/www/generate_signed_cookie/signed_cookies.py {$matchId} 2>&1"));
//        $match = $this->matchRepository->findOne($matchId);
//        $data['signed_cookie'] = $result;
//        $match->update($data);

        if ($result) {
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }
}

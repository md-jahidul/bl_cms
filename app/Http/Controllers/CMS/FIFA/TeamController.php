<?php

namespace App\Http\Controllers\CMS\FIFA;

use App\Http\Controllers\Controller;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeamController extends Controller
{

    private $teamRepository;

    public function __construct(TeamRepository $teamRepository){

        $this->teamRepository = $teamRepository;
    }

    public function index()
    {
        $teams = $this->teamRepository->findAll();

        return view('admin.fifa-wc.team.index', compact('teams'));
    }


    public function create()
    {
        return view('admin.fifa-wc.team.create');
    }


    public function store(Request $request)
    {
        $data['team_name'] = $request->team_name;
        $data['group_name'] = $request->group_name;

        if (isset($request->team_flag)) {
            $data['team_flag'] = 'storage/' . $request->team_flag->store('fifa_wc');
        }

        $flag = $this->teamRepository->create($data);

        if ($flag) {
            Session::flash('message', 'Team store successful');
        } else {
            Session::flash('danger', 'Team Stored Failed');
        }

        return redirect('teams');
    }


    public function edit($teamId)
    {
        $team = $this->teamRepository->findOne($teamId);

        return view('admin.fifa-wc.team.edit', compact('team'));
    }


    public function update(Request $request, $teamId)
    {
        $data['team_name'] = $request->team_name;
        $data['group_name'] = $request->group_name;

        if (isset($request->team_flag)) {
            $data['team_flag'] = 'storage/' . $request->team_flag->store('fifa_wc');
        }

        $team = $this->teamRepository->findOne($teamId);

        if ($team->update($data)) {
            Session::flash('message', 'Team Update successful');
        } else {
            Session::flash('danger', 'Team Update Failed');
        }

        return redirect('teams');
    }


    public function destroy($teamId)
    {
        $team = $this->teamRepository->findOne($teamId);

        if ($this->teamRepository->delete($team)) {
            Session::flash('message', 'Team Delete successful');
        } else {
            Session::flash('danger', 'Team Delete Failed');
        }

        return redirect('teams');
    }
}

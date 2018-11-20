<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Project;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $current_user;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = Auth::user();
        $projectList = Project::where('created_by', $current_user->id)->get();
        $data = [
            'projectList' => $projectList,
        ];
        return view('home', $data);
    }

    public function projectView($projectId){
        $current_user = Auth::user();
        $projectList = Project::where('id', $projectId)
            ->with('userProject')
            ->with('listCard.activityCard.checklist')
            ->first()
            ->toArray();
        dd($projectList);
        $data = [
            'projectList' => $projectList,
        ];
        return view('project', $data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Project;
use App\UserProject;
use App\Http\Libraries\ProjectLibrary;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $current_user;
    protected $projectLib;

    public function __construct()
    {
        $this->middleware('auth');
        $this->projectLib = new ProjectLibrary();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = Auth::user();
        $projectList = $this->projectLib->getProjectListByUserId($current_user->id);
        $data = [
            'projectList' => $projectList,
        ];
        return view('home', $data);
    }

    public function projectView($projectId){
        $current_user = Auth::user();
        $projectList = $this->projectLib->getProjectListByUserId($current_user->id);
        $projectItem = Project::where('id', $projectId)
            ->with('userProject.user')
            ->with(['listCard.activityCard' => function($q){
                $q->with('transaction.transactionList')->with('priority.color')->with('media')->with('checklist.media');
            }])
            ->first()
            ;
        $data = [
            'projectList' => $projectList,
            'currentProject' => $projectItem,
            'user' => $current_user,
        ];
        return view('project', $data);
    }

    public function projectMenu(){
        $current_user = Auth::user();
        $projectList = $this->projectLib->getProjectListByUserId($current_user->id);
        $data = [
            'projectList' => $projectList,
            'user' => $current_user,
        ];
        return view('project', $data);
    }

    public function createProject(Request $request)
    {
        $current_user = Auth::user();
        $savedProjects = Project::create([
            'name' => @$request->name,
            'cost' => @$request->cost,
            'address' => @$request->address,
            'created_by' => @$current_user->id,
            'cost_status' => 1,
        ]);
        $userProject = UserProject::create([
            'project_id' => @$savedProjects->id,
            'user_id' => @$current_user->id,
            'user_level_id' => 1,
        ]);
        $projectList = $this->projectLib->getProjectListByUserId($current_user->id);
        $data = [
            'projectList' => $projectList,
            'user' => $current_user,
        ];
        return view('project', $data);
    }

    public function chatMenu(){
        $current_user = Auth::user();
        $projectList = $this->projectLib->getProjectListByUserId($current_user->id);
        $data = [
            'projectList' => $projectList,
        ];
        return view('chat', $data);
    }

    public function chatProject($projectId){
        $current_user = Auth::user();
        $projectList = $this->projectLib->getProjectListByUserId($current_user->id);
        $data = [
            'projectList' => $projectList,
            'projects' => Project::where('id', $projectId)->first(),
        ];
        return view('chatproject', $data);
    }

    public function settingMenu(){
        $current_user = Auth::user();
        $projectList = $this->projectLib->getProjectListByUserId($current_user->id);
        $data = [
            'projectList' => $projectList,
        ];
        return view('settings', $data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Project;
use App\UserProject;
use App\ListCard;
use App\ActivityCard;
use App\Checklist;
use App\User;
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
        $data = $this->projectLib->getProjectById($projectId, $current_user->id);
        return view('project', $data);
    }

    public function projectMenu(){
        $current_user = Auth::user();
        $projectList = $this->projectLib->getProjectListByUserId($current_user->id);
        $data = [
            'projectList' => $projectList,
            'user' => $current_user,
            'userList' => [],
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

    public function addUserProject($projectId, Request $request)
    {
        $current_user = Auth::user();
        $userId = $request->user_id;
        $userExist = User::find($userId);
        if(!empty($userExist)){
            UserProject::create([
                'project_id' => $projectId,
                'user_id' => $userId,
                'user_level_id' => 1,
            ]);
        }
        $data = $this->projectLib->getProjectById($projectId, $current_user->id);
        return view('project', $data);
    }

    public function createList(Request $request){
        $current_user = Auth::user();
        $projectId = Project::where('id', $request->project_id);
        if(!empty($projectId)){
            $list = ListCard::create([
                'name' => $request->name,
                'order' => $projectId->count(),
                'project_id' => @$projectId->first()->id,
            ]);
            $projectList = $this->projectLib->getProjectListByUserId($current_user->id);
            $data = [
                'projectList' => $projectList,
                'user' => $current_user,
            ];
            return redirect('projects/'.@$projectId->first()->id);
        }
        else{
            return redirect('projects');
        }
    }

    public function createCard(Request $request){
        $current_user = Auth::user();
        $listId = ListCard::where('id', $request->list_id);
        if(!empty($listId)){
            $list = ActivityCard::create([
                'name' => $request->name,
                'order' => $listId->count(),
                'list_card_id' => @$listId->first()->id,
            ]);
            $projectList = $this->projectLib->getProjectListByUserId($current_user->id);
            $data = [
                'projectList' => $projectList,
                'user' => $current_user,
            ];
            return redirect('projects/'.@$listId->first()->project_id);
        }
        else{
            return redirect('projects');
        }
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
            'currentProject' => Project::where('id', $projectId)->first(),
        ];
        return view('chatproject', $data);
    }

    public function settingMenu(){
        $current_user = Auth::user();
        $projectList = $this->projectLib->getProjectListByUserId($current_user->id);
        $data = [
            'projectList' => $projectList,
            'current_user' => $current_user,
        ];
        return view('settings', $data);
    }

    public function team()
    {
        $current_user = Auth::user();
        $projectList = $this->projectLib->getProjectListByUserId($current_user->id);
        $projectArray = [];
        foreach ($projectList as $key => $value) {
            $projectArray[] = $value->id;
        }

        $userProject = UserProject::whereIn('project_id', $projectArray)->whereNotIn('user_id', [$current_user->id])->with('user')->get()->unique('user_id');

        $data = [
            'projectList' => $projectList,
            'userProject' => $userProject,
        ];

        return view('team', $data);
    }

    public function resetPassword()
    {
        $current_user = Auth::user();
        $data = [
            'current_user' => $current_user,
        ];
        return view('reset', $data);
    }

    public function helps()
    {
        $current_user = Auth::user();
        $data = [
            'current_user' => $current_user,
        ];
        return view('helps', $data);
    }

    public function workspaceSettings()
    {
        $current_user = Auth::user();
        $data = [
            'current_user' => $current_user,
        ];
        return view('workspace', $data);
    }

    public function feedback()
    {
        $current_user = Auth::user();
        $data = [
            'current_user' => $current_user,
        ];
        return view('feedback', $data);
    }
}

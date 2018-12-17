<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Project;
use App\UserProject;
use App\ListCard;
use App\ActivityCard;
use App\Checklist;
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
            ->with('createdBy')
            ->with(['listCard.activityCard' => function($q){
                $q->with('transaction.transactionList')->with('priority.color')->with('media')->with('checklist.media');
            }])
            ->first()
            ;
        $data = [
            'projectList' => $projectList,
            'currentProject' => $projectItem,
            'projectArray' => json_encode($projectItem->toArray()),
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
        $data = [
            'projectList' => $projectList,
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

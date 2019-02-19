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
use App\UserLevel;
use App\Chat;
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
        $data = $this->projectLib->getProjectById($projectId, $current_user);
        if($data['status'] == 0){
            // return "You have not any permission to open this project";
            return view('project_null');
        }
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
        $userLevel = UserLevel::where('title', 'admin')->first();
        if(!$userLevel){
            return "Error, you should seed your user level first";
        }
        $savedProjects = Project::create([
            'name' => @$request->name,
            'cost' => @$request->cost,
            'address' => @$request->address,
            'description' => @$request->description,
            'created_by' => @$current_user->id,
            'cost_status' => 1,
        ]);
        $userProject = UserProject::create([
            'project_id' => @$savedProjects->id,
            'user_id' => @$current_user->id,
            'user_level_id' => $userLevel->id,
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
        $userId = @$request->user_id;
        $roleId = @$request->role_id;
        $userExist = User::find($userId);
        if(!$roleId){
            return "Error, you should seed your user level first";
        }
        $role = UserLevel::find(@$roleId);
        $roleSuspend = UserLevel::where('title', $role->title." suspended")->first();
        if(!empty($userExist)){
            UserProject::create([
                'project_id' => $projectId,
                'user_id' => $userId,
                'user_level_id' => $roleSuspend->id,
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
        $currentProject = Project::where('id', $projectId)->with('chat')->first();
        $data = [
            'projectList' => $projectList,
            'currentProject' => $currentProject,
            'user_id' => $current_user->id,
        ];
        return view('chatproject', $data);
    }

    public function createChat($projectId, Request $request){
        $current_user = Auth::user();
        $chat = Chat::create([
            'user_id' => $current_user->id,
            'project_id' => $projectId,
            'message' => @$request->message,
        ]);
        // return $this->chatProject($projectId);
        return redirect('chats/'.$projectId.'/');
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

    public function invitation()
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

        return view('invitation', $data);
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

<?php
namespace App\Http\Libraries;
use App\Project;
use App\UserProject;
use App\UserLevel;
use App\User;

class ProjectLibrary
{
    public function getProjectListByUserId($userId)
    {
        $projectList = Project::whereHas('userProject', function($q) use($userId){
            $q->where('user_id', $userId)
                ->whereHas('userLevel', function($q){
                    $q->where('status', 1);
                });
        })
        ->with('createdBy')
        ->get();

        // Filter project yang dimiliki user, berdasarkan tabel user_projects
        
        return $projectList;
    }

    public function getProjectById($projectId, $current_user)
    {
        $projectList = $this->getProjectListByUserId(@$current_user->id);
        $projectItem = Project::where('id', $projectId)
            ->whereHas('userProject', function($q) use($current_user){
                $q->where('user_id', $current_user->id)
                    ->whereHas('userLevel', function($q){
                        $q->where('status', 1);
                    });
            })
            ->with(['userProject' => function($q){
                $q->with('userLevel');
            }])
            ->with('createdBy')
            ->with(['listCard.activityCard' => function($q){
                $q->with('transaction.transactionList')->with('priority.color')->with('media')->with('checklist.media');
            }])
            ->first();
        $currentUserProject = UserProject::where('project_id', $projectId)->get();
        $userProjectArray = [];
        foreach ($currentUserProject as $key => $value) {
            $userProjectArray[] = $value->user_id;
        }
        $userList = User::whereNotIn('id', $userProjectArray)->get();
        $roleList = UserLevel::where('status', 1)->get();
        if(!@$projectItem){
            return [
                'status' => 0,
            ];
        }
        $data = [
            'status' => 1,
            'projectList' => $projectList,
            'currentProject' => $projectItem,
            'projectArray' => json_encode($projectItem->toArray()),
            'user' => $current_user,
            'userList' => $userList,
            'roleList' => $roleList,
        ];
        return $data;
    }
}
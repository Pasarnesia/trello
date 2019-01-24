<?php
namespace App\Http\Libraries;
use App\Project;
use App\UserProject;
use App\User;

class ProjectLibrary
{
    public function getProjectListByUserId($userId)
    {
        $projectList = Project::whereHas('userProject', function($q) use($userId){
            $q->where('user_id', $userId);
        })
        ->with('createdBy')
        ->get();

        // Filter project yang dimiliki user, berdasarkan tabel user_projects
        
        return $projectList;
    }

    public function getProjectById($projectId, $current_user)
    {
        $projectList = $this->getProjectListByUserId($current_user->id);
        $projectItem = Project::where('id', $projectId)
            ->with('userProject.user')
            ->with('createdBy')
            ->with(['listCard.activityCard' => function($q){
                $q->with('transaction.transactionList')->with('priority.color')->with('media')->with('checklist.media');
            }])
            ->first()
            ;
        $currentUserProject = UserProject::where('project_id', $projectId)->get();
        $userProjectArray = [];
        foreach ($currentUserProject as $key => $value) {
            $userProjectArray[] = $value->user_id;
        }
        $userList = User::whereNotIn('id', $userProjectArray)->get();
        $data = [
            'projectList' => $projectList,
            'currentProject' => $projectItem,
            'projectArray' => json_encode($projectItem->toArray()),
            'user' => $current_user,
            'userList' => $userList,
        ];
        return $data;
    }
}
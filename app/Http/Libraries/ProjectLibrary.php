<?php

namespace App\Http\Libraries;

use App\User;
use App\Project;

class ProjectLibrary
{
    public function getProjectListByUserId($userId)
    {
        $projectList = Project::whereHas('userProject', function($q) use($userId){
            $q->where('user_id', $userId);
        })->get();
        
        return $projectList;
    }
}
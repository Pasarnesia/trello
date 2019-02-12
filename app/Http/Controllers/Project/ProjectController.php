<?php
namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Project;
use App\ActivityCard;
use App\ListCard;
use App\Transaction;
use App\TransactionList;

use Illuminate\Http\Request;
use Validator;
use Auth;

class ProjectController extends Controller
{
    protected $currentUser;

    function __contruct()
    {
        parent::__construct();
        $this->currentUser = Auth::user();
    }

    public function index()
    {
        $data = [
            'status' => 'success',
            'data' => Project::all(),
            'message' => '',
            'user' => $this->currentUser,
        ];
        return Response()->json($data);
    }

    public function getProjectListById($projectId){
        $projectItem = Project::where('id', $projectId)
            ->with('userProject.user')
            ->with('createdBy')
            ->with(['listCard.activityCard' => function($q){
                $q->with('transaction.transactionList')->with('priority.color')->with('media')->with('checklist.media');
            }])
            ->first();

        return response()->json([
            'status' => 'success',
            'data' => $projectItem,
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['message' => $validator->messages()], 400);
        }
    }

    public function updateProject($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['message' => $validator->messages()], 400);
        }

        $project = @Project::where('id', $id)->first();
        if($project != null){
            $project->update([
                'name' => $request->name,
                'description' => $request->desc,
                'cost' => $request->cost,
                'address' => $request->address,
            ]);
            $project->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Project data already updated',
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'Project data not found',
            ]);
        }
    }

    public function deleteProject($projectId){
        $projectExist = Project::where('id', $projectId);
        if (!empty($projectExist)) {
            $projectExist->delete();
        }
    }

    public function updateDescription(Request $request)
    {
        $activityId = $request->activityId;
        $value = $request->value;
        $type = $request->type;
        $activityItem = ActivityCard::where('id', $activityId)->first();
        if(!empty($activityItem)){
            $activityItem->update([
                $type => $value,
            ]);
            $activityItem->save();
            return response()->json([
                'status' => 'success',
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'Not Found',
            ]);
        }
    }

    public function getActivityCard(Request $request){
        $activity = ActivityCard::where('id', $request->activityId)->with('transaction.transactionList');
        return @$activity->first();
    }

    public function getListCard(Request $request){
        $listCard = ListCard::where('id', $request->listId);
        return @$listCard->first();
    }

    public function updateLIstCard($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['message' => $validator->messages()], 400);
        }
        $listCard = ListCard::where('id', $id)->first();
        @$listCard->update([
            'name' => $request->name,
        ]);
        $listCard->save();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function deleteListCard($id){
        $listCard = ListCard::where('id', $id)->first();
        $listCard->delete();
    }

    public function deleteActivityCard($id){
        $activity = ActivityCard::where('id', $id)->first();
        $activity->delete();
    }

    // Chat
    public function getChat(Request $request)
    {
        return response()->json([
            'data' => 'asdasdasdas',
            'message' => 'asdasdasdasdas',
        ]);
    }

    public function createChat(Request $request)
    {
        return $request->all();
    }

    public function updateChat($id, Request $request)
    {
        return $request->all();
    }

    public function deleteChat($id)
    {
        return $request->all();
    }

    public function uploadMedia(Request $request)
    {
        dd($request->all());
        // $validator = Validator::make($request->all(), [
        //     'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        // ]);
        // if($validator->fails()){
        //     return response()->json(['message' => $validator->messages()], 400);
        // }
        // $request->file('file')->storeAs('files', 'files_'.@$this->currentUser->id);
        
        // return back()->with('success', 'Your verification request has been successfully submitted.');
    }
}
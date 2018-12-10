<?php
namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Project;
use App\ActivityCard;

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

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['message' => $validator->messages()], 400);
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
            // dd($activityItem);
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
}
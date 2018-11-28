<?php
namespace App\Http\Controllers\Project;
use App\Http\Controllers\Controller;
use App\Project;
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
            // 'cost' => 'required',
            // 'cost_status' => 'required',
            // 'address' => 'required',
            // 'created_by' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['message' => $validator->messages()], 400);
        }
        dd($this);
    }
}
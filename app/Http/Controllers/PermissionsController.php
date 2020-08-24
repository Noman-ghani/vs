<?php

namespace App\Http\Controllers;

use App\Models\Rbac\Permissions;
use Dotenv\Result\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class PermissionsController extends Controller
{
    private $permission;
    
    public function __construct(Permissions $permission)
    {
        $this->permission = $permission;
    }

    public function browse(Request $request)
    {
        $record = (int)$request->get('record');
        $sortRequest = $request->get('sort');
        $sortOrder = $request->get('sort_order') == 'true' ? 'desc' : 'asc';
        
       
        $results = $this->permission
            ->select('id', 'title','short_code','created_at')
            ->where('is_deleted',0);

        if($request->get('id')){
            $results->where('id',$request->get('id'));
        }

        if ($request->get('name')) {
            $results->where('title', 'like', '%' . $request->get('name') . '%');
        }

        if($request->get('created_at')){
            $created_at_request = $request->get('created_at').'%';
            $results->where('created_at', 'like', $created_at_request);
        }
        if ($sortRequest) {
                $results->orderBy($sortRequest, $sortOrder);
        }else{
                $results->orderBy('id', 'desc');
        }
        $results =  $results->paginate($record);

        $response = [
            'pagination' => [
                'total' => $results->total(),
                'per_page' => $results->perPage(),
                'current_page' => $results->currentPage(),
                'last_page' => $results->lastPage(),
                'from' => $results->firstItem(),
                'to' => $results->lastItem()
            ],
            'data' => $results
        ];
        
        return response()->json($response);
    }

    public function get_by_id($id)
    {
    
        $results = $this->permission
            ->select('id', 'role_id','capability_id')
            ->where('role_id', $id)
            ->get();
        return $results;
    }
    public function store(Request $request)
    {
        $TMP_validation = [
            'title' => 'required|unique:App\Models\Rbac\Permissions,title',
        ];
        $validator = Validator::make($request->all(), $TMP_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }else{

            $short_code =  str_replace(' ', '_', strtolower($request->title));
            $permissionData = array(
                'title'   => $request->title,
                'short_code' => $short_code,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );
            
            $this->permission->insert($permissionData);
        }
        
        return response()->json(['success' => true], 200);
    }
    public function soft_delete_by_id(Request $request, $id)
    {
         $this->permission =  $this->permission->find($id);
         $this->permission->is_deleted = 1;
         $this->permission->save();
    }
}

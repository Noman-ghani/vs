<?php

namespace App\Http\Controllers;

use App\Models\Rbac\RolesCapabilities;
use App\Models\Rbac\AllowPermissions;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $role;
    
    public function __construct(RolesCapabilities $role,AllowPermissions $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
        $this->message = [
            'capability_id.required'                           => 'Please select at least one permission to continue.'
        ];
    }
    public function browse(Request $request)
    {
        $record = (int)$request->get('record');
        $sortRequest = $request->get('sort');
        $sortOrder = $request->get('sort_order') == 'true' ? 'desc' : 'asc';
        
        if($request->route()->uri == "securedportal/api/capability"){
            $where = "capability";
        }else{
            $where = "role";
        }
        $results = $this->role
            ->select('id', 'title','short_code','created_at')->where('type',$where)
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
            if($where != "capability"){
                $results->orderBy('id', 'desc');
            }
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
        return $this->role
            ->select('id', 'title','short_code','type')
            ->where('id', $id)
            ->first();
    }

    public function store(Request $request)
    {

        $TMP_validation = [
            'title' => 'required|unique:App\Models\Rbac\RolesCapabilities,title',
            'type' => 'required',
            'capability_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $TMP_validation,$this->message);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }else{
            $short_code =  str_replace(' ', '_', strtolower($request->title));
            $roleData = array(
                'title'   => $request->title,
                'short_code' => $short_code,
                'type'  => $request->type,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );
        
    
            $insertRole = $this->role->create($roleData);
            $this->permission->where('role_id', $insertRole->id)->delete();
            $capabilities = $request->capability_id;

            $finalData = array();
            foreach ($capabilities as $value) {
                array_push(
                    $finalData,
                    array(
                            'role_id'=> $insertRole->id,
                            'capability_id'=>$value,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                            )
                );
            }
            $this->permission->insert($finalData);
        }
        return response()->json(['success' => true], 200);
    }

    public function update_by_id(Request $request, $id)
    {
        $this->role = $this->role->find($id);
        $this->role->fill($request->all());

        $TMP_validation = [
            'title' => 'required',
            'type' => 'required',
            'capability_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $TMP_validation,$this->message);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }else{
            $this->role->save();
            $this->permission->where('role_id', $id)->delete();

            $capabilities = $request->capability_id;
            
            $finalData = array();
            foreach ($capabilities as $value) {
                array_push(
                    $finalData,
                    array(
                'role_id'=> $id,
                'capability_id'=>$value,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                )
                );
            }
            $this->permission->insert($finalData);
        }
        return response()->json(['success' => true], 200);
    }

    public function soft_delete_by_id(Request $request, $id)
    {
         $this->role =  $this->role->find($id);
         $this->role->is_deleted = 1;
         $this->role->save();
    }
}

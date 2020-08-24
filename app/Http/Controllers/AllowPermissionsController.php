<?php

namespace App\Http\Controllers;

use App\Models\Rbac\AllowPermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class AllowPermissionsController extends Controller
{
    private $AllowPermissions;

    public function __construct(AllowPermissions $AllowPermissions)
    {
        $this->AllowPermissions = $AllowPermissions;
    }

    public function get_by_id($id)
    {
        $results = $this->AllowPermissions
            ->select('id', 'role_id','capability_id')
            ->where('role_id', $id)
            ->get();
        $check_id = [];
        foreach($results as $res){
            array_push($check_id,$res->capability_id);
        }
        return $check_id;
    }
}

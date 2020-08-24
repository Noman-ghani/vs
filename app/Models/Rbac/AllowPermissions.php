<?php

namespace App\Models\Rbac;

use Illuminate\Database\Eloquent\Model;

class AllowPermissions extends Model
{
    protected $fillable = ['role_id','capability_id'];
}

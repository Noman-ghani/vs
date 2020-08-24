<?php

namespace App\Models\Rbac;

use Illuminate\Database\Eloquent\Model;

class RolesCapabilities extends Model
{
    protected $fillable = ['title','short_code','type'];
}

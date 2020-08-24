<?php

namespace App\Models\Rbac;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    protected $fillable = ['title','short_code'];
}

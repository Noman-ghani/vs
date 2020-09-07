<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainers extends Model
{
    protected $fillable = [
        'active'                    ,
        'mobile_no'                   ,
        'alternate_contact_no'        ,
        'cnic'                        ,
        'province'                    ,
        'district'                    ,
        'basic_qualification'         ,
        'work_experience'             ,
        'workplace_type'              ,
        'address_personal_workplace' ,
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    protected $fillable = [
        'are_you_doctor'              ,
        'mobile_no'                   ,
        'alternate_contact_no'        ,
        'province'                    ,
        'district'                    ,
        'basic_qualification'         ,
        'workplace_type'              ,
        'address_government_hospital' ,
        'address_private_hospital'    ,
        'work_experience'             ,
        'cnic'                        ,
        'pmdc_registration_number'    ,
        'has_taken_pretest'           ,
        'pretest_started_at'          ,
        'pretest_ended_at'            ,
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
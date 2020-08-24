<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorsTimespentLogs extends Model
{
    protected $fillable = ['module_id', 'type', 'started_at', 'ended_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\Doctors');
    }
}

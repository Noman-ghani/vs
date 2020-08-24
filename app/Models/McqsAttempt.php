<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class McqsAttempt extends Model
{   
    protected $table = "mcqs_attempt";
    protected $fillable = ['user_id','mcq_id', 'mcq_answer_id'];
    
    public function mcqs()
    {
        return $this->hasOne('App\Models\Mcqs','id','mcq_id');
    }
    public function mcqs_answers()
    {
        return $this->hasOne('App\Models\McqsAnswers','id','mcq_answer_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class McqsAnswers extends Model
{
    protected $table = "mcqs_answers";
    protected $fillable = ['mcq_id', 'answer', 'is_correct'];
    public function mcq()
    {
       return $this->hasOne('App\Models\Mcqs','mcq_id');
    }
}

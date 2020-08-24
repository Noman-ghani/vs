<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mcqs extends Model
{
    protected $table = "mcqs";
    protected $fillable = ['question', 'type', 'classification', 'sort', 'is_active'];

    public function mcq_answers()
    {
       return $this->hasMany('App\Models\McqsAnswers','mcq_id');
    }
}

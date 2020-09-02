<?php

namespace App\Http\Controllers;
use App\Models\McqsAttempt;
use App\Models\Mcqs;
use App\Models\McqsAnswers;
use App\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ResultController extends Controller
{
    private $result;
    private $user;

    public function __construct()
    {
        $this->result = new McqsAttempt;
        $this->user = new User;
        $this->mcqs = new Mcqs;
        $this->mcqs_answers = new McqsAnswers;
    }

    public function browse(Request $request)
    {
        
        $sortRequest = $request->get('sort');
        $sortOrder = $request->get('sort_order') == 'true' ? 'desc' : 'asc';
        $record = (int)$request->get('record');
        $results = $this->result::select(DB::raw("CONCAT(users.firstname, ' ', users.lastname) AS student,mcqs.type as type, count(distinct mcqs_attempt.mcq_id) AS attempts, count(if(mcqs_answers.is_correct = 1, mcqs_answers.id, null)) as correct,mcqs_attempt.user_id"))
                                                ->join('users','users.id','=','mcqs_attempt.user_id')
                                                ->join('mcqs_answers','mcqs_answers.id','=','mcqs_attempt.mcq_answer_id')
                                                ->join('mcqs','mcqs.id','=','mcqs_attempt.mcq_id')
                                                ->groupBy('student','mcqs_attempt.user_id');
        if($request->get('student')){
            $results->where('users.firstname','like','%' . $request->get('student') . '%')
            ->orWhere('users.lastname','like','%' . $request->get('student') . '%');
        }
        if($request->get('type')){
            $results->where('mcqs.type',$request->get('type'));       
        }

        if ($sortRequest){
            $results->orderBy($sortRequest, $sortOrder);
        }else{
            $results = $results->orderBy('mcqs_attempt.user_id','desc');
        }
        $results = $results->paginate($record);
        $response = [
            'pagination' => [
                'total' => $results->total(),
                'per_page' => $results->perPage(),
                'current_page' => $results->currentPage(),
                'last_page' => $results->lastPage(),
                'from' => $results->firstItem(),
                'to' => $results->lastItem()
            ],
            'data' => $results
        ];
        
        return response()->json($response);
    }
    
    
    public function get_by_id(Request $request,$id)
    {   
        
        $summaryResult = $this->result::select(DB::raw("CONCAT(users.firstname, ' ', users.lastname) AS student,users.email, count(distinct mcqs_attempt.mcq_id) AS attempts, count(if(mcqs_answers.is_correct = 1, mcqs_answers.id, null)) as correct"))
                                                ->join('users','users.id','=','mcqs_attempt.user_id')
                                                ->join('mcqs_answers','mcqs_answers.id','=','mcqs_attempt.mcq_answer_id')
                                                
                                                ->where('mcqs_attempt.user_id',$id)
                                                ->groupBy('student','users.email')->first();
       
        $results = $this->result::select('*', DB::raw('mcqs.type as type,(CASE WHEN mcqs_answers.is_correct = 1 THEN mcqs_answers.id ELSE 0 END) AS correct_answer_id'))->with(['mcqs','mcqs_answers'])
        ->whereHas('mcqs' , function($q){
            $q->where('is_deleted',0);
        })
        ->join('mcqs','mcqs.id','=','mcqs_attempt.mcq_id')
        ->join('mcqs_answers','mcqs_answers.mcq_id','=','mcqs_attempt.mcq_id')
        ->where('user_id', $id)->get();
        if($request->type){
            $results = $results->where('type',$request->type);
        }
        $TMP_results    = [
            'name'  => $summaryResult->student ,
            'email' => $summaryResult->email,
            'total_attempts' => $summaryResult->attempts,
            'total_correct' => $summaryResult->correct
        ];
        foreach ($results as $key => $value) {
            if (!isset($TMP_results['data'][$value->mcq_id])) {
                $TMP_results['data'][$value->mcq_id] = [
                    'type'                 => $value->type,
                    'correct_answer_id'    => $value->is_correct ? $value->id : 0,
                    'attempt_answer_id'    => $value->mcq_answer_id,
                    'question'             => $value->mcqs->question,
                    'is_correct'           => $value->is_correct
                ];
            }
            if($value->correct_answer_id > 0){
                $TMP_results['data'][$value->mcq_id]['correct_answer_id'] = $value->correct_answer_id;
            }
            $TMP_results['data'][$value->mcq_id]['answers'][$value->id] = $value->answer;
        }
        return response()->json($TMP_results);
    }
}

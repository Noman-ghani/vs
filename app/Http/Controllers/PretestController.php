<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\Mcqs;
use App\Models\McqsAttempt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PretestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getQuestion(Request $request)
    {
        $user = Auth::user();
        $attempts = McqsAttempt::where('user_id', $user->id)->select(['mcq_id'])->get();
        $question = Mcqs::with('mcq_answers')->whereNotIn('id', $attempts)->where('type', 'pretest')->get();
        if (count($attempts) == 0) {
            Doctors::where('user_id', $user->id)->update(['pretest_started_at' => Carbon::now()]);
        }
        if (count($question) < 1) {
            Doctors::where('user_id', $user->id)->update(['has_taken_pretest' => 1, 'pretest_ended_at' => Carbon::now()]);
            $score = DB::select("SELECT COUNT(DISTINCT mcqs_attempt.mcq_id) questions_attempted,COUNT(DISTINCT IF (mcqs_answers.is_correct = 1,mcqs_attempt.mcq_id, NULL)) correct_answers FROM mcqs_attempt INNER JOIN mcqs_answers ON mcqs_answers.id = mcqs_attempt.mcq_answer_id WHERE 1 and mcqs_attempt.user_id = {$user->id}");

            return response()->json(['next' => false, 'score' => json_encode($score[0])]);
        }
        return response()->json(['next' => true, 'count' => count($attempts) + 1, 'question' => $question[0]], 200);
    }

    public function attempt(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mcq_id' => 'required',
            'mcq_answer_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $attempts = new McqsAttempt($request->all());
        $attempts->user_id = Auth::id();
        $attempts->save();

        return response()->json(['success' => true], 200);
    }

    public function correctAnswers(Request $request)
    {
        $correct_answers = Mcqs::with(['mcq_answers' => function ($q) {
            $q->where('is_correct', '=', 1);
        }])
        ->where('type', 'pretest')
        ->paginate($request->count);

        return response()->json($correct_answers, 200);
    }
}

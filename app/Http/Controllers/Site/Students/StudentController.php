<?php

namespace App\Http\Controllers\Site\Students;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quizz;
use App\Models\StudentAnswers;
use App\Models\Subject;
use App\Models\TryQuizz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    function index()
    {

        $user = Auth::user();

        $subjects =  $user->student->grade->subjects;

        return view('studets.index', compact('user', 'subjects'));
    }

    function subject($id)
    {

        $subject = Subject::query()->findOrFail($id);
        return view('studets.subject', compact('subject'));
    }

    function quizz($id)
    {

        $quizz = Quizz::query()->findOrFail($id);
        return view('studets.quizz', compact('quizz'));
    }

    function postquizz(Request $request)
    {
       // dd($request->all());
       $total = 0 ;
        foreach ($request->answers as $answer) {
            $q = Question::find($answer['question_id']);
            if ($q->type == 'msq') {
                $chech = false;
                if ($answer['selected_option'] == $q->correctAnswer->option_id) {
                    $chech = true;
                    $total += $q->grade ;
                }

                StudentAnswers::create([
                    'student_id' => Auth::user()->student->id,
                    'question_id' => $answer['question_id'],
                    'option_id' => $answer['selected_option'],
                    'check' => $chech
                ]);
            } else {
                $chech = false;

                if ($answer['selected_option'] == $q->correctAnswer->correct_value) {
                    $chech = true;
          $total += $q->grade ;

                }

                StudentAnswers::create([
                    'student_id' => Auth::user()->student->id,
                    'question_id' => $answer['question_id'],
                    'correct_value' => $answer['selected_option'],
                    'check' => $chech
                ]);
            }
        }


        TryQuizz::create([
            'student_id' => Auth::user()->student->id ,
            'quizz_id' =>  $request->quizz_id ,
             'grade' => $total
        ]);

        return redirect()->route('panel');
    }
}

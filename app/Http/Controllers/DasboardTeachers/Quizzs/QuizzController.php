<?php

namespace App\Http\Controllers\DasboardTeachers\Quizzs;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quizz;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class QuizzController extends Controller
{
    function index()
    {
        return view('dashboard.dashboard_teachers.quizzes.index');
    }

    function add(Request $request)
    {
      //  dd($request->all());
        $subject = Subject::query()->where('teacher_id', auth()->user()->id)->first();
        $qiuzz = Quizz::create([
            'title' => $request->title,
            'time' => $request->duration,
            'start' => $request->start_time,
            'end' => $request->end_time,
            'subject_id' => $subject->id,
        ]);

        foreach ($request->questions as $question) {
            // questions
            $q = $qiuzz->questions()->create([
                'text' => $question['text'],
                'type' => $question['type'],
                'grade' => $question['grade'],
            ]);

            if ($question['type'] === 'msq') {
                foreach ($question['options'] as $optionText) {
                    $q->options()->create([
                        'text' => $optionText,
                    ]);
                }
                $correctOptionIndex = $question['correct_option'] - 1;
                $correctOption = $q->options()->skip($correctOptionIndex)->first();

                if ($correctOption) {
                    $q->correctAnswer()->create([
                        'option_id' => $correctOption->id,
                        'correct_value' => null,
                    ]);
                }
            } elseif ($question['type'] === 'tf') {
                $q->correctAnswer()->create([
                    'option_id' => null,
                    'correct_value' => $question['correct_tf'],
                ]);
            }
        }


        return redirect()->back();

    }
}

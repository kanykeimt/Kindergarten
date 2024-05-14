<?php

namespace App\Services\Admin;

use App\Models\Question;
use App\Models\Resume;
use Illuminate\Support\Facades\Lang;

class ResumeService
{
    public function index()
    {
        $resumes = Resume::all();
        return view('admin.resume.index', compact('resumes'));
    }

    public function show(Resume $resume)
    {
        $lang = app()->getLocale();
        $questions = Question::all();
        foreach ($questions as $question) {
            $question->text = $lang == 'kg' ? $question->question_kg : $question->question_ru;
        }

        $answers = Resume::where('id', $resume->id)->pluck('answers')->values();
        $answers = json_decode($answers[0], true);

        return view('admin.resume.show', compact('resume', 'questions', 'answers'));
    }

    public function delete(Resume $resume)
    {
        $resume->delete();
        $message = Lang::get('lang.delete_answer_resume');
        return redirect()->route('admin.resume.index')->with('success', $message);
    }
}

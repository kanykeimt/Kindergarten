<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Question\CreateRequest;
use App\Http\Requests\Admin\Question\UpdateRequest;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class QuestionService
{
    public function getAllQuestions()
    {
        $questions = Question::all();
        return $questions;
    }
    public function create(CreateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Question::create([
            'question_kg' => $data['question_kg'],
            'question_ru' => $data['question_ru'],
        ]);


        return redirect()->route('admin.resume.question.index');
    }

    public function update(UpdateRequest $request, Question $question)
    {
        $data = $request->validated();
        DB::beginTransaction();
        $question->update([
            'question_kg' => $data['question_kg'],
            'question_ru' => $data['question_ru'],
        ]);
        DB::commit();
        $message = Lang::get('lang.update_question_successful');
        return redirect()->route('admin.resume.question.index')->with('success', $message);
    }

    public function delete(Question $question)
    {
        $question->delete();
        $message = Lang::get('lang.delete_answer_questions');
        return redirect()->route('admin.resume.question.index')->with('success', $message);
    }
}

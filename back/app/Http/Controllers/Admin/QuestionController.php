<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Question\CreateRequest;
use App\Http\Requests\Admin\Question\UpdateRequest;
use App\Http\Requests\UpdateResumeQuestionRequest;
use App\Models\Question;
use App\Services\Admin\QuestionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class QuestionController extends Controller
{
    private QuestionService $service;
    public function __construct()
    {
        $this->service = new QuestionService();
    }
    public function index()
    {
        $questions = $this->service->getAllQuestions();
        return view('admin.resume.question.index', compact('questions'));
    }

    public function create(CreateRequest $request):RedirectResponse
    {
        return $this->service->create($request);
    }

    public function edit(Question $question){
        return view('admin.resume.question.edit', compact('question'));
    }

    public function show(Question $question){
        return view('admin.resume.question.show', compact('question'));
    }

    public function update(UpdateRequest $request, Question $question)
    {
        return $this->service->update($request, $question);
    }

    public function delete(Question $question)
    {
        return $this->service->delete($question);
    }

}

<?php

namespace App\Services;

use App\Http\Requests\Vacancy\CreateRequest;
use App\Models\Answer;
use App\Models\Child;
use App\Models\Question;
use App\Models\Resume;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class VacancyService
{
    public function index()
    {
        $lang = app()->getLocale();
        $questions = Question::all();

        foreach ($questions as $question) {
            $question->text = $lang == 'kg' ? $question->question_kg : $question->question_ru;
        }
        if (auth()->user()->role != 4){
            $children = Child::where('parent_id', auth()->user()->id)->get();
            return view('vacancy', compact('children', 'questions'));
        }
        return view('vacancy', compact('questions'));
    }
    public function create(CreateRequest $request):RedirectResponse
    {
        $data = $request->validated();

        if (!Storage::exists('public/userResumes')) {
            Storage::makeDirectory('public/userResumes');
        }
        $file = null;
        if(array_key_exists('resume', $data)){
            $file = Storage::disk('public')->put('userResumes', $data['resume']);
            $file = "storage/".$file;
        }

        $questions = Question::all();

        $answers = [];
        foreach ($questions as $index => $question) {
            $answerKey = 'answer-' . $index;
            if ($request->has($answerKey)) {
                $answers[$question->id] = $request->input($answerKey);
            }
        }
        $answers = json_encode($answers);

        Resume::create([
            'full_name' => $data['full_name'],
            'phone_number' => $data['phone_number'],
            'resume' => $file,
            'answers' => $answers,
        ]);

        $message = "Success";
        return redirect()->route('index')->with('status', $message);
    }
}

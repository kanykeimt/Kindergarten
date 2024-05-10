<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vacancy\CreateRequest;
use App\Models\Answer;
use App\Models\Child;
use App\Models\Question;
use App\Models\Resume;
use App\Services\VacancyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VacancyController extends Controller
{
    private VacancyService $service;
    public function __construct()
    {
        $this->service = new VacancyService;
    }
    public function index(){
//        $questions = $this->service->getAllQuestions();
//        $user = auth()->user();
//        if($user){
//            if($user->role === 1 or $user->role === 2 or $user->role === 3){
//                $children = $this->service->children();
//                return view('vacancy', compact('children', 'questions'));
//            }
//            return view('vacancy', compact('questions'));
//        }
//        return view('vacancy', compact('questions'));
        return $this->service->index();
    }

    public function create(CreateRequest $request):RedirectResponse
    {
        return $this->service->create($request);
    }

}

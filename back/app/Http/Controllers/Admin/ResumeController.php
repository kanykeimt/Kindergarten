<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Resume;
use App\Services\Admin\ResumeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ResumeController extends Controller
{
    private ResumeService $service;
    public function __construct()
    {
        $this->service = new ResumeService;
    }

    public function index(){
        return $this->service->index();
    }

    public function show(Resume $resume){
        return $this->service->show($resume);
    }

    public function delete(Resume $resume){
        return $this->service->delete($resume);
    }
}

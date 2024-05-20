<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware children. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/user/updatePassword', [App\Http\Controllers\ResetPasswordController::class, 'updatePassword'])->name('update.password');

Route::post('/user/updatePassword', [App\Http\Controllers\ResetPasswordController::class, 'updatePassword'])->name('update.password');

Route::post('/admin/children/create', [App\Http\Controllers\Admin\ChildController::class, 'create'])->name('admin.children.create');

Route::post('/admin/resume/question/create', [App\Http\Controllers\Admin\QuestionController::class, 'create'])->name('admin.resume.question.create');

Route::post('/employee/children/create', [App\Http\Controllers\Employee\ChildrenController::class, 'create'])->name('employee.children.create');



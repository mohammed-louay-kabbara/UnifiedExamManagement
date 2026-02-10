<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\yearController;
use App\Http\Controllers\ExamCyclesController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\ExamsController;
use App\Http\Controllers\ProfessoryearController;
use App\Http\Controllers\examcentersController;
use App\Http\Controllers\ExamSchedulesController;
use App\Http\Controllers\ExamStudentCenterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [AuthController::class,'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::resource('student', StudentController::class);
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('/student', StudentController::class);
    Route::resource('Professoryear', ProfessoryearController::class);
    Route::resource('examcenters', examcentersController::class);
    Route::resource('Exams', ExamsController::class);
    Route::get('years_exam', [ExamsController::class,'years_exam'])->name('years_exam');
    Route::get('student/training/{year}', [QuestionsController::class, 'trainingQuestions'])
     ->name('student.training');
    Route::get('admin/questions', [QuestionsController::class,'show_admin'])
    ->name('admin.questions.show');
    Route::post('admin/exams/store-or-update', [ExamsController::class,'storeOrUpdate'])
    ->name('Exams.storeOrUpdate');
    Route::post('student/exam/submit', [ExamsController::class, 'submit'])
    ->name('student.exam.submit');
    Route::get('student_exam', [ExamsController::class,'exam_verify'])
    ->name('student.exam.verify');
    Route::resource('questions', QuestionsController::class);
    Route::resource('questions', QuestionsController::class);
     Route::get('question', [QuestionsController::class,'show_admin'])->name('questions.show_admin');
     Route::get('student_years', [StudentController::class,'student_years'])->name('student_years');
    Route::resource('ExamSchedules', ExamSchedulesController::class);
    Route::get('show_examcycles', [ExamSchedulesController::class,'show_examcycles'])->name('show_examcycles'); 
    Route::get('examcycle', [ExamSchedulesController::class,'examcycle'])->name('examcycle');
    Route::get('/profile_student', [StudentController::class, 'edit'])->name('profile_student');
    Route::get('/profile_Professor', [ProfessorController::class, 'edit'])->name('profile_Professor');
    Route::get('/professor_year', [ProfessorController::class,'year_show'])->name('professor_year');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/students', [StudentController::class, 'search'])
        ->name('students.search');
     Route::get('/report_view', [ExamsController::class, 'report_view'])->name('report_admin_view');
    Route::get('reports/show', [ExamsController::class,'index'])->name('report_admin_show');
    Route::get('/professor_search', [ProfessorController::class, 'search'])
        ->name('professor.search');
    Route::resource('/year', yearController::class);
    Route::resource('/exam_student_centers', ExamStudentCenterController::class);
    Route::resource('/professor', ProfessorController::class);
    Route::get('/examcycles.search', [ExamCyclesController::class, 'search'])->name('examcycles.search');
    Route::resource('/examcycles', ExamCyclesController::class);
        Route::get('/year_search', [yearController::class, 'search'])->name('year.search');
    Route::get('/students_forbidden', [StudentController::class, 'forbidden'])->name('students.forbidden');
    Route::get('/students_forbidden', [StudentController::class, 'forbidden'])->name('students.forbidden');
    Route::get('/students_year', [StudentController::class, 'year'])->name('students.year');
});

require __DIR__.'/auth.php';

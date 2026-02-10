<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\professor_year;
use App\Models\student_exams;
use App\Models\year;
use App\Models\exam_cycles;
use App\Models\User;
use App\Models\questions;
use App\Models\exam_centers;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
       $user= Auth::user();
     
        if ($user->role==1) {
              $students=User::where('role',3)->count();
              $professors=User::where('role',2)->count();
              $exam_cycles=exam_cycles::count();
             $exam_centers=exam_centers::count();
            return view('admin.dashboard',compact('students','professors','exam_cycles','exam_centers'));
        }
        
        elseif ($user->role==2) {
            $professor_id = Auth::id();
            $years = professor_year::with('year')->where('professor_id', $professor_id)->get();
            $years_count = $years->count();
            $questions=questions::where('professor_id',Auth::id())->count();
            return view('Professor.dashboard', compact('years','years_count','questions'));
        }
        else {
            $exams=student_exams::with('exam.exam_cycle')->where('student_id',Auth::id())->get();
            return view('student.home', compact('exams'));
        }
        
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}

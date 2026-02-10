<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\year;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{

    public function index()
    {
        $students=User::where('role',3)->get();
        return view('admin.students',compact('students'));
    }
    public function student_years(){
        $years=year::get();
        return view('student.years_questions',compact('years'));

    }

        public function edit()
    {
        $user=Auth::user();
        return view('student.editprofile',compact('user'));   
    }

    public function search(Request $request){
    $students = User::query();

    if ($request->filled('search')) {
        $students->where('name', 'like', '%' . $request->search . '%');
    }
    $students = $students->get();
    return view('admin.students', compact('students'));
    }
    
    public function forbidden()
    {
        $students=User::where('status','محظور')->get();
        return view('admin.students', compact('students'));
    }
    public function year(Request $request)
    {
        $students=User::whereYear('created_at', $request->year)->where('role',3)->get();
        return view('admin.students', compact('students'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

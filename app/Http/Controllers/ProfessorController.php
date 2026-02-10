<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\professor_year;
use App\Models\student_exams;
use App\Models\exam_cycles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class ProfessorController extends Controller
{

    public function index()
    {
      $professors= User::where('role',2)->get();
      return view('admin.professors',compact('professors'));
    }
    public function search(Request $request){
    $professors = User::where('role', 2);   
    if ($request->filled('search')) {
        $professors->where('name', 'like', '%' . $request->search . '%');
    }
    $professors = $professors->get();
    return view('admin.professors', compact('professors'));
    }

    public function year_show(){
        $years = professor_year::with('year')->where('professor_id', Auth::id())->get();
        return view('Professor.years', compact('years'));
    }


    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'unique:'.User::class],
            'password' => 'required',
            'phone' => 'required'
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 2
        ]);
        return back()->with('alert', 'تم الحفظ بنجاح');
        
    }
    


    public function show(string $id)
    {
        
    }


    public function edit()
    {
        $user=Auth::user();
        return view('Professor.editprofile',compact('user'));
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string'],
            'phone' => 'required'
        ]);
        
        $user=User::where('id',$id)->first();
        if ($request->newpassword) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->newpassword,
                'role' => 2
            ]); 
        }
        else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => 2
            ]); 
        }
        return back()->with('alert', 'تم التعديل بنجاح');
    }

    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return back()->with('alert', 'تم الحذف بنجاح');
    }
}

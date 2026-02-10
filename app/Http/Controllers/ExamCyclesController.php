<?php

namespace App\Http\Controllers;

use App\Models\exam_cycles;
use Illuminate\Http\Request;

class ExamCyclesController extends Controller
{

    public function index()
    {
        $exam_cycles=exam_cycles::get();
        return view('admin.exam_cycles',compact('exam_cycles'));
    }

    public function search(Request $request){
        $exam_cycles = exam_cycles::query();
        if ($request->filled('search')) {
            $exam_cycles->where('name', 'like', '%' . $request->search . '%');
        }
        $exam_cycles = $exam_cycles->get();
        return view('admin.exam_cycles', compact('exam_cycles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        exam_cycles::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return back()->with('alert', 'تم الحفظ بنجاح');
    }

    public function show(exam_cycles $exam_cycles)
    {
        //
    }

    public function edit(exam_cycles $exam_cycles)
    {
        //
    }


    public function update(Request $request,$id)
    {

        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        exam_cycles::where('id',$id)->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return back()->with('alert', 'تم التعديل بنجاح');
    }

public function destroy($id)
{
    $examCycle = exam_cycles::findOrFail($id);
    // إذا كانت الدورة لم تنتهِ بعد
    if ($examCycle->end_date > now()) {
        return back()->with('alert', 'لا يمكن حذف الدورة الامتحانية لأنها ما زالت نشطة');
    }
    // إذا كانت منتهية
    $examCycle->delete();
 
    return back()->with('alert', 'تم حذف الدورة الامتحانية بنجاح');
}
}

<?php

namespace App\Http\Controllers;

use App\Models\exam_schedules;
use App\Models\exam_cycles;
use App\Models\year;
use App\Models\exam_student_center;
use App\Models\exam_centers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamSchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $exam_schedules= exam_schedules::with(['examCycle'])->orderBy('exam_cycle_id')->get();
       $exam_cycles=exam_cycles::get();
       return view("admin.exam_schedules",compact('exam_schedules','exam_cycles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }
    public function show_examcycles(){
        $exam_schedules=exam_student_center::with(['exam_center','exam_schedule'])->where('student_id',auth()->id())->get();
        return view('student.ExamSchedules',compact('exam_schedules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_cycle_id' =>'required',
            'exam_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        exam_schedules::create([
            'exam_cycle_id'   => $request->exam_cycle_id,
            'exam_date'       => $request->exam_date,
            'start_time'      => $request->start_time,
            'end_time'        => $request->end_time,
            'code' => Str::random(5)
        ]);
        return back()->with('alert', 'تم الحفظ بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(exam_schedules $exam_schedules)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(exam_schedules $exam_schedules)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'exam_cycle_id' =>'required',
            'exam_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',

        ]);
        exam_schedules::where('id',$id)->update([
            'exam_cycle_id'   => $request->exam_cycle_id,
            'exam_date'       => $request->exam_date,
            'start_time'      => $request->start_time,
            'end_time'        => $request->end_time,
        ]);
        return back()->with('alert', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
           exam_schedules::where('id',$id)->delete();
           return back()->with('alert', 'تم الحذف بنجاح');
    }
}

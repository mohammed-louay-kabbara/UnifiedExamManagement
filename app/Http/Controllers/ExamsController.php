<?php

namespace App\Http\Controllers;

use App\Models\exams;
use App\Models\year;
use App\Models\exam_cycles;
use App\Models\exam_questions;
use App\Models\student_exams;
use App\Models\QuestionOption;
use App\Models\exam_schedules;
use App\Models\student_answers;
use Illuminate\Http\Request;

class ExamsController extends Controller
{

    public function index()
    {
        $exam_cycles=exam_cycles::get();
        $report_exam=null;
        return view('admin.report',compact('report_exam','exam_cycles')); 
    }
    

    public function report_view(Request $request){
        $exam_cycles = exam_cycles::get();
        $report_exam = collect(); 
        if ( $request->filled('exam_cycle_id')) {
            $report_exam = student_exams::with(['student'])
                ->whereHas('exam', function ($q) use ($request) {
                    $q->where('exam_cycle_id', $request->exam_cycle_id);})->get();
        }

        return view('admin.report', compact(
            'exam_cycles',
            'report_exam'
        ));
    }
public function submit(Request $request)
{
    $request->validate([
        'exam_id' => 'required',
        'answers' => 'required|array'
    ]);
    $exam = exams::findOrFail($request->exam_id);

    $score = 0;

    foreach ($request->answers as $question_id => $option_id) {

        $option = QuestionOption::findOrFail($option_id);
        $isCorrect = $option->is_correct;

        if ($isCorrect) {
            $score += $exam->question_mark;
        }
        student_answers::create([
            'student_id' => auth()->id(),
            'exam_id'    => $exam->id,
            'question_id'=> $question_id,
            'option_id'  => $option_id,
            'is_correct' => $isCorrect
        ]);
    }
    $score = round($score, 2);
    $is_submitted=false;
    if ($score>=60) {
        $is_submitted=true;
    }
    student_exams::create([
        'student_id'  => auth()->id(),
        'exam_id'     => $exam->id,
        'score'       => $score,
        'is_submitted'=> $is_submitted
    ]);

    return redirect()->route('dashboard')
        ->with('alert', 'تم تسليم الامتحان بنجاح، علامتك: ' . $score);
}

    public function exam_verify(Request $request){
        $exam_schedule = exam_schedules::findOrFail($request->exam_id);
        if ($request->exam_code != $exam_schedule->code) {
            return back()->with('alert', 'كلمة السر غير صحيحة');
        }
        $exam = exams::with(['questions.options'])
            ->where('exam_cycle_id', $exam_schedule->exam_cycle_id)
            ->firstOrFail();
        // منع الدخول أكثر من مرة
        $already = student_exams::where('student_id', auth()->id())
            ->where('exam_id', $exam->id)
            ->where('is_submitted', true)
            ->exists();

        if ($already) {
            return back()->with('alert', 'لقد قدمت هذا الامتحان مسبقًا');
        }

        return view('student.exam', compact('exam'));
    }

    public function years_exam(){
        $exam=exam_schedules::with('examCycle')->get();
        return view('student.years_exam',compact('exam'));
    }

    public function create()
    {
        //
    }
        public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'exam_cycle_id' => 'required',
            'question_ids'  => 'required|array|min:1',
        ]);
        $exam = exams::firstOrCreate([
            'exam_cycle_id' => $request->exam_cycle_id,
        ]);
        $exam->questions()->sync($request->question_ids);
        $questionsCount = count($request->question_ids);
        $exam->question_mark = 100 / $questionsCount;
        $exam->save();
        return back()->with('alert', 'تم حفظ / تعديل أسئلة الامتحان بنجاح');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
    }

    /**
     * Display the specified resource.
     */
    public function show(exams $exams)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(exams $exams)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, exams $exams)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(exams $exams)
    {
        //
    }
}

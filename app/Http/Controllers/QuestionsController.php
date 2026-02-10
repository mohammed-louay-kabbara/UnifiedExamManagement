<?php

namespace App\Http\Controllers;

use App\Models\questions;
use App\Models\exam_cycles;
use App\Models\exams;
use App\Models\QuestionOption;
use Illuminate\Http\Request;
use App\Models\year;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{

    public function index()
    {
    }

    public function create()
    {
       
    }

    public function show_admin(Request $request)
    {
        $exam_cycles = exam_cycles::all();
        $questions = questions::with(['professor'])->get();

        // الأسئلة المختارة مسبقًا (إن وجدت)
        $selectedQuestions = [];

        if ($request->exam_cycle_id) {
            $exam = exams::where('exam_cycle_id', $request->exam_cycle_id)->first();
            if ($exam) {
                $selectedQuestions = $exam->questions->pluck('id')->toArray();
            }
        }

        return view('admin.questions', compact(
            'questions',
            'exam_cycles',
            'selectedQuestions'
        ));
    }



    public function store(Request $request)
    {
        $type="text";
        $question=$request->question;
        if ($request->file('question_image')) {
            $type="image";
            $imagePath = $request->file('question_image')->store('images', 'public');
            $question= $imagePath;
        }
        $question = questions::create([
            'question' => $question,
            'type' => $type,
            'difficulty' => $request->difficulty,
            'year_id' => $request->year_id,
            'professor_id' => auth()->id(),
            'exam_cycle_id' => $request->exam_cycle_id,
        ]);
    

        foreach ($request->options as $index => $option) {
            if ($option) {
            $question->options()->create([
                'option_text' => $option,
                'is_correct' => ($index == $request->correct_option),
            ]);
            }

        }
        return back()->with('alert', 'تم الحفظ بنجاح');
    }
    public function trainingQuestions($year_id)
    {
        $questions = questions::with('options')->where('year_id', $year_id)->orderBy('difficulty')->get();
        return view('student.training_questions', compact('questions'));
    }

    public function show($id)
    {
        $year_id=$id;
        $exam_cycles=exam_cycles::get();
        $questions=questions::with(['exam_cycles','options'])->where('professor_id',Auth::id())->where('year_id',$year_id)->get();
        return view('Professor.questions',compact('questions','exam_cycles','year_id'));
    }


    public function edit(questions $questions)
    {
        //
    }



    public function update(Request $request, $id)
{
    $request->validate([
        'difficulty'      => 'required',
        'exam_cycle_id'   => 'required|exists:exam_cycles,id',
        'options'         => 'required|array|min:2',
        'correct_option'  => 'required|integer',
    ]);

    $question = questions::where('id', $id)
        ->where('professor_id', auth()->id())
        ->firstOrFail();

    // ===== معالجة السؤال (نص أو صورة) =====
    $type = $question->type;
    $content = $question->question;

    // إذا رفع صورة جديدة
    if ($request->hasFile('question_image')) {

        // حذف الصورة القديمة إن وجدت
        if ($question->type === 'image' && $question->question) {
            Storage::disk('public')->delete($question->question);
        }

        $content = $request->file('question_image')
            ->store('images', 'public');

        $type = 'image';

    } else {
        // تعديل نص فقط
        if ($question->type === 'text') {
            $request->validate([
                'question' => 'required|string'
            ]);

            $content = $request->question;
            $type = 'text';
        }
    }

    // تحديث السؤال
    $question->update([
        'question'       => $content,
        'type'           => $type,
        'difficulty'     => $request->difficulty,
        'exam_cycle_id'  => $request->exam_cycle_id,
    ]);

    // ===== تحديث الخيارات =====
    foreach ($request->options as $index => $text) {
        QuestionOption::where('id', $request->option_ids[$index])
            ->update([
                'option_text' => $text,
                'is_correct'  => ($index == $request->correct_option),
            ]);
    }

    return back()->with('alert', 'تم تعديل السؤال بنجاح');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $question= questions::where('id',$id)->first();
        if ($question->type === 'image') {
            Storage::disk('public')->delete($question->question);
        }
        $question->delete();
        return back()->with('alert', 'تم الحذف بنجاح');
    }
}

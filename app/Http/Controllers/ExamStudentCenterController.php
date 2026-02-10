<?php

namespace App\Http\Controllers;

use App\Models\exam_student_center;
use App\Models\student_exams;
use App\Models\User;
use App\Models\exam_centers;
use App\Models\exam_schedules;
use Illuminate\Http\Request;

class ExamStudentCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'exam_schedule_id' => 'required|exists:exam_schedules,id'
    ]);

    $schedule = exam_schedules::findOrFail($request->exam_schedule_id);

    // الطلاب الناجحون سابقًا
    $passedStudents = student_exams::where('is_submitted', true)
        ->where('score', '>=', 60)
        ->pluck('student_id');

    // جميع الطلاب غير الناجحين
    $students = User::where('role', 3)
        ->whereNotIn('id', $passedStudents)
        ->get();


    foreach ($students as $student) {

        // 🟢 جلب المراكز من نفس محافظة الطالب
        $centers = exam_centers::where('governorate', $student->governorate)
            ->get();

        if ($centers->isEmpty()) {
            continue; // لا يوجد مركز في محافظته
        }

        foreach ($centers as $center) {

            $currentCount = exam_student_center::where('exam_center_id', $center->id)
                ->where('exam_schedule_id', $schedule->id)
                ->count();

            // تحقق من السعة
            if ($currentCount < $center->amount) {

                // منع التكرار
                $exists = exam_student_center::where([
                    'student_id' => $student->id,
                    'exam_schedule_id' => $schedule->id
                ])->exists();

                if (!$exists) {
                    exam_student_center::create([
                        'student_id' => $student->id,
                        'exam_center_id' => $center->id,
                        'exam_schedule_id' => $schedule->id,
                    ]);
                }

                break; // انتقل للطالب التالي
            }
        }
    }

    return back()->with('alert', 'تم توزيع الطلاب على المراكز حسب المحافظة بنجاح');
}

    /**
     * Display the specified resource.
     */
    public function show(exam_student_center $exam_student_center)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(exam_student_center $exam_student_center)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, exam_student_center $exam_student_center)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(exam_student_center $exam_student_center)
    {
        //
    }
}

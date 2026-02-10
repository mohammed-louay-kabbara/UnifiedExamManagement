<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exam_student_center extends Model
{
    protected $fillable = [
        'student_id',
        'exam_center_id',
        'exam_schedule_id'
    ];
    public function student()
    {
        return $this->belongsTo(User::class);
    }
    public function exam_center()
    {
        return $this->belongsTo(exam_centers::class);
    }
        public function exam_schedule()
    {
        return $this->belongsTo(exam_schedules::class);
    }


}

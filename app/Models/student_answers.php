<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student_answers extends Model
{
    protected $table = 'student_answers';

    protected $fillable = [
        'student_id',
        'exam_id',
        'question_id',
        'option_id',
        'is_correct'
    ];


    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function exam()
    {
        return $this->belongsTo(exams::class, 'exam_id');
    }

    public function question()
    {
        return $this->belongsTo(questions::class, 'question_id');
    }

    public function option()
    {
        return $this->belongsTo(QuestionOption::class, 'option_id');
    }
}

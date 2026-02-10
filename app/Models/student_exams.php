<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student_exams extends Model
{
    protected $table = 'student_exams';

    protected $fillable = [
        'student_id',
        'exam_id',
        'score',
        'is_submitted',
    ];
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function exam()
    {
        return $this->belongsTo(exams::class, 'exam_id');
    }
}


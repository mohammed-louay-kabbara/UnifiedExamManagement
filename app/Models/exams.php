<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exams extends Model
{
    protected $table = 'exams';
    protected $fillable = [
        'exam_cycle_id',
        'question_mark'
    ];
    public function exam_cycle()
    {
        return $this->belongsTo(exam_cycles::class);
    }
    public function questions()
    {
        return $this->belongsToMany(
            questions::class,
            'exam_questions',
            'exam_id',      // اسم العمود الصحيح
            'question_id'   // اسم العمود الصحيح
        );
    }
}

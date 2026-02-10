<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class questions extends Model
{
      protected $fillable = [
        'question',
        'type',
        'difficulty',
        'year_id',
        'professor_id',
        'exam_cycle_id',
    ];
    public function options()
    {
        return $this->hasMany(QuestionOption::class,'question_id');
    }
    public function year()
    {
        return $this->belongsTo(year::class);
    }
    public function exam_cycles()
    {
        return $this->belongsTo(exam_cycles::class, 'exam_cycle_id');
    }
    public function professor()
    {
        return $this->belongsTo(User::class,'professor_id');
    }
}

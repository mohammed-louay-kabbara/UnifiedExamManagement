<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class exam_questions extends Model
{
    use HasFactory;
    protected $table = 'exam_questions';
    protected $fillable = [
        'exam_id',
        'question_id',
    ];
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function questions()
    {
        return $this->belongsTo(questions::class);
    }
}

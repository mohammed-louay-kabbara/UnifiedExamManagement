<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exam_schedules extends Model
{
    protected $table = 'exam_schedules';

    protected $fillable = [
        'exam_cycle_id',
        'exam_date',
        'start_time',
        'end_time',
        'code'
    ];


    public function examCycle()
    {
        return $this->belongsTo(exam_cycles::class, 'exam_cycle_id');
    }

}

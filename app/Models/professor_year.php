<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class professor_year extends Model
{
    protected $fillable = [
        'exam_cycle_id',
        'professor_id',
        'year_id',
    ];
        public function year()
    {
        return $this->belongsTo(year::class, 'year_id');
    }
}

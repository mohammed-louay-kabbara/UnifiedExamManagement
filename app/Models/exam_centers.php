<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exam_centers extends Model
{
    protected $fillable = [
        'name',
        'location',
        'governorate',
        'amount'
    ];
    public function students()
    {
        return $this->hasMany(exam_student_centers::class, 'exam_center_id');
    }
}

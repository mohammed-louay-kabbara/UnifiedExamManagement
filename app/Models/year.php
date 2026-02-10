<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class year extends Model
{
    protected $fillable = [
        'name',
    ];
    public function professors()
    {
        return $this->belongsToMany(
            User::class,
            'professor_years',
            'year_id',
            'user_id'
        )->withTimestamps();
    }
    
}

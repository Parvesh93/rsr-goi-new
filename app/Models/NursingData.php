<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NursingData extends Model
{
    protected $table = 'nursing_data';

    protected $fillable = [
        'student_id',
        'year',
        'marksheet',
        'admit_card',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}

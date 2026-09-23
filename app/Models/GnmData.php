<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GnmData extends Model
{
    protected $table = 'gnm_data';

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCompletion extends Model
{
    protected $fillable = [
        'type',
        'student_id',
        'registration_no',
        'serial_no',
        'batch_id',
        'program_id',
        'session_id',
        'name',
        'father_name',
        'mother_name',
        'date',
        'course_start_date',
        'course_end_date',
        'relieving_date',
        'college_name',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'course_start_date' => 'date',
        'course_end_date' => 'date',
        'relieving_date' => 'date',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}

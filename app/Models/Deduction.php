<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'utr_no', 'deduction_amount','deduction_date', 'deduction_name',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refrence extends Model
{
    
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'utr_no', 'ref_amount','ref_date', 'ref_name',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}

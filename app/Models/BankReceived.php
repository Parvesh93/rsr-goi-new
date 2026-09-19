<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankReceived extends Model
{
    
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'utr_no', 'bank_amount','bank_date', 'bank_name',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}

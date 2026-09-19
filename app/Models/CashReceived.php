<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashReceived extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'utr_no', 'cash_amount','cash_date', 'cash_name',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}

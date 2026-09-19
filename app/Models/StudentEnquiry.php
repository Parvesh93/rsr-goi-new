<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentEnquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'contact',
        'course',
        'state',
        'here_me',
        'refrence_persion',
        'address',
        'enquiry_date',
        'status',
    ];

    protected $casts = [
        'enquiry_date' => 'date',
        'status' => 'integer',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'course', 'id');
    }
}

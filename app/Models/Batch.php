<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'start_date', 'status',
    ];

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'batch_program', 'batch_id', 'program_id');
    }

     public function department()
    {
        return $this->belongsTo(CollegeDepartment::class, 'department_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'batch_id', 'id');
    }
    
     public function oldStudents()
    {
        return $this->hasMany(OldStudent::class, 'batch_id', 'id');
    }
}

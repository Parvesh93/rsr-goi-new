<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GraduationSemester extends Model
{
    protected $fillable = ['user_id', 'semester', 'attach'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

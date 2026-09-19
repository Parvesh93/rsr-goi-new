<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterClc extends Model
{
      protected $fillable = [
        'student_id', 'registration_no', 'serial_no','program_id', 'session_id', 'name', 'father_name', 'mother_name', 'date'
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

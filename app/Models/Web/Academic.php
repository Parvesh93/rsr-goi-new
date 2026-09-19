<?php

namespace App\Models\Web;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'language_id', 'title', 'slug', 'faculty', 'semesters', 'credits', 'courses', 'duration', 'fee', 'description', 'attach', 'status',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}

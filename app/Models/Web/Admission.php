<?php

namespace App\Models\Web;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    

    use HasFactory;

    protected $fillable = [
        'language_id', 'title', 'slug',  'duration', 'fee', 'description', 'attach', 'status',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}

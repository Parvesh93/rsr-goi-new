<?php

namespace App\Models\Web;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id', 'title','section', 'description', 'attach', 'status',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}

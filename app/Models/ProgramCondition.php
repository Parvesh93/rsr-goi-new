<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramCondition extends Model
{
    protected $fillable = [
        'ba_id',
        'b_com_id',
        'bsc_id',
        'bsc_nursing_id',
        'gnm_id',
        'anm_id',
        'status',
    ];
}

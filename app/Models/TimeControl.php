<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeControl extends Model
{
    protected $table = 'time_controls';

    protected $fillable = [
        'schedule_time',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class main_control extends Model
{
    protected $table = 'main_controls';

    protected $fillable = [
        'debit_max_organik',
        'debit_max_anorganik',
        'delay_pengambilan',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jadwal_pengambilan extends Model
{
    protected $table = 'jadwal_pengambilans';

    protected $fillable = [
        'waktu_pengambilan',
        'status',
    ];
}

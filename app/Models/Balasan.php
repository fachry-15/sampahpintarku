<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balasan extends Model
{
    protected $fillable = [
        'pesan_id',
        'user_id',
        'isi',
        'lampiran',
    ];

    public function pesan()
    {
        return $this->belongsTo(Pesan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

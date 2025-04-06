<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'isi',
        'lampiran',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function balasan()
    {
        return $this->hasMany(Balasan::class, 'pesan_id');
    }
}

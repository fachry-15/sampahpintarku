<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    protected $table = 'histories';

    protected $fillable = [
        'user_id',
        'debit_organik',
        'debit_anorganik',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

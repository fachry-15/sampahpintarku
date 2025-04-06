<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationsUser extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'province',
        'city',
        'district',
        'sub_district',
        'village',
        'postal_code',
        'phone_number',
        'longitude',
        'latitude',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

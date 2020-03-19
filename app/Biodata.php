<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'riwayat' => 'array'
    ];
}

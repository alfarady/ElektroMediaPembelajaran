<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $guarded = ['id'];
    
    protected $casts = [
        'indikator' => 'array',
    ];

    public function soal()
    {
        return $this->hasMany(Soal::class);
    }
}

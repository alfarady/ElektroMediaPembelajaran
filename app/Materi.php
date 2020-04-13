<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materi extends Model
{
    use SoftDeletes;
    
    protected $guarded = ['id'];
    
    protected $casts = [
        'indikator' => 'array',
    ];

    public function soal()
    {
        return $this->hasMany(Soal::class);
    }
}

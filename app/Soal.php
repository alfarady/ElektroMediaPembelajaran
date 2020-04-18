<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Soal extends Model
{
    use SoftDeletes;
    
    protected $guarded = ['id'];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    public function pilihan()
    {
        return $this->hasMany(Pilihan::class);
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class);
    }
}

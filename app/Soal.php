<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deputy extends Model
{
    protected $guarded = ['id'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    public function deputy()
    {
        return $this->belongsTo(Deputy::class);
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}

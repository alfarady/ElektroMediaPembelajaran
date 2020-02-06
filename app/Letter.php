<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $guarded = ['id'];
    
    public function deputy()
    {
        return $this->belongsTo(Deputy::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

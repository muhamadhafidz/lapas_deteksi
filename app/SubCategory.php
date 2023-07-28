<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $guarded = ['id'];
    
    public function instrument()
    {
        return $this->hasMany(Instrument::class, 'sub_category_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'category_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];
    
    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}

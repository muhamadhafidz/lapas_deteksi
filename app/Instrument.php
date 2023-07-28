<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    protected $guarded = ['id'];

    public function subCategory()
    {
        return $this->hasOne(SubCategory::class, 'sub_category_id');
    }
}

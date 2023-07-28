<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryAnswer extends Model
{
    protected $guarded = ['id'];

    public function sub_category_answers()
    {
        return $this->hasMany(SubCategoryAnswer::class, 'category_answer_id');
    }
}

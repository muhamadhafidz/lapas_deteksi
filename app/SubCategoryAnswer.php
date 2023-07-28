<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategoryAnswer extends Model
{
    protected $guarded = ['id'];

    public function instrument_answer_result()
    {
        return $this->hasOne(InstrumentAnswerResult::class, 'sub_category_answer_id');
    }

    public function instrument_answer()
    {
        return $this->hasMany(InstrumentAnswer::class, 'sub_category_answer_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstrumentData extends Model
{
    protected $guarded = ['id'];

    public function sub_category_answers()
    {
        return $this->hasMany(SubCategoryAnswer::class, 'instrument_data_id');
    }

    public function category_answers()
    {
        return $this->hasMany(CategoryAnswer::class, 'instrument_data_id');
    }

    public function upt()
    {
        return $this->belongsTo(Upt::class, 'upt_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstrumentAnswer extends Model
{
    protected $guarded = ['id'];

    public function instrument_result()
    {
        return $this->hasOne(InstrumentAnswerResult::class, 'instrument_answer_id');
    }
}

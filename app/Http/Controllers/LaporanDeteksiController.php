<?php

namespace App\Http\Controllers;

use App\InstrumentAnswer;
use App\InstrumentAnswerResult;
use App\InstrumentData;
use Illuminate\Http\Request;

class LaporanDeteksiController extends Controller
{
    public function index()
    {
        $data = InstrumentData::all();
        $tsc = 0;
        foreach ($data as $insData) {
            foreach($insData->sub_category_answers as  $subCatAns){
                $tsc += $subCatAns->instrument_answer_result->tsc;
            }
            $insData->bobot_total = $tsc;
        }
        return view('admin.pages.laporan-deteksi.index', compact('data'));
    }
}

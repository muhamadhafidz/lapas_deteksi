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
        $nowMonth = date('m');
        $year = date('Y');
        $twoYearAgo = $year - 2;
        $data = InstrumentData::where('year', $year)->orderBy('quartal', 'desc')
            ->get();

        $kuartal = $data->first()->quartal;
        $tsc = 0;
        foreach ($data as $insData) {
            foreach($insData->sub_category_answers as  $subCatAns){
                $tsc += $subCatAns->instrument_answer_result->tsc;
            }
            $insData->bobot_total = $tsc;
        }

        $nowMonthString = date('F');

        return view('admin.pages.laporan-deteksi.index', compact('data', 'kuartal', 'year', 'twoYearAgo'));
    }
}

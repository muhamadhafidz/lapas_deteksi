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

        if ($nowMonth >= 1 && $nowMonth <= 3) {
            $kuartal = 1;
        }else if ($nowMonth >= 4 && $nowMonth <= 6) {
            $kuartal = 2;
        }else if ($nowMonth >= 7 && $nowMonth <= 9) {
            $kuartal = 3;
        }else if ($nowMonth >= 10 && $nowMonth <= 12) {
            $kuartal = 4;
        }

        $data = InstrumentData::where('year', $year)->where('quartal', $kuartal)->orderBy('quartal', 'desc')
        ->get();

        foreach ($data as $insData) {
            $tsc = 0;
            foreach($insData->sub_category_answers as  $subCatAns){
                $tsc += $subCatAns->instrument_answer_result->tsc;
            }
            $insData->bobot_total = $tsc;
        }

        $nowMonthString = date('F');

        return view('admin.pages.laporan-deteksi.index', compact('data', 'kuartal', 'year', 'twoYearAgo'));
    }
}

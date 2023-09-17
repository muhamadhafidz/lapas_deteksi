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
        $nowYear = date('Y');
        $twoYearAgo = $nowYear - 2;
        
        $data = InstrumentData::where('created_at', '>=', $twoYearAgo.'-'.$nowMonth.'-01 00:00:00')
            ->where('created_at', '<=', $nowYear.'-'.$nowMonth.'-31 23:59:59')
            ->get();
        $tsc = 0;
        foreach ($data as $insData) {
            foreach($insData->sub_category_answers as  $subCatAns){
                $tsc += $subCatAns->instrument_answer_result->tsc;
            }
            $insData->bobot_total = $tsc;
        }

        $nowMonthString = date('F');

        return view('admin.pages.laporan-deteksi.index', compact('data', 'nowMonthString', 'nowYear', 'twoYearAgo'));
    }
}

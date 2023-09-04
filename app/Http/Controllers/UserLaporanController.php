<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\InstrumentData;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserLaporanController extends Controller
{
    public function index()
    {
        $insData = InstrumentData::get();

        foreach ($insData as $ins) {
            $tsc = 0;
            foreach($ins->sub_category_answers as  $subCatAns){
                $tsc += $subCatAns->instrument_answer_result->tsc;
            }
            $ins->bobot_total = $tsc;
        }
        return view('admin.pages.laporan-user.index', compact('insData'));
    }

    public function detail($id)
    {
        $insData = InstrumentData::findOrFail($id);

        $tsc = 0;
        foreach($insData->sub_category_answers as  $subCatAns){
            $tsc += $subCatAns->instrument_answer_result->tsc;
        }
        $insData->bobot_total = $tsc;

        return view('admin.pages.laporan-user.detail', compact('insData'));
    }

    public function export($id)
    {
        $data = InstrumentData::findOrFail($id);

        $tsc = 0;
        foreach($data->sub_category_answers as  $subCatAns){
            $tsc += $subCatAns->instrument_answer_result->tsc;
        }
        $data->bobot_total = $tsc;

        return Excel::download(new LaporanExport($data), 'report-upt.xlsx');
    }
}

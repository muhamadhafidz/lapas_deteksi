<?php

namespace App\Http\Controllers;

use App\InstrumentData;
use Illuminate\Http\Request;

class PetaKerawananController extends Controller
{
    public function index()
    {
        $nowMonth = date('m');
        $year = date('Y');
        $twoYearAgo = $year - 2;
        
        $data = InstrumentData::where('year', $year)->orderBy('quartal', 'desc')
            ->get();

            $kuartal = $data->first()->quartal;

        $nowMonthString = date('F');

        $tsc = 0;
        $merahArry = '';
        $orangeArry = '';
        $kuningArry = '';
        $hijauArry = '';

        $merah = 0;
        $orange = 0;
        $kuning = 0;
        $hijau = 0;

        $upt = '';
        foreach ($data as $insData) {
            foreach($insData->sub_category_answers as  $subCatAns){
                $tsc += $subCatAns->instrument_answer_result->tsc;
            }
            $totalPet = number_format(($tsc / $insData->sub_category_answers->sum('nilai_bobot_ideal')), 2);
            if (((1-$totalPet) * 100) >= 51 && ((1-$totalPet) * 100) < 100) {
                $merah += (1-$totalPet) * 100;
                $merahArry .= (1-$totalPet) * 100 . ' ';
            }else {
                $merahArry .= '0 ';
            }

            if (((1-$totalPet) * 100) >= 34 && ((1-$totalPet) * 100) < 51) {
                $orange += (1-$totalPet) * 100;
                $orangeArry .= (1-$totalPet) * 100 . ' ';
            }else {
                $orangeArry .= '0 ';
            }

            if (((1-$totalPet) * 100) >= 17 && ((1-$totalPet) * 100) < 34) {
                $kuning += (1-$totalPet) * 100;
                $kuningArry .= (1-$totalPet) * 100 . ' ';
            }else {
                $kuningArry .= '0 ';
            }

            if (((1-$totalPet) * 100) >= 0 && ((1-$totalPet) * 100) < 17) {
                $hijau += (1-$totalPet) * 100;
                $hijauArry .= (1-$totalPet) * 100 . ' ';
            }else {
                $hijauArry .= '0 ';
            }

            $upt .= $insData->upt->user->name. ' ';
        }
        return view('admin.pages.peta-kerawanan.index', compact('merahArry', 'orangeArry', 'kuningArry', 'hijauArry', 'merah', 'orange', 'kuning', 'hijau', 'upt', 'kuartal', 'year', 'twoYearAgo'));
    }
}

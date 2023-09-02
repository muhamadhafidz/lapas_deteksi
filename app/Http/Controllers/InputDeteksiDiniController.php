<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryAnswer;
use App\Instrument;
use App\InstrumentAnswer;
use App\InstrumentAnswerResult;
use App\InstrumentData;
use App\SubCategory;
use App\SubCategoryAnswer;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InputDeteksiDiniController extends Controller
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
        return view('admin.pages.input-deteksi-dini.index', compact('insData'));
    }

    public function create()
    {
        $cat = Category::get();

        $subCat = SubCategory::get();

        return view('admin.pages.input-deteksi-dini.create', compact('cat', 'subCat'));
    }
    
    public function detail($id)
    {
        $insData = InstrumentData::findOrFail($id);

        $tsc = 0;
        foreach($insData->sub_category_answers as  $subCatAns){
            $tsc += $subCatAns->instrument_answer_result->tsc;
        }
        $insData->bobot_total = $tsc;

        return view('admin.pages.input-deteksi-dini.detail', compact('insData'));
    }

    public function store(Request $request)
    {
        $item = $request->validate([
            'id.*'    => 'required',
            'bobot.*' => 'required'
        ]);

        $month = date('n');
        $year = date('Y');

        $quartal = 0;
        if ($month >= 1 && $month <= 3) {
            $quartal =  1;
        }else if( $month >= 4 && $month <= 6) {
            $quartal = 2;
        }else if ($month >= 7 && $month <= 9) {
            $quartal = 3;
        }else {
            $quartal = 4;
        }
        
        $data = InstrumentData::where('quartal', $quartal)->where('year', $year)->first();

        if ($data) {
            Alert::toast('Kamu telah membuat deteksi dini pada kuartal ini');

            return redirect()->route('user.input-deteksi-dini.index');
        }

        $instData = InstrumentData::create([
            'upt_id' => auth()->user()->upt->id,
            'year' => $year,
            'quartal' => $quartal 
        ]);
        $cat = Category::get();

        foreach($cat as $ct) {

            $catAns = CategoryAnswer::create([
                'instrument_data_id' => $instData->id,
                'name' => $ct->name
            ]);

            
            foreach ($ct->sub_categories as $subCt) {
                $res = InstrumentAnswerResult::create([
                    'category_answer_id' => $catAns->id,
                    'tsc' => 0,
                    'nilai_bobot' => 0
                ]);

                $subCatAns = SubCategoryAnswer::create([
                    'category_answer_id' => $catAns->id,
                    'name' => $subCt->name,
                    'nilai_bobot_ideal' => $subCt->nilai_bobot_ideal,
                ]);

                $tsc = 0;
                foreach ($subCt->instrument as $inst) {
                    InstrumentAnswer::create([
                        'instrument_data_id'      => $instData->id,
                        'element_assessment'      => $inst->element_assessment,
                        'deskripsi'               => $inst->deskripsi,
                        'sub_category_answer_id'  => $subCatAns->id,
                        'is_absolute'             => $inst->is_absolute,
                        'bobot'                   => $item['bobot'][$inst->id]
                    ]);

                    $tsc += $item['bobot'][$inst->id];
                }
                $nilai_bobot = $subCt->nilai_bobot_ideal - $tsc;

                $res->tsc = $tsc;
                $res->nilai_bobot = $nilai_bobot;
                $res->save();

            }
        }



        return redirect()->route('user.input-deteksi-dini.index');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'element_assessment' => 'required',
            'deskripsi'          => 'required',
            'sub_category_id'    => 'required',
            'is_absolute'        => 'required'
        ]);

        $inst = Instrument::findOrFail($id);
        $inst->update($data);
        
        return redirect()->route('admin.master-instrument.index');
    }

    public function delete($id)
    {
        $inst = Instrument::findOrFail($id);
        $inst->delete();

        return redirect()->route('admin.master-instrument.index');
    }
}

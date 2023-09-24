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
        $uptId = auth()->user()->upt->id;
        $insData = InstrumentData::where('upt_id', $uptId)->get();

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
            'bobot.*' => 'required',
            'quartal' => 'required',
            'year'    => 'required'
        ]);

        $uptId = auth()->user()->upt->id;

        $year = $item['year'];

        $quartal = $item['quartal'];
        
        $data = InstrumentData::where('quartal', $quartal)->where('year', $year)->where('upt_id', $uptId)->first();

        if ($data) {
            Alert::toast('Kamu telah membuat deteksi dini pada kuartal ini');

            return redirect()->route('user.input-deteksi-dini.index');
        }

        // dd("aw");
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
                
                $subCatAns = SubCategoryAnswer::create([
                    'instrument_data_id' => $instData->id,
                    'category_answer_id' => $catAns->id,
                    'name' => $subCt->name,
                    'nilai_bobot_ideal' => $subCt->nilai_bobot_ideal,
                ]);

                $res = InstrumentAnswerResult::create([
                    'sub_category_answer_id' => $subCatAns->id,
                    'tsc' => 0,
                    'nilai_bobot' => 0
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
        
        return redirect()->route('user.input-deteksi-dini.index');
    }

    public function delete($id)
    {
        $inst = InstrumentData::findOrFail($id);
        $inst->delete();

        return redirect()->route('user.input-deteksi-dini.index');
    }
}

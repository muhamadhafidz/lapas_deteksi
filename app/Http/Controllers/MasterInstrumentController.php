<?php

namespace App\Http\Controllers;

use App\Category;
use App\Instrument;
use App\SubCategory;
use Illuminate\Http\Request;

class MasterInstrumentController extends Controller
{
    public function index()
    {
        $cat = Category::get();

        $subCat = SubCategory::get();

        return view('admin.pages.master-instrument.index', compact('cat', 'subCat'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'element_assessment' => 'required|max:255',
            'deskripsi'          => '',
            'sub_category_id'    => 'required|max:255',
            'is_absolute'        => 'required|max:255'
        ]);

        Instrument::create($data);

        $totalSubCat = Instrument::where('sub_category_id', $request->sub_category_id)->count();

        SubCategory::where('id', $request->sub_category_id)->update([
            'nilai_bobot_ideal' => $totalSubCat * 2
        ]);
        return redirect()->route('admin.master-instrument.index');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'element_assessment' => 'required|max:255',
            'deskripsi'          => '',
            'sub_category_id'    => 'required|max:255',
            'is_absolute'        => 'required|max:255'
        ]);

        $inst = Instrument::findOrFail($id);
        $oldSubCat = $inst->sub_category_id;
        $inst->update($data);
        
        $totalSubCat = Instrument::where('sub_category_id', $request->sub_category_id)->count();
        SubCategory::where('id', $request->sub_category_id)->update([
            'nilai_bobot_ideal' => $totalSubCat * 2
        ]);
        
        $totalSubCat = Instrument::where('sub_category_id', $oldSubCat)->count();
        SubCategory::where('id', $oldSubCat)->update([
            'nilai_bobot_ideal' => $totalSubCat * 2
        ]);

        return redirect()->route('admin.master-instrument.index');
    }

    public function delete($id)
    {
        $inst = Instrument::findOrFail($id);
        $oldSubCat = $inst->sub_category_id;
        $inst->delete();

        $totalSubCat = Instrument::where('sub_category_id', $oldSubCat)->count();
        SubCategory::where('id', $oldSubCat)->update([
            'nilai_bobot_ideal' => $totalSubCat * 2
        ]);

        return redirect()->route('admin.master-instrument.index');
    }
}

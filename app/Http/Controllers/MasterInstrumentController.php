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
            'element_assessment' => 'required',
            'deskripsi'          => 'required',
            'sub_category_id'    => 'required',
            'is_absolute'        => 'required'
        ]);

        Instrument::create($data);


        return redirect()->route('admin.master-instrument.index');
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

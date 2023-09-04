<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class LaporanExport implements FromView
{

    protected $datas;

    public function __construct($datas)
    {
        $this->datas = $datas;
    }


    public function view(): View
    {
        return view('admin.pages.laporan-user.export', [
            'insData' => $this->datas
        ]);
    }

}

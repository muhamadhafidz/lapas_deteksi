<?php

use App\ProfilYayasan as AppProfilYayasan;
use Illuminate\Database\Seeder;

class ProfilYayasan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppProfilYayasan::create([
            'logo_pic' => '',
            'nama_yayasan' => 'test',
            'sejarah' => 'aw',
            'visi' => 'iw',
            'misi' => 'ew',
            'struktur_organisasi' => '',
            'nomor_rekening' => '24434',
            'foto' => '24434',
        ]);
    }
}

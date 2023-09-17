

<table class="table table-bordered display nowrap"  id="crudTable" style="width: 100%">
    <thead>
        <tr>

            <th>No</th>
            <th>Element Assessment</th>
            <th>Deskripsi</th>
            <th>Nilai Bobot Ideal</th>
            <th>Bobot</th>
            <th>TSC</th>
            <th>Nilai Bobot Potensi Gangguan Keamanan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($insData->category_answers as $ct)
            <tr class="font-weight-bold" style="background-color: grey">
                <td></td>
                <td colspan="6" style="font-size: 11px; color: white;">{{ $loop->iteration }} {{ $ct->name }}</td>
            </tr>
                @foreach ($ct->sub_category_answers as $sub)
                <tr class="font-weight-bold" style="background-color: rgb(195, 195, 195)">
                    <td></td>
                    <td colspan="6" style="font-size: 11px;">{{ $sub->name }}</td>
                </tr>
                    @forelse ($sub->instrument_answer as $item)
                    <tr>
                        <td class="align-middle text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->element_assessment }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        @if ($loop->index <= 0)
                        <td class="align-middle text-center" rowspan="{{ $sub->instrument_answer->count() }}">{{ $sub->nilai_bobot_ideal }}</td>
                        @endif
                        <td>{{ $item->bobot }}</td>
                        @if ($loop->index <= 0)
                        <td class="align-middle text-center" rowspan="{{ $sub->instrument_answer->count() }}">{{ $sub->instrument_answer_result->tsc }}</td>
                        <td class="align-middle text-center" rowspan="{{ $sub->instrument_answer->count() }}">{{ $sub->instrument_answer_result->nilai_bobot }}</td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td class="align-middle text-center" colspan="7">Tidak ada instrument data</td>
                    </tr>
                    @endforelse
                @endforeach
        @endforeach
        <tr>
            <td></td>
            <td colspan="2">Total</td>
            <td >{{ $insData->sub_category_answers->sum('nilai_bobot_ideal') }}</td>
            <td colspan="2">{{ $insData->bobot_total }}</td>
            <td >{{ $insData->sub_category_answers->sum('nilai_bobot_ideal') - $insData->bobot_total }}</td>
        </tr>
        

    <tr>
        <td>
            <b>
                Persentase untuk petugas
            </b>
        </td>
        <td>
            <b>
                '= Total TSC / Total Nilai Bobot Ideal'
            </b>
        </td>
    </tr>
    <tr>
        <td>
        </td>
        <td>
            @php
                $totalPet = number_format(($insData->bobot_total / $insData->sub_category_answers->sum('nilai_bobot_ideal')), 2)
            @endphp
            <b>
                '= {{ $totalPet }} ({{ $totalPet * 100 }})%'
            </b>
        </td>
    </tr>
        <tr>
            <td>Kecenderungan Pemahaman Petugas terhadap Tupoksi Pemasyarakatan</td>
            <td>Range</td>
            <td>Persentase</td>
        </tr>
        <tr>
            <td>Petugas tidak sepenuhnya mengenali prosedur dan regulasi pemasyarakatan</td>
            <td>{{ '0 <= x < 25' }}</td>
            <td>
                @if (($totalPet * 100) >= 0 && ($totalPet * 100) < 25)
                    {{ ($totalPet * 100) }}%
                @endif
            </td>
        </tr>
        <tr>
            <td>Petugas memahami Proses Pemasyarakatan</td>
            <td>{{ '25 <= x < 50' }}</td>
            <td>
                @if (($totalPet * 100) >= 25 && ($totalPet * 100) < 50)
                    {{ ($totalPet * 100) }}%
                @endif
            </td>
        </tr>
        <tr>
            <td>Petugas menjalankan tupoksi secara konsisten</td>
            <td>{{ '50 <= x < 75' }}</td>
            <td>
                @if (($totalPet * 100) >= 50 && ($totalPet * 100) < 75)
                    {{ ($totalPet * 100) }}%
                @endif
            </td>
        </tr>
        <tr>
            <td>Mampu mengatasi Permasalahan di bidang Pemasyarakatan ( memiliki deteksi dini )</td>
            <td>{{ '75 <= x < 100' }}</td>
            <td>
                @if (($totalPet * 100) >= 75 && ($totalPet * 100) < 100)
                    {{ ($totalPet * 100) }}%
                @endif
            </td>
        </tr>
    <tr>
        <td>
            <b>
                Presentase untuk narapidana/tahanan
            </b>
        </td>
        <td>
            <b>
                '= 100% - (Total TSC / Total Nilai Bobot Ideal)'
            </b>
        </td>
    </tr>
    <tr>
        <td>
        </td>
        <td>
            @php
                $totalPet = number_format(($insData->bobot_total / $insData->sub_category_answers->sum('nilai_bobot_ideal')), 2)
            @endphp
            <b>
                '= {{ 1-$totalPet }} ({{(1- $totalPet) * 100 }})%'
            </b>
        </td>
    </tr>

        <tr>
            <td>Kecenderungan Pemahaman Petugas terhadap Tupoksi Pemasyarakatan</td>
            <td>Range</td>
            <td>Persentase</td>
        </tr>
    
        <tr>
            <td>Ko operatif</td>
            <td>{{ '0 <= x < 17' }}</td>
            <td>
                @if (((1-$totalPet) * 100) >= 0 && ((1-$totalPet) * 100) < 17)
                    {{ ((1-$totalPet) * 100) }}%
                @endif
            </td>
        </tr>
        <tr>
            <td>Secara verbal resistif</td>
            <td>{{ '17 <= x < 34' }}</td>
            <td>
                @if (((1-$totalPet) * 100) >= 17 && ((1-$totalPet) * 100) < 34)
                    {{ ((1-$totalPet) * 100) }}%
                @endif
            </td>
        </tr>
        <tr>
            <td>Secara fisik tidak kooperatif</td>
            <td>{{ '34 <= x < 51' }}</td>
            <td>
                @if (((1-$totalPet) * 100) >= 34 && ((1-$totalPet) * 100) < 51)
                    {{ ((1-$totalPet) * 100) }}%
                @endif
            </td>
        </tr>
        <tr>
            <td>Berisiko Menyerang</td>
            <td>{{ '51 <= x < 68' }}</td>
            <td>
                @if (((1-$totalPet) * 100) >= 51 && ((1-$totalPet) * 100) < 68)
                    {{ ((1-$totalPet) * 100) }}%
                @endif
            </td>
        </tr>
        <tr>
            <td>Potensi menimbulkan kerusakan fisik atau kematian</td>
            <td>{{ '68 <= x < 85' }}</td>
            <td>
                @if (((1-$totalPet) * 100) >= 68 && ((1-$totalPet) * 100) < 85)
                    {{ ((1-$totalPet) * 100) }}%
                @endif
            </td>
        </tr>
        <tr>
            <td>Berisiko Melarikan diri</td>
            <td>{{ '85 <= x <= 100' }}</td>
            <td>
                @if (((1-$totalPet) * 100) >= 85 && ((1-$totalPet) * 100) <= 100)
                    {{ ((1-$totalPet) * 100) }}%
                @endif
            </td>
        </tr>
    </tbody>
</table>
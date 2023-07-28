@extends('admin.layouts.default')

@section('content')
{{-- {{  }} --}}
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <div class="row mb-3">
                            <div class="col">
                                <h4 class="card-title font-weight-normal">Data Master User</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="text-center">Grafik Tingkat Kerawanan Berdasarkan Hasil Instrument deteksi dini</h5>
                        <h5 class="text-center">Periode Januari - Juni 2022</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead  class="text-center">
                                    <tr>
                                        <th style="width: 5%" rowspan="2">No</th>
                                        <th style="width: 25%" rowspan="2">Nama UPT</th>
                                        <th colspan="4">Tingkat Kerawanan</th>
                                        <th rowspan="2">Keterangan</th>
                                    </tr>
                                    <tr>
                                        <th class="text-truncate bg-red">Menyerang - Potensi menimbulkan kerusakan fisik atau kematian - Melarikan diri</th>
                                        <th class="text-truncate bg-orange">Secara fisik tidak kooperatif</th>
                                        <th class="text-truncate bg-yellow">Secara verbal resistif</th>
                                        <th class="text-truncate bg-green">Ko operatif</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $merah = 0;
                                        $orange = 0;
                                        $kuning = 0;
                                        $hijau = 0;

                                        $merahArry = '';
                                        $orangeArry = '';
                                        $kuningArry = '';
                                        $hijauArry = '';
                                    @endphp
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->upt->user->name }}</td>
                                        @php
                                            $totalPet = number_format(($item->bobot_total / $item->sub_category_answers->sum('nilai_bobot_ideal')), 2)
                                        @endphp
                                        <td class="bg-red">
                                            @if (((1-$totalPet) * 100) >= 51 && ((1-$totalPet) * 100) < 100)
                                                @php
                                                    $merah += (1-$totalPet) * 100;
                                                    $merahArry .= (1-$totalPet) * 100 . ' ';
                                                @endphp
                                            @else
                                                @php
                                                    $merahArry .= '0 ';
                                                @endphp
                                            @endif
                                            {{ (((1-$totalPet) * 100) >= 51 && ((1-$totalPet) * 100) < 100) ? (1-$totalPet) * 100 : 0 }}
                                        </td>
                                        <td class="bg-orange">
                                            @if (((1-$totalPet) * 100) >= 34 && ((1-$totalPet) * 100) < 51)
                                                @php
                                                    $orange += (1-$totalPet) * 100;
                                                    $orangeArry .= (1-$totalPet) * 100 . ' ';
                                                @endphp
                                            @else
                                                @php
                                                    $orangeArry .= '0 ';
                                                @endphp
                                            @endif
                                            {{ (((1-$totalPet) * 100) >= 34 && ((1-$totalPet) * 100) < 51) ? (1-$totalPet) * 100 : 0 }}
                                        </td>
                                        <td class="bg-yellow">
                                            @if (((1-$totalPet) * 100) >= 17 && ((1-$totalPet) * 100) < 34)
                                                @php
                                                    $kuning += (1-$totalPet) * 100;
                                                    $kuningArry .= (1-$totalPet) * 100 . ' ';
                                                @endphp
                                            @else
                                                @php
                                                    $kuningArry .= '0 ';
                                                @endphp
                                            @endif
                                            {{ (((1-$totalPet) * 100) >= 17 && ((1-$totalPet) * 100) < 34) ? (1-$totalPet) * 100 : 0 }}
                                        </td>
                                        <td class="bg-green">
                                            @if (((1-$totalPet) * 100) >= 0 && ((1-$totalPet) * 100) < 17)
                                                @php
                                                    $hijau += (1-$totalPet) * 100;
                                                    $hijauArry .= (1-$totalPet) * 100 . ' ';
                                                @endphp
                                            @else
                                                @php
                                                    $hijauArry .= '0 ';
                                                @endphp
                                            @endif
                                            {{ (((1-$totalPet) * 100) >= 0 && ((1-$totalPet) * 100) < 17) ? (1-$totalPet) * 100 : 0 }}
                                        </td>
                                        <td>{{ $item->deskripsi }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="bg-secondary">Jumlah Total</td>
                                        <td class="bg-red">{{ $merah }}</td>
                                        <td class="bg-orange">{{ $orange }}</td>
                                        <td class="bg-yellow">{{ $kuning }}</td>
                                        <td class="bg-green">{{ $hijau }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="bg-dark">TOTAL KESELURUHAN UPT YANG TELAH MELAPORKAN</td>
                                        <td colspan="4" class="bg-dark">{{ $merah + $orange + $kuning + $hijau  }}</td>
                                        <td class="bg-dark"></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .table {
        table-layout: fixed;
    }
    #chart {
        max-width: 950px;
        margin: 35px auto;
    }

</style>
<!-- Button trigger modal -->
@endsection

@push('after-script')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var merah = '{{ $merah }}';
    merah = parseInt(merah);
    var orange = '{{ $orange }}';
    orange = parseInt(orange);
    var kuning = '{{ $kuning }}';
    kuning = parseInt(kuning);
    var hijau = '{{ $hijau }}';
    hijau = parseInt(hijau);

    var total = merah + orange + kuning + hijau;


    var options = {
        chart: {
            type: 'pie'
        },
        colors:['#57f542', '#fcd305', '#f59642', '#f54e42'],
        series: [((hijau/total) * 100), ((kuning/total) * 100), ((orange/total) * 100), ((merah/total) * 100)],
        labels: ['Ko operatif', 'Secara verbal resersif', 'Secara fisik tidak kooperatif', 'Menyerang - Potensi menimbulkan kerusakan fisik atau kematian - Melarikan diri']
    }

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();
</script>
@endpush
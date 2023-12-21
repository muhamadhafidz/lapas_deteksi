@extends('admin.layouts.default')

@section('content')
{{-- {{  }} --}}
<style>
    @media print {
            .bg-orange {
                color: #000000!important;
                background-color: #ff9800 !important;
            }

            .bg-red {
                color: #000000!important;
                background-color: #f44  336 !important;
            }

            .bg-yellow {
                color: #000000!important;
                background-color: #ffeb3b !important;
            }

            .bg-green {
                color: #000000!important;
                background-color: #4caf50 !important;
            }

            .bg-dark {
                color: #000000!important;
                background-color: #000000 !important;
            }

            .bg-secondary {
                color: #000000!important;
                background-color: #6c757d !important;
            }
            #printReport {
                display: none;
            }
            /* Add any additional styles you need for printing here */
        }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <div class="row mb-3">
                            <div class="col">
                                <h4 class="card-title font-weight-normal">Laporan Deteksi Dini</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="text-center">Grafik Tingkat Kerawanan Berdasarkan Hasil Instrument deteksi dini</h5>
                        <h5 class="text-center">Kuartal {{ $kuartal }}, Tahun {{ $year }}</h5>
                        <div class="table-responsive">
                            <button class="btn btn-outline-dark mb-2" type="button" id="printReport">Print</button>
                            <table class="table table-bordered" id="tableReport">
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
                                        $total = 0;
                                        $uptUser = [];
                                    @endphp
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->upt->user ? $item->upt->user->name : '' }}</td>
                                        @php
                                            $uptUser[] = $item->upt->user->id;
                                            $totalPet = number_format(($item->bobot_total / $item->sub_category_answers->sum('nilai_bobot_ideal')), 2)
                                        @endphp
                                        <td class="bg-red">
                                            @if (((1-$totalPet) * 100) >= 51 && ((1-$totalPet) * 100) <= 100)
                                                @php
                                                    $merah ++;
                                                    $merahArry .= (1-$totalPet) * 100 . ' ';
                                                    $total += (1-$totalPet) * 100;
                                                @endphp
                                            @else
                                                @php
                                                    $merahArry .= '0 ';
                                                @endphp
                                            @endif
                                            {{ (((1-$totalPet) * 100) >= 51 && ((1-$totalPet) * 100) <= 100) ? '1' : '0' }}
                                        </td>
                                        <td class="bg-orange">
                                            @if (((1-$totalPet) * 100) >= 34 && ((1-$totalPet) * 100) < 51)
                                                @php
                                                    $orange ++;
                                                    $orangeArry .= (1-$totalPet) * 100 . ' ';
                                                    $total += (1-$totalPet) * 100;
                                                @endphp
                                            @else
                                                @php
                                                    $orangeArry .= '0 ';
                                                @endphp
                                            @endif
                                            {{ (((1-$totalPet) * 100) >= 34 && ((1-$totalPet) * 100) < 51) ? '1' : '0' }}
                                        </td>
                                        <td class="bg-yellow">
                                            @if (((1-$totalPet) * 100) >= 17 && ((1-$totalPet) * 100) < 34)
                                                @php
                                                    $kuning ++;
                                                    $kuningArry .= (1-$totalPet) * 100 . ' ';
                                                    $total += (1-$totalPet) * 100;
                                                @endphp
                                            @else
                                                @php
                                                    $kuningArry .= '0 ';
                                                @endphp
                                            @endif
                                            {{ (((1-$totalPet) * 100) >= 17 && ((1-$totalPet) * 100) < 34) ? '1' : '0' }}
                                        </td>
                                        <td class="bg-green">
                                            @if (((1-$totalPet) * 100) >= 0 && ((1-$totalPet) * 100) < 17)
                                                @php
                                                    $hijau ++;
                                                    $hijauArry .= (1-$totalPet) * 100 . ' ';
                                                    $total += (1-$totalPet) * 100;
                                                @endphp
                                            @else
                                                @php
                                                    $hijauArry .= '0 ';
                                                @endphp
                                            @endif
                                            {{ (((1-$totalPet) * 100) >= 0 && ((1-$totalPet) * 100) < 17) ? '1' : '0' }}
                                        </td>
                                        <td>{{ $total.'%' }}</td>
                                        @php
                                            $total = 0;
                                        @endphp
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
                                        <td colspan="4" class="bg-dark">{{ count(array_unique($uptUser))  }}</td>
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
<script>
    $(document).ready(function(){

        $('#printReport').on('click', function(){
            window.print();
        });
    });
</script>

@endpush
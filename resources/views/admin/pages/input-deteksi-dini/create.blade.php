@extends('admin.layouts.default')

@section('content')
{{-- {{  }} --}}
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <form action="{{ route('user.input-deteksi-dini.store') }}" method="POST" id="submitForm">
                        @csrf
                        <div class="card-header ">
                            <div class="row mb-3">
                                <div class="col">
                                    <h4 class="card-title font-weight-normal">Tambah Input Deteksi Dini</h4>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="Quartal">Quartal</label>
                                        <select name="quartal" id="quartal" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Quartal">Tahun</label>
                                        <select name="year" id="year" class="form-control">
                                            @for ($i = date('Y'); $i >= 2015; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                        
                            <table class="table table-bordered display nowrap"  id="crudTable" style="width: 100%">
                                <thead>
                                    <th>No</th>
                                    <th>Element Assessment</th>
                                    <th>Deskripsi</th>
                                    <th>Nilai Bobot Ideal</th>
                                    <th>Bobot</th>
                                </thead>
                                <tbody>
                                    @foreach ($cat as $ct)
                                        <tr class="font-weight-bold" style="background-color: grey">
                                            <td></td>
                                            <td colspan="4" style="font-size: 11px; color: white;">{{ $loop->iteration }} {{ $ct->name }}</td>
                                        </tr>
                                            @foreach ($ct->sub_categories as $sub)
                                            <tr class="font-weight-bold" style="background-color: rgb(195, 195, 195)">
                                                <td></td>
                                                <td colspan="4" style="font-size: 11px;">{{ $sub->name }}</td>
                                            </tr>
                                                @forelse ($sub->instrument as $item)
                                                <tr>
                                                    <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $item->element_assessment }}</td>
                                                    <td>{{ $item->deskripsi }}</td>
                                                    @if ($loop->index <= 0)
                                                    <td class="align-middle text-center" rowspan="{{ $sub->instrument->count() }}">{{ $sub->nilai_bobot_ideal }}</td>
                                                    @endif
                                                    <td>
                                                      <div class="form-check form-check-inline">
                                                        <input type="radio" class="form-check-input" required name="bobot[{{ $item->id }}]" id="bobot2" value="2">
                                                        <label class="form-check-label" for="bobot2">2</label>
                                                      </div>
                                                      <div class="form-check form-check-inline">
                                                        <input type="radio" class="form-check-input" required {{ $item->is_absolute ? 'disabled' : '' }} name="bobot[{{ $item->id }}]" id="bobot1" value="1">
                                                        <label class="form-check-label" for="bobot1">1</label>
                                                      </div>
                                                      <div class="form-check form-check-inline">
                                                        <input type="radio" class="form-check-input" required name="bobot[{{ $item->id }}]" id="bobot0" value="0">
                                                        <label class="form-check-label" for="bobot0">0</label>
                                                      </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td class="align-middle text-center" colspan="5">Tidak ada instrument data</td>
                                                </tr>
                                                @endforelse
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    
                                    
                                </tbody>
                            </table>
                            <button type="button" id="submitBtn" class="btn btn-success mt-5 w-100">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->
@endsection

@push('after-script')
<script>
    $(document).ready(function(){
        // after click submitBtn check if all radio button is checked
        $('#submitBtn').click(function(){
            var radio = $('input[type="radio"]:checked').length;
            var radioTotal = $('input[type="radio"]').length;
            if (radio != (radioTotal/3)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Mohon Lengkapi Data',
                })
            } else {
                // trigger submit current button
                $('#submitForm').submit();
            }
        });
    });
</script>
@endpush

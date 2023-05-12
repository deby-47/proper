@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">

            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="row">
                    <div class="col">
                        <div class="card bg-transparent shadow">
                            <div class="card-header bg-transparent border-0 row">
                                <div class="col-lg-6 col-7">
                                    <h3 class="mb-0">UP TUP</h3> <br>
                                    <h3>Form Edit Data UP TUP</h3>
                                </div>
                                <div class="col-lg-6 col-5 text-right">
                                    <a href="{{ route('up-tup.index') }}"
                                        class="btn btn-primary">Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('up-tup.update') }}" method="POST">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="pilihOPD">Pilih OPD</label>
                                            <select class="custom-select" name="id_opd">
                                                <option selected disabled>Pilih Organisasi Perangkat Daerah</option>
                                                @foreach ($opd as $item)
                                                    @php
                                                        $statusOPD = "";
                                                        if($item->id == $up->id_opd){
                                                            $statusOPD = "selected";
                                                        }
                                                    @endphp
                                                    <option value="{{ $item->id }}" {{ $statusOPD }}>{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="pilihJenis">Pilih Jenis</label>
                                            <select class="custom-select" name="jenis_up">
                                                <option selected disabled>Pilih Jenis</option>
                                                <option value="1" {{ ($up->jenis_up == "1") ? "selected" : "" }}>GUP</option>
                                                <option value="2" {{ ($up->jenis_up == "2") ? "selected" : "" }}>Jumlah</option>
                                                <option value="3" {{ ($up->jenis_up == "3") ? "selected" : "" }}>Nilai Komponen</option>
                                                <option value="4" {{ ($up->jenis_up == "4") ? "selected" : "" }}>PTUP</option>
                                                <option value="5" {{ ($up->jenis_up == "5") ? "selected" : "" }}>Setoran TUP</option>
                                                <option value="6" {{ ($up->jenis_up == "6") ? "selected" : "" }}>TUP</option>
                                                <option value="7" {{ ($up->jenis_up == "7") ? "selected" : "" }}>UP</option>
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputTanggal">Tanggal</label>
                                            <input type="date" class="form-control" name="tanggal_up" value="{{ $up->tanggal_up }}">
                                        </div>
                                      
                                        <div class="form-group col-md-6">
                                            <label for="inputSelisih">Selisih Hari</label>
                                            <input type="text" class="form-control" name="selisih_hari_up" placeholder="Selisih Hari" value="{{ $up->selisih_hari_up }}">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputtotalgu">Total GU</label>
                                            <input type="text" class="form-control" name="total_gu_up" placeholder="Total GU" value="{{ $up->total_gu_up }}">
                                        </div>
                                      
                                        <div class="form-group col-md-6">
                                            <label for="inputSelisih">Outstanding UP / TUP</label>
                                            <input type="text" class="form-control" name="outstanding_up" placeholder="Outstanding UP / TUP" value="{{ $up->outstanding_up }}">
                                        </div>
                                        
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputtotalgu">Persen (%) GUP</label>
                                            <input type="text" class="form-control" name="persen_up" placeholder="Persen (%) GUP" value="{{ $up->persen_up }}">
                                        </div>
                                      
                                        <div class="form-group col-md-6">
                                            <label for="inputSelisih">Status</label>
                                            <select class="custom-select" name="status_up">
                                                <option selected disabled>Pilih Status</option>
                                                <option value="1" {{ ($up->status_up == "1") ? "selected" : "" }}>Tepat Waktu</option>
                                                <option value="2" {{ ($up->status_up == "2") ? "selected" : "" }}>Terlambat</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputtotalgu">Kepatuhan (50 %)</label>
                                            <input type="text" class="form-control" name="kepatuhan_up" placeholder="Kepatuhan (50 %)"  value="{{ $up->kepatuhan_up }}">
                                        </div>
                                      
                                        <div class="form-group col-md-6">
                                            <label for="inputtotalgu">Presentase GUP (25 %)</label>
                                            <input type="text" class="form-control" name="presentase_gup_up" placeholder="Presentase GUP (25 %)"  value="{{ $up->presentase_gup_up }}">
                                        </div>
                                      
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputtotalgu">&nbsp;</label>
                                            <input type="text" class="form-control" name="presentase" value="{{ $up->presentase }}">
                                        </div>
                                      
                                        <div class="form-group col-md-6">
                                            <label for="inputtotalgu">Setoran GUP (25 %)</label>
                                            <input type="text" class="form-control" name="setoran_tup_up" placeholder="Setoran GUP (25 %)" value="{{ $up->setoran_tup_up }}">
                                        </div>
                                      
                                    </div>
                                    @csrf
                                    <input type="hidden" name="id_up_tup" value="{{ $up->id_up_tup }}">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    @include('layouts.footers.auth')
</div>
@endsection
@push('js')
    <script src="{{ asset('argon') }}/vendor/js-cookie/js.cookie.js"></script>
    <script src="{{ asset('argon') }}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js">
    </script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush

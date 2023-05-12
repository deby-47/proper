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
                                    <h3 class="mb-0">Capaian RO</h3> <br>
                                    <h3>Form Edit Data Capaian RO</h3>
                                </div>
                                <div class="col-lg-6 col-5 text-right">
                                    <a href="{{ route('up-tup.index') }}" class="btn btn-primary">Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('capaian-ro.update') }}" method="POST">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="pilihOPD">Pilih OPD</label>
                                            <select class="custom-select" name="id_opd">
                                                <option selected disabled>Pilih Organisasi Perangkat Daerah</option>
                                                @foreach ($opd as $item)
                                                @php
                                                $statusOPD = "";
                                                if($item->id == $capaian->id_opd){
                                                $statusOPD = "selected";
                                                }
                                                @endphp
                                                <option value="{{ $item->id }}" {{ $statusOPD }}>{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputSubKegiatan">Sub Kegiatan</label>
                                            <input type="text" class="form-control" name="sub_kegiatan" placeholder="Sub Kegiatan" value="{{ $capaian->sub_kegiatan }}">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputRO">RO</label>
                                            <input type="number" class="form-control" name="ro" placeholder="RO" value="{{ $capaian->ro }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputTargetRO">Target RO</label>
                                            <input type="number" class="form-control" name="target_ro" placeholder="Target RO" value="{{ $capaian->target_ro }}">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="satuan">Satuan</label>
                                            <input type="text" class="form-control" name="satuan" placeholder="Satuan" value="{{ $capaian->satuan }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="rvro">RVRO</label>
                                            <input type="number" class="form-control" name="rvro" placeholder="RVRO" value="{{ $capaian->rvro }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="pcro">PCRO</label>
                                            <input type="number" class="form-control" name="pcro" placeholder="PCRO" value="{{ $capaian->pcro }}">
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="inputSelisih">Status Konfirmasi</label>
                                            <select class="custom-select" name="status_konfirmasi">
                                                <option selected disabled>Pilih Status</option>
                                                <option value="1" {{ ($capaian->status_konfirmasi == "1") ? "selected" : "" }}>Terkonfirmasi</option>
                                                <option value="2" {{ ($capaian->status_konfirmasi == "2") ? "selected" : "" }}>Tidak Terkonfirmasi </option>
                                            </select>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label for="inputtarget">Target PCRO</label>
                                            <input type="number" class="form-control" name="target_pcro" placeholder="Target PCRO" value="{{ $capaian->target_pcro }}">
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="bataspelaporan">Batas Waktu Pelaporan</label>
                                            <input type="date" class="form-control" name="batas_waktu_pelaporan" placeholder="Batas Waktu Pelaporan" value="{{ $capaian->batas_waktu_pelaporan }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="tanggal_kirim">Tanggal Kirim</label>
                                            <input type="date" class="form-control" name="tanggal_kirim" placeholder="Tanggal Kirim" value="{{ $capaian->tanggal_kirim }}">
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="tanggal_kosong">&nbsp;</label>
                                            <input type="date" class="form-control" name="tanggal_kosong" value="{{ $capaian->tanggal_kosong }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="status">Status</label>
                                            <select class="custom-select" name="status">
                                                <option selected disabled>Pilih Status</option>
                                                <option value="1" {{ ($capaian->status == "1") ? "selected" : "" }}>Tepat Waktu</option>
                                                <option value="2" {{ ($capaian->status == "2") ? "selected" : "" }}>Terlambat</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="komponen_tepat_waktu">Komponen Tepat Waktu (30%)</label>
                                            <input type="number" class="form-control" name="komponen_tepat_waktu" placeholder="Komponen Tepat Waktu (30%)" value="{{ $capaian->komponen_tepat_waktu }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="komponen_capaian_ro">Komponen Capaian RO (70%)</label>
                                            <input type="number" class="form-control" name="komponen_capaian_ro" placeholder="Komponen Capaian RO (70%)" value="{{ $capaian->komponen_capaian_ro }}">
                                        </div>
                                    </div>

                                    @csrf

                                    <input type="hidden" name="id_capaian_ro" value="{{ $capaian->id_capaian_ro }}">
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
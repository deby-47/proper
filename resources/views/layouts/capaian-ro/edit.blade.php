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
                                    <h3 class="mb-0">Capaian Realisasi Keluaran</h3> <br>
                                    <h3>Form Edit Data Capaian RK</h3>
                                </div>
                                <div class="col-lg-6 col-5 text-right">
                                    <a href="{{ route('up-tup.index') }}"
                                        class="btn btn-primary">Kembali</a>
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
                                                <input type="text" class="form-control" name="program"  placeholder="Sub Kegiatan" value="{{ $capaian->program }}">
                                        </div>
                                    </div>
                                   
                                    <div class="form-row">
                                        
                                      
                                        <div class="form-group col-md-6">
                                            <label for="inputTargetRO">Target RK</label>
                                            <input type="number" step="0.01" class="form-control" name="target_ro" placeholder="Target RK" value="{{ $capaian->target_ro }}" id="target_ro">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="satuan">Satuan</label>
                                            <input type="text" class="form-control" name="satuan" placeholder="Satuan" value="{{ $capaian->satuan }}">
                                        </div>
                                      

                                    </div>

                                    <div class="form-row">
                                       
                                        <div class="form-group col-md-6">
                                            <label for="rvro">Realisasi Volume Realisasi Keluaran (RVRK)</label>
                                            <input type="number" class="form-control" name="rvro" placeholder="RVRK" value="{{ $capaian->rvro }}" id="rvro">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="pcro">Progres Capaian Realisasi Keuangan (PCRK)</label>
                                            <input type="number" class="form-control" name="pcro" placeholder="PCRK" id="pcro" value="{{ $capaian->pcro }}" readonly>
                                        </div>
                                        
                                        
                                    </div>

                                    <div class="form-row">

                                          
                                        <div class="form-group col-md-6">
                                            <label for="inputSelisih">Status Konfirmasi</label>
                                            <select class="custom-select" name="status_konfirmasi" id="status_konfirmasi">
                                                <option selected disabled>Pilih Status</option>
                                                <option value="1"  {{ ($capaian->status_konfirmasi == "1") ? "selected" : "" }}>Terkonfirmasi</option>
                                                <option value="2"  {{ ($capaian->status_konfirmasi == "2") ? "selected" : "" }}>Tidak Terkonfirmasi	</option>
                                            </select>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label for="inputtarget">Target Progres Capaian Realisasi Keuangan (PCRK) </label>
                                            <input type="number" class="form-control" name="target_pcro" placeholder="Target PCRK" value="{{ $capaian->target_pcro }}"> 
                                        </div>
                                    
                                    </div>

                                    <div class="form-row">
                                     
                                        <div class="form-group col-md-6">
                                            <label for="tanggal_kirim">Tanggal Kirim</label>
                                            <input type="date" class="form-control" name="tanggal_kirim" placeholder="Tanggal Kirim" value="{{ $capaian->tanggal_kirim }}"  id="tgl_kirim">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="status">Status</label>
                                            @php
                                                $status_kode = 0;
                                                $status = 0;
                                                if($capaian->status == 1){
                                                    $status_kode = 1;
                                                    $status = "Tepat Waktu";
                                                }elseif($capaian->status == 2){
                                                    $status_kode = 2;
                                                    $status = "Terlambat";
                                                }
                                            @endphp
                                            <input type="text" class="form-control" name="status" id="status" value="{{ $status }}" readonly>
                                            <input type="hidden" class="form-control" name="status_kode" id="status_kode" value="{{ $status_kode }}">
                                        </div>
                                      
                                    </div>

                                  

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="komponen_tepat_waktu">Komponen Tepat Waktu (30%)</label>
                                            <input type="number" class="form-control" name="komponen_tepat_waktu" placeholder="Komponen Tepat Waktu (30%)" value="{{ $capaian->komponen_tepat_waktu }}" id="nilai_tepat_waktu" readonly>
                                        </div>
                                      
                                        <div class="form-group col-md-6">
                                            <label for="komponen_capaian_ro">Komponen Capaian RO (70%)</label>
                                            <input type="number" class="form-control" name="komponen_capaian_ro" placeholder="Komponen Capaian RO (70%)" value="{{ $capaian->komponen_capaian_ro }}"  id="nilai_capaian_ro" readonly>
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

    <script>
        
        $(document).on('keyup', '#target_ro, #rvro', function () {
            var target_ro = $("#target_ro").val();
            var rvro      = $("#rvro").val();
            var hasil = 0
            if (rvro == 0) {
                hasil = 0;
            } else {
                hasil = (target_ro / rvro) * 100;
            }
            $("#pcro").val(hasil);
        });

        $('#tgl_kirim').change(function(){
            var batas_pelaporan = "{{ $pelaporan->batas_waktu_pelaporan }}";
            var batas       = new Date(batas_pelaporan);
            var kirim       = new Date($(this).val());
            if (batas < kirim){
                $("#status").val("Terlambat");
                $("#status_kode").val(2);
                $("#nilai_tepat_waktu").val(0);

            }else{
                $("#status").val("Tepat Waktu");
                $("#status_kode").val(1);
                $("#nilai_tepat_waktu").val(100);
                
            }
        });

        $('#status_konfirmasi').change(function(){
            var status_konfirmasi = $(this).val();
            if(status_konfirmasi == 1){
                $("#nilai_capaian_ro").val(100);
            }else if(status_konfirmasi == 2){
                $("#nilai_capaian_ro").val(0);
            }

        });

        
        

    </script>
@endpush

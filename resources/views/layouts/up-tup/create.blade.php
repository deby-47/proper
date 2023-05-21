@extends('layouts.app')

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</head>

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
                                    <h3>Form Tambah Data UP TUP</h3>
                                </div>
                                <div class="col-lg-6 col-5 text-right">
                                    <a href="{{ route('up-tup.index') }}"
                                        class="btn btn-primary">Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('up-tup.store') }}" method="POST">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="pilihOPD">Organisasi Perangkat Daerah</label>
                                            <select class="custom-select" name="id_opd" id="id_opd">
                                                <option selected disabled>Pilih Organisasi Perangkat Daerah</option>
                                                @foreach ($opd as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="pilihJenis">Pilih Jenis</label>
                                            <select class="custom-select" name="jenis_up" id="jenis_up">
                                                <option selected disabled>Pilih Jenis</option>
                                                <option value="1">UP</option>
                                                <option value="2">GUP</option>
                                                <option value="3">TUP</option>
                                                <option value="4">PTUP</option>
                                                <option value="5">Setoran TUP</option>
                                                {{-- <option value="6">Jumlah</option>
                                                <option value="7">Nilai Komponen</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputTanggal">Tanggal</label>
                                            <input type="date" class="form-control" name="tanggal_up" id="tgl_up">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="inputSelisih">Jumlah Hari </label>
                                            <input type="text" class="form-control" name="jumlah_hari" placeholder="Jumlah hari" id="jumlah_hari" readonly>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="inputSelisih">Selisih Hari</label>
                                            <input type="text" class="form-control" name="selisih_hari_up" placeholder="Selisih Hari" id="selisih_hari" readonly>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputtotalgu">Total GU</label>
                                            <input type="text" class="form-control" name="total_gu_up" placeholder="Total GU" id="total_gu">
                                        </div>
                                        <div class="form-group col-md-6 tup-hide">
                                            <label for="inputtotalgu">Persen (%) GUP</label>
                                            <input type="text" class="form-control" name="persen_up" placeholder="Persen (%) GUP" readonly id="presengup"> 
                                        </div>
                                
                                        
                                    </div>

                                    <div class="form-row  tup-hide">
                                        
                                      
                                        <div class="form-group col-md-6">
                                            <label for="inputStatus">Status</label>
                                            <input type="text" class="form-control" name="status" id="status" readonly>
                                            <input type="hidden" class="form-control" name="status_kode" id="status_kode">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputtotalgu">Kepatuhan (50 %)</label>
                                            <input type="text" class="form-control" name="kepatuhan_up" placeholder="Kepatuhan (50 %)" readonly id="kepatuhan">
                                        </div>
                                      
                                    </div>

                                    <div class="form-row  tup-hide">
                                    
                                        <div class="form-group col-md-6">
                                            <label for="inputtotalgu">Presentase GUP (25 %)</label>
                                            <input type="text" class="form-control" name="presentase_gup_up" placeholder="Presentase GUP (25 %)" id="presentasegup" readonly>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputtotalgu">Setoran GUP (25 %)</label>
                                            <input type="text" class="form-control" name="setoran_tup_up" placeholder="Setoran GUP (25 %)" readonly>
                                        </div>
                                      
                                    </div>

                                    <div class="form-row">
                                      
                                       
                                      
                                    </div>
                                    @csrf
                                    <input type="hidden" name="outstanding" id="outstanding">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#id_opd').select2();
    </script>
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
        $(document).ready(function(){
            $(".tup-hide").hide();
        })
        
        $("#jenis_up").change(function(){
            changeValue();
        });

        $("#tgl_up").change(function(){
            changeValue();
        });
        $("#id_opd").change(function(){
            changeValue();
           
        });
        
        function changeValue(){
            var jenis  = $("#jenis_up").val();
            var id_opd = $("#id_opd").val();
            var tgl    = $("#tgl_up").val();

            if(jenis == 1){
                $("#jumlah_hari").val(0);
                $("#selisih_hari").val(0);
                $(".tup-hide").show();

            }else if(jenis == 2){
                $.ajax({
                    type: 'GET',
                    url: "{{ url('up-tup/get-last-up/') }}/"+id_opd+"/"+tgl+"/"+jenis,
                    success: function (data) {
                        $("#jumlah_hari").val(data.count_days);
                        $("#selisih_hari").val(data.selisih);
                        $("#outstanding").val(data.up_outstanding);

                        cekStatus(data.count_days,data.selisih);
                    }
                });
                hitungPresen();
                hitungPresentaseGUP();
                $(".tup-hide").show();
            }else if(jenis == 3 || jenis == 4 || jenis == 5){
                $.ajax({
                    type: 'GET',
                    url: "{{ url('up-tup/get-tup-up/') }}/"+id_opd+"/"+tgl+"/"+jenis,
                    success: function (data) {
                        $("#jumlah_hari").val(data.count_days);
                        $("#selisih_hari").val(data.selisih);
                        console.log(data);
                    }
                });
                $("#presengup").val("");
                $("#presentasegup").val("");
                $("#status").val("");
                $("#kepatuhan").val("");
                $(".tup-hide").hide();

            }

        }

        function hitungPresen(){
            var outstanding = $("#outstanding").val();
            var total_gu    = $("#total_gu").val();
            hasil = 0;
            if(outstanding != 0){
                hasil = (total_gu / outstanding) * 100;
            }
            $("#presengup").val(hasil);   
        }

        $(document).on('keyup', '#total_gu', function () {
           changeValue();
        });

        function cekStatus(hari,selisih){
            var jenis  = $("#jenis_up").val();

            if (selisih > hari ){
                $("#status").val("Terlambat");
                $("#status_kode").val(2);
                $("#kepatuhan").val(0);
            }else{
                $("#status").val("Tepat Waktu");
                $("#status_kode").val(1);
                if(jenis == 1){
                    $("#kepatuhan").val(0);
                }else{
                    $("#kepatuhan").val(100);
                }
            }
        }

        function hitungPresentaseGUP(){
            var presengup    = $("#presengup").val();
            var hari    = $("#jumlah_hari").val();
            var selisih = $("#selisih_hari").val();
            var hasil   = 0;
            if(selisih != 0){
                perhitungan = presengup * (hari/selisih);
                if(perhitungan > 100){
                    hasil = 100;
                }else{
                    hasil = perhitungan;
                }
            }
            $("#presentasegup").val(hasil);
        }   

    </script>
@endpush

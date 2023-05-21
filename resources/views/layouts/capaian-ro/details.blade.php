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
                                <h2 class="mb-0">Detail Capaian Realisasi Keluaran</h2>
                                    <h3 class="mb-10"><strong> {{ $title }} </strong></h3>
                                </div>
                                <div class="col-lg-6 col-5 text-right">
                                    <a href="{{ route('capaian-ro.index') }}"
                                        class="btn btn-primary">Kembali</a>

                                        <!--<a href="{{ route('capaian-ro.export') }}"-->
                                        <!--class="btn btn-success">Export Data</a>-->
                                </div>
                                <form action="/capaian-ro/cari-detail" method="GET">
                                    <div class="col-auto mb-3">
                                        <div class="input-group-prepend">
                                            <span>
                                                <div class="col-auto">
                                                    <input type="text" name="search" class="form-control" id="search" placeholder="Search..." value="{{ old('search') }}">
                                                </div>
                                            </span>
                                            <button id="search" type="submit" class="btn btn-primary">Cari</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                                @if (Session::get('success'))
                                    <div class="alert alert-primary" role="alert">
                                        {{ Session::get('success') }}
                                    </div>
                                @elseif (Session::get('failed'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ Session::get('failed') }}
                                    </div>
                                @endif
                               
                            <div class="table-responsive" style="padding: 5px">
                                <table class="table align-items-center table-flush">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Sub Kegiatan</th>
                                            <th scope="col">Target RK</th>
                                            <th scope="col">Satuan</th>
                                            <th scope="col">RVRK</th>
                                            <th scope="col">PCRK</th>
                                            <th scope="col">Status Konfirmasi</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach($detail as $key => $value)
                                            <tr>
                                                <td scope="row">
                                                    {{ ($detail->currentpage()-1) * $detail->perpage() + $key + 1 }}
                                                </td>
                                                <td>
                                                    {{ $value->program }}
                                                </td>
                                                <td>
                                                    {{ $value->target_ro }}
                                                </td>
                                                <td>
                                                    {{ $value->satuan }}
                                                </td>
                                                <td>
                                                    {{ $value->rvro }}
                                                </td>
                                                <td>
                                                    {{ $value->pcro }} %
                                                </td>
                                                <td>
                                                    @if($value->status_konfirmasi == 1)
                                                        Terkonfirmasi
                                                    @elseif($value->status_konfirmasi == 2)
                                                        Tidak Terkonfirmasi	
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('capaian-ro.edit',$value->id_capaian_ro) }}"
                                                        class="btn btn-success btn-sm"><i
                                                            class="fa fa-pencil-alt"></i></a>

                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        data-id="{{ $value->id_capaian_ro }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Card footer -->
                            <div class="card-footer py-4">
                                <nav aria-label="...">
                                    <ul class="pagination justify-content-end mb-0">
                                        <h3 class="mb-0">{{ $detail->withQueryString()->links() }}</h3>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin untuk menghapus data?
                </div>
                <form action="{{ route('capaian-ro.delete') }}" method="post">
                    <div class="modal-footer">
                        @csrf
                        <input type="hidden" name="id_capaian_ro" id="id_capaian_ro_d">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
        
        $('#exampleModal').on('show.bs.modal', function (e) {
            var dataID = $(e.relatedTarget).attr('data-id');
            $("#id_capaian_ro_d").val(dataID);
        });
    </script>
@endpush

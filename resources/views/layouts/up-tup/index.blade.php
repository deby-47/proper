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
                                    <h3 class="mb-0">UP TUP</h3>
                                </div>
                                <div class="col-lg-6 col-5 text-right">
                                    <a href="{{ route('up-tup.create') }}"
                                        class="btn btn-primary">Tambah Data</a>
                                        
                                    <a href="{{ route('up-tup.export') }}"
                                        class="btn btn-success">Export Data</a>
                                </div>

                               
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
                                            <th scope="col">Jenis</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Selisih</th>
                                            <th scope="col">Total GU</th>
                                            <th scope="col">Outstanding UP / TUP</th>
                                            <th scope="col">Persen (%) GUP</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach($uptup as $key => $value)
                                            <tr>
                                                <td scope="row">
                                                    {{ $key+1 }}
                                                </td>
                                                <td>
                                                    @if($value->jenis_up == 1)
                                                        GUP
                                                    @elseif($value->jenis_up == 2)
                                                        Jumlah
                                                    @elseif($value->jenis_up == 3)
                                                        Nilai Komponen
                                                    @elseif($value->jenis_up == 4)
                                                        PTUP
                                                    @elseif($value->jenis_up == 5)
                                                        Setoran TUP
                                                    @elseif($value->jenis_up == 6)
                                                        TUP
                                                    @elseif($value->jenis_up == 7)
                                                        UP
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ date('d-M-Y',strtotime($value->tanggal_up )) }}
                                                </td>
                                                <td>
                                                    {{ $value->selisih_hari_up }}
                                                </td>
                                                <td>
                                                    {{ $value->total_gu_up }}
                                                </td>
                                                <td>
                                                    {{ $value->outstanding_up }}
                                                </td>
                                                <td>
                                                    {{ $value->persen_up }} %
                                                </td>
                                                <td>
                                                    @if($value->status_up == 1)
                                                        Tepat Waktu
                                                    @elseif($value->status_up == 2)
                                                        Terlambat
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('up-tup.edit',$value->id_up_tup) }}"
                                                        class="btn btn-success btn-sm"><i
                                                            class="fa fa-pencil-alt"></i></a>

                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        data-id="{{ $value->id_up_tup }}">
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
                                        <h3 class="mb-0">{{ $uptup->links() }}</h3>
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
                <form action="{{ route('up-tup.delete') }}" method="post">
                    <div class="modal-footer">
                        @csrf
                        <input type="hidden" name="id_up_tup" id="id_up_tup_d">
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
            $("#id_up_tup_d").val(dataID);
        });
    </script>
@endpush

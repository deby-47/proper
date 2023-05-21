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
                                    <h3 class="mb-0">Deviasi Rencana Penarikan Dana</h3>
                                </div>
                                <div class="col-lg-6 col-5 text-right">
                                    <a href="{{ route('deviasi.create') }}"
                                        class="btn btn-primary">Tambah Data Deviasi RPD</a>
                                        
                              
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
                                        <form action="/deviasi/cari" method="GET">
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
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col" class="sort" data-sort="no" style="text-align:center;font-size:12px;">No</th>
                                                    <th scope="col" class="sort" data-sort="nama" style="text-align:center;font-size:12px;"> Organisasi Perangkat Daerah </th>
                                                    <th scope="col" class="sort" data-sort="n_rpd" style="text-align:center;font-size:12px;"> Total Rencana Penarikan Dana </th>
                                                    <th scope="col" class="sort" data-sort="n_realisasi" style="text-align:center;font-size:12px;"> Total Realisasi </th>
                                                    <th scope="col" class="sort" data-sort="ikpa" style="text-align:center;font-size:12px;"> Nilai IKPA Deviasi RPD </th>
                                                    <th scope="col" class="sort" style="text-align:center;font-size:12px;"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                @foreach ($dv as $key => $dvs)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="media align-items-center">
                                                            <div class="media-body" style="text-align:center">
                                                                <span class="name mb-0 text-sm">{{ ($dv->currentpage()-1) * $dv->perpage() + $key + 1 }}</span>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td class="nama" style="text-align:center">
                                                        <strong>
                                                            {{ $dvs->nama }}
                                                        </strong>
                                                    </td>
                                                    <td class="jumlah_spm" style="text-align:center">
                                                        <strong>
                                                            {{ "Rp" . number_format($dvs->n_rpd, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="jumlah_dispensasi" style="text-align:center">
                                                        <strong>
                                                            {{ "Rp" . number_format($dvs->n_realisasi, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="ikpa" style="text-align:center">
                                                        @php $nilai_ikpa = abs(($dvs->n_realisasi - $dvs->n_rpd) / $dvs->n_rpd); @endphp
                                                        <strong>
                                                            {{ number_format(100 - ($nilai_ikpa * 100), 2) }}
                                                        </strong>
                                                    </td>
                                                    <td style="text-align:center">
                                                        @php $id = Illuminate\Support\Facades\Crypt::encrypt($dvs->id_dv) @endphp
                                                        <a href="deviasi/edit/{{ $id }}" class="details btn btn-info btn-md">Edit</a>
                                                        <form method="POST" action="{{ route('deviasi.delete', $dvs->id_dv) }}">
                                                            @csrf
                                                            <input type="hidden" name="destroy" value="DELETE">
                                                            <button style="margin-top: 10px" type="submit" class="btn btn-xs btn-danger show_confirm">
                                                                Hapus
                                                            </button>
                                                        </form>
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
                                        <h3 class="mb-0">{{ $dv->withQueryString()->links() }}</h3>
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

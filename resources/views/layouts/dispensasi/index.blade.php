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
                                    <h3 class="mb-0">Dispensasi SPM</h3>
                                </div>
                                <div class="col-lg-6 col-5 text-right">
                                    <a href="{{ route('dispensasi.create') }}"
                                        class="btn btn-primary">Tambah Data</a>
                                        
                              
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
                                        <form action="/dispensasi-spm/cari" method="GET">
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
                                                    <th scope="col" class="sort" data-sort="jumlah_spm" style="text-align:center;font-size:12px;"> Total SPM </th>
                                                    <th scope="col" class="sort" data-sort="jumlah_dispensasi" style="text-align:center;font-size:12px;"> Total SPM Dispensasi </th>
                                                    <th scope="col" class="sort" data-sort="ikpa" style="text-align:center;font-size:12px;"> Nilai IKPA Dispensasi SPM </th>
                                                    <th scope="col" class="sort" style="text-align:center;font-size:12px;"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                @php $ikpa_dispensasi = []; @endphp
                                                @foreach ($dsp as $key => $dsps)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="media align-items-center">
                                                            <div class="media-body" style="text-align:center">
                                                                <span class="name mb-0 text-sm">{{ ($dsp->currentpage()-1) * $dsp->perpage() + $key + 1 }}</span>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td class="nama" style="text-align:center">
                                                        <strong>
                                                            {{ $dsps->nama }}
                                                        </strong>
                                                    </td>
                                                    <td class="jumlah_spm" style="text-align:center">
                                                        <strong>
                                                            {{ $dsps->jumlah_spm }}
                                                        </strong>
                                                    </td>
                                                    <td class="jumlah_dispensasi" style="text-align:center">
                                                        <strong>
                                                            {{ $dsps->jumlah_dispensasi }}
                                                        </strong>
                                                    </td>
                                                    <td class="ikpa" style="text-align:center">
                                                        @if($dsps->jumlah_spm == 0)
                                                        @php $nilai_ikpa = number_format(0, 2); @endphp
                                                        @else
                                                        @php $nilai_ikpa = number_format(($dsps->jumlah_dispensasi / $dsps->jumlah_spm) * 1000, 2); @endphp
                                                        @endif

                                                        @php $nilai = 0; @endphp

                                                        @php $nilai_ikpa == 0 ? $nilai = 100 : ($nilai_ikpa >= 0.01 && $nilai_ikpa <= 0.099 ? $nilai=95 : ($nilai_ikpa>= 0.1 && $nilai_ikpa <= 0.99 ? $nilai=90 : ($nilai_ikpa>= 1 && $nilai_ikpa <= 4.99 ? $nilai=85 : $nilai=80))) @endphp <strong> {{ $nilai }} </strong>

                                                        @php $ikpa_dispensasi[$dsps->id_opd] = $nilai; @endphp
                                                    </td>
                                                    <td style="text-align:center">
                                                        @php $id = Illuminate\Support\Facades\Crypt::encrypt($dsps->id_ds) @endphp
                                                        <a href="dispensasi-spm/edit/{{ $id }}" class="details btn btn-info btn-md">Edit</a>
                                                        <form method="POST" action="{{ route('dispensasi.delete', $dsps->id_ds) }}">
                                                            @csrf
                                                            <input type="hidden" name="destroy" value="DELETE">
                                                            <button style="margin-top: 10px" type="submit" class="btn btn-xs btn-danger show_confirm">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @php Session::put('dispensasi', $ikpa_dispensasi); @endphp
                                            </tbody>
                                        </table>
                            </div>
                            <!-- Card footer -->
                            <div class="card-footer py-4">
                                <nav aria-label="...">
                                    <ul class="pagination justify-content-end mb-0">
                                        <h3 class="mb-0">{{ $dsp->withQueryString()->links() }}</h3>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @include('layouts.footers.auth')
    </div>
    <!-- Footer -->

    <!-- Modal -->


</div>
@endsection
@push('js')
                <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
                <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
                <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
                <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
                <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
                <!-- Argon JS -->
                <script src="../assets/js/argon.js?v=1.2.0"></script>

                <script>
                    document.getElementById('mygraph').style.height = my_height + "px";
                </script>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
                <script type="text/javascript">
                    $('.show_confirm').click(function(event) {
                        var form = $(this).closest("form");
                        var name = $(this).data("name");
                        event.preventDefault();
                        swal({
                                title: `Apakah Anda yakin akan menghapus?`,
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    form.submit();
                                }
                            });
                    });
                </script>
@endpush

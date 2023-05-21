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
                                    <h3 class="mb-0">Penyerapan Anggaran</h3>
                                </div>
                                <div class="col-lg-6 col-5 text-right">
                                    <a href="{{ route('penyerapan.create') }}"
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
                                        <form action="/penyerapan/cari" method="GET">
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
                                                    <th scope="col" class="sort" data-sort="p_pegawai" style="text-align:center;font-size:12px;"> Pagu Belanja Pegawai </th>
                                                    <th scope="col" class="sort" data-sort="t_pegawai" style="text-align:center;font-size:12px;"> Target Belanja Pegawai </th>
                                                    <th scope="col" class="sort" data-sort="r_pegawai" style="text-align:center;font-size:12px;"> Penyerapan Belanja Pegawai </th>
                                                    <th scope="col" class="sort" data-sort="p_barjas" style="text-align:center;font-size:12px;"> Pagu Belanja Barang & Jasa </th>
                                                    <th scope="col" class="sort" data-sort="t_barjas" style="text-align:center;font-size:12px;"> Target Belanja Barang & Jasa </th>
                                                    <th scope="col" class="sort" data-sort="r_barjas" style="text-align:center;font-size:12px;"> Penyerapan Belanja Barang & Jasa </th>
                                                    <th scope="col" class="sort" data-sort="p_modal" style="text-align:center;font-size:12px;"> Pagu Belanja Modal </th>
                                                    <th scope="col" class="sort" data-sort="t_modal" style="text-align:center;font-size:12px;"> Target Belanja Modal </th>
                                                    <th scope="col" class="sort" data-sort="r_modal" style="text-align:center;font-size:12px;"> Penyerapan Belanja Modal </th>
                                                    <th scope="col" class="sort" data-sort="p_bansos" style="text-align:center;font-size:12px;"> Pagu Belanja Bantuan Sosial </th>
                                                    <th scope="col" class="sort" data-sort="t_bansos" style="text-align:center;font-size:12px;"> Target Belanja Bantuan Sosial </th>
                                                    <th scope="col" class="sort" data-sort="r_bansos" style="text-align:center;font-size:12px;"> Penyerapan Belanja Bantuan Sosial </th>
                                                    <th scope="col" class="sort" data-sort="p_subsidi" style="text-align:center;font-size:12px;"> Pagu Belanja Subsidi </th>
                                                    <th scope="col" class="sort" data-sort="t_subsidi" style="text-align:center;font-size:12px;"> Target Belanja Subsidi </th>
                                                    <th scope="col" class="sort" data-sort="r_subsidi" style="text-align:center;font-size:12px;"> Penyerapan Belanja Subsidi </th>
                                                    <th scope="col" class="sort" data-sort="p_hibah" style="text-align:center;font-size:12px;"> Pagu Belanja Hibah </th>
                                                    <th scope="col" class="sort" data-sort="t_hibah" style="text-align:center;font-size:12px;"> Target Belanja Hibah </th>
                                                    <th scope="col" class="sort" data-sort="r_hibah" style="text-align:center;font-size:12px;"> Penyerapan Belanja Hibah </th>
                                                    <th scope="col" class="sort" data-sort="ikpa" style="text-align:center;font-size:12px;"> Nilai IKPA </th>
                                                    <th scope="col" class="sort" style="text-align:center;font-size:12px;"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                @foreach ($py as $key => $pys)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="media align-items-center">
                                                            <div class="media-body" style="text-align:center">
                                                                <span class="name mb-0 text-sm">{{ ($py->currentpage()-1) * $py->perpage() + $key + 1 }}</span>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td class="nama" style="text-align:center">
                                                        <strong>
                                                            {{ $pys->nama }}
                                                        </strong>
                                                    </td>
                                                    <td class="p_pegawai" style="text-align:center">
                                                        <strong>
                                                            {{ "Rp" . number_format($pys->p_pegawai, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="t_pegawai" style="text-align:center">
                                                        @php $t_pegawai = $pys->p_pegawai * (20/100); @endphp
                                                        <strong>
                                                            {{ "Rp" . number_format($t_pegawai, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="r_pegawai" style="text-align:center">
                                                        <strong>
                                                            {{ "Rp" . number_format($pys->r_pegawai, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="p_barjas" style="text-align:center">
                                                        <strong>
                                                            {{ "Rp" . number_format($pys->p_barjas, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="t_barjas" style="text-align:center">
                                                        @php $t_barjas = $pys->p_barjas * (15/100); @endphp
                                                        <strong>
                                                            {{ "Rp" . number_format($t_barjas, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="r_barjas" style="text-align:center">
                                                        <strong>
                                                            {{ "Rp" . number_format($pys->r_barjas, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="p_modal" style="text-align:center">
                                                        <strong>
                                                            {{ "Rp" . number_format($pys->p_modal, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="t_modal" style="text-align:center">
                                                        @php $t_modal = $pys->p_modal * (10/100); @endphp
                                                        <strong>
                                                            {{ "Rp" . number_format($t_modal, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="r_modal" style="text-align:center">
                                                        <strong>
                                                            {{ "Rp" . number_format($pys->r_modal, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="p_bansos" style="text-align:center">
                                                        <strong>
                                                            {{ "Rp" . number_format($pys->p_bansos, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="t_bansos" style="text-align:center">
                                                        @php $t_bansos = $pys->p_bansos * (25/100); @endphp
                                                        <strong>
                                                            {{ "Rp" . number_format($t_bansos, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="r_bansos" style="text-align:center">
                                                        <strong>
                                                            {{ "Rp" . number_format($pys->r_bansos, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="p_subsidi" style="text-align:center">
                                                        <strong>
                                                            {{ "Rp" . number_format($pys->p_subsidi, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="t_subsidi" style="text-align:center">
                                                        @php $t_subsidi = $pys->p_subsidi * (25/100); @endphp
                                                        <strong>
                                                            {{ "Rp" . number_format($t_subsidi, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="r_subsidi" style="text-align:center">
                                                        <strong>
                                                            {{ "Rp" . number_format($pys->r_subsidi, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="p_hibah" style="text-align:center">
                                                        <strong>
                                                            {{ "Rp" . number_format($pys->p_hibah, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="t_hibah" style="text-align:center">
                                                        @php $t_hibah = $pys->p_hibah * (25/100); @endphp
                                                        <strong>
                                                            {{ "Rp" . number_format($t_hibah, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="r_hibah" style="text-align:center">
                                                        <strong>
                                                            {{ "Rp" . number_format($pys->r_hibah, 2, ',','.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="ikpa" style="text-align:center">
                                                        @php $t_kumulatif = $t_pegawai + $t_barjas + $t_modal + $t_bansos + $t_subsidi + $t_hibah; @endphp
                                                        @php $r_kumulatif = $pys->r_pegawai + $pys->r_barjas + $pys->r_modal + $pys->r_bansos + $pys->r_subsidi + $pys->r_hibah; @endphp
                                                        @php $ikpa = ($r_kumulatif / $t_kumulatif) * 100; @endphp
                                                        @if($ikpa > 100)
                                                        @php $nilai_ikpa = number_format(100, 2); @endphp
                                                        @else
                                                        @php $nilai_ikpa = number_format($ikpa, 2); @endphp
                                                        @endif

                                                        <strong>
                                                            {{ number_format($nilai_ikpa, 2) }}
                                                        </strong>
                                                    </td>
                                                    <td style="text-align:center">
                                                        @php $id = Illuminate\Support\Facades\Crypt::encrypt($pys->id_py) @endphp
                                                        <a href="{{ url('/penyerapan/edit', [$id]) }}" class="details btn btn-info btn-md">Edit</a>
                                                        <form method="POST" action="{{ route('penyerapan.delete', $pys->id_py) }}">
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
                                        <h3 class="mb-0">{{ $py->withQueryString()->links() }}</h3>
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

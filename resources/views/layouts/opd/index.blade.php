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
                                    <h3 class="mb-0">Daftar Organisasi Perangkat Daerah</h3>
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
										<form action="/opd/cari" method="GET">
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
                                                    <th scope="col" class="sort" data-sort="nama" style="text-align:center;font-size:12px;"><strong> Organisasi Perangkat Daerah</strong></th>
                                                    <th scope="col" class="sort" data-sort="n_ikpa" style="text-align:center;font-size:12px;"><strong> Nilai IKPA </strong></th>
                                                    <th scope="col" class="sort" style="text-align:center;font-size:12px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                @foreach ($opd as $key => $opds)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="media align-items-center">
                                                            <div class="media-body" style="text-align:center">
                                                                <span class="name mb-0 text-sm">{{ ($opd->currentpage()-1) * $opd->perpage() + $key + 1 }}</span>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td class="nama" style="text-align:center">
                                                        <strong>
                                                            {{ $opds->nama }}
                                                        </strong>
                                                    </td>
                                                    <td class="n_ikpa" style="text-align:center">
                                                        <strong>
                                                            {{ number_format($opds->n_ikpa, 2) }}
                                                        </strong>
                                                    </td>
                                                    <td style="text-align:center">
                                                        @php $id = Illuminate\Support\Facades\Crypt::encrypt($opds->id) @endphp
                                                        <a href="/opd/details/{{ $id }}" class="edit btn btn-info btn-md">Details</a>
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
                                        <h3 class="mb-0">{{ $opd->withQueryString()->links() }}</h3>
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


</div>
 @include('layouts.footers.auth')
@endsection
@push('js')
                <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
                <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
                <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
                <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
                <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
                <!-- Argon JS -->
                <script src="../assets/js/argon.js?v=1.2.0"></script>
@endpush

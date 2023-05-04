<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Detail {{ $title }}</title>
    <!-- Favicon -->
    <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body class="clickup-chrome-ext_installed">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Collapse header -->
                <div class="navbar-collapse-header d-md-none">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('argon') }}/img/brand/blue.png">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Form -->
                <form class="mt-4 mb-3 d-md-none">
                    <div class="input-group input-group-rounded input-group-merge">
                        <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fa fa-search"></span>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Navigation -->
                <ul class="navbar-nav">
                    @include('layouts.navbars.sidebar')
                </ul>
            </div>
        </div>
    </nav>
    <div class="main-content">
        <!-- Top navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Form -->
                <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                    <div class="form-group mb-0">
                    </div>
                </form>
                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg">
                                </span>
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">Admin</span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                                <i class="ni ni-user-run"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        </div>

        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <div class="card bg-default shadow">
                        <div class="card-header bg-transparent border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h2 class="text-white mb-0">Detail Kinerja Pelaksanaan Anggaran</h2>
                                    <h3 class="text-white mb-0"><strong> {{ $title }} </strong></h3>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-dark table-flush">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="pergeseran" style="text-align:left ;font-size:15px;"> Pergeseran Anggaran </th>
                                        <td class="pergeseran" style="text-align:center">
                                            @php $pg = Session::get('pergeseran'); @endphp
                                            @if(empty($pg[$id]))
                                            @php $nilai = number_format(0, 2); @endphp
                                            @else
                                            @php $nilai = $pg[$id] @endphp
                                            @endif
                                            <strong>
                                                {{ $nilai }}
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="deviasi" style="text-align:left ;font-size:15px;"> Deviasi Rencana Penarikan Dana </th>
                                        <td class="deviasi" style="text-align:center">

                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="penyerapan" style="text-align:left ;font-size:15px;"> Penyerapan Anggaran </th>
                                        <td class="penyerapan" style="text-align:center">
                                            @php $py = Session::get('penyerapan'); @endphp
                                            @if(empty($py[$id]))
                                            @php $nilai = number_format(0, 2); @endphp
                                            @else
                                            @php $nilai = $py[$id] @endphp
                                            @endif
                                            <strong>
                                                {{ $nilai }}
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="pengelolaan" style="text-align:left ;font-size:15px;"> Pengelolaan UP dan TUP </th>
                                        <td class="pengelolaan" style="text-align:center">

                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="dispensasi" style="text-align:left ;font-size:15px;"> Dispensasi SPM </th>
                                        <td class="dispensasi" style="text-align:center">
                                            @php $ds = Session::get('dispensasi'); @endphp
                                            @if(empty($ds[$id]))
                                            @php $nilai = number_format(0, 2); @endphp
                                            @else
                                            @php $nilai = $ds[$id] @endphp
                                            @endif
                                            <strong>
                                                {{ number_format($nilai, 2) }}
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="output" style="text-align:left ;font-size:15px;"> Capaian Output </th>
                                        <td class="output" style="text-align:center">

                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="nilai" style="text-align:left;font-size:15px;"><strong> Nilai IKPA Kumulatif </strong></th>
                                        <td class="output" style="text-align:center">

                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer py-4">
                            <nav class="d-flex justify-content-end" aria-label="...">

                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer pt-0">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6">
                        <div class="copyright text-center text-xl-left text-muted">
                            &copy; {{ now()->year }} <a href="https://bkad.kaltaraprov.go.id/" class="font-weight-bold ml-1" target="_blank">Badan Keuangan dan Aset Daerah Provinsi Kalimantan Utara</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>


    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Argon JS -->
    <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
</body>

</html>
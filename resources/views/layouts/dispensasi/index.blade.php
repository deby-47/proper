<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Dispensasi SPM</title>
    <!-- Favicon -->
    <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<style>
    .container {
        width: 105px;
        height: 140px;
        margin-top: 20px;
        background-image: url("https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Coat_of_arms_of_North_Kalimantan_%282021_version%29.svg/1200px-Coat_of_arms_of_North_Kalimantan_%282021_version%29.svg.png");
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>

<body>
    <!-- Sidenav -->
    @include('layouts.navbars.sidebar')
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Search form -->
                    <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                        <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </form>
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center  ml-md-auto ">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item d-sm-none">
                            <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                                <i class="ni ni-zoom-split-in"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ni ni-bell-55"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">
                                    </span>
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">User</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome!</h6>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a href="#!" class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header -->
        <div class="header bg-primary pb-6 ">
            <div class="container-fluid">
                <div class="right">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md">
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a href="{{ route('dispensasi.create') }}" class="btn btn-sm btn-neutral">Tambah Data Dispensasi SPM</a>
                        </div> <br />
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
            @elseif(Session::has('warning'))
            <div class="alert alert-warning">
                {{Session::get('warning')}}
            </div>
            @endif
            <div class="row">
                <div class="col">
                    <div class="card">

                        <!-- Dark table -->
                        <div class="row">
                            <div class="col">
                                <div class="card bg-default shadow">
                                    <div class="card-header bg-transparent border-0">
                                        <h3 class="text-white mb-0">Dispensasi SPM</h3>
                                    </div>
                                    <div class="table-responsive">
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
                                        <table class="table align-items-center table-dark table-flush">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col" class="sort" data-sort="no" style="text-align:center;font-size:12px;">No</th>
                                                    <th scope="col" class="sort" data-sort="nama" style="text-align:center;font-size:12px;"><strong> Organisasi Perangkat Daerah</strong></th>
                                                    <th scope="col" class="sort" data-sort="jumlah_spm" style="text-align:center;font-size:12px;"><strong> Total SPM </strong></th>
                                                    <th scope="col" class="sort" data-sort="jumlah_dispensasi" style="text-align:center;font-size:12px;"><strong> Total SPM Dispensasi </strong></th>
                                                    <th scope="col" class="sort" data-sort="ikpa" style="text-align:center;font-size:12px;"><strong> Nilai IKPA Pergeseran Anggaran </strong></th>
                                                    <th scope="col" class="sort" style="text-align:center;font-size:12px;"><strong> Action </strong></th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
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

                                                        @php $nilai_ikpa == 0 ? $nilai = 100 : ($nilai_ikpa >= 0.01 && $nilai_ikpa <= 0.099 ? $nilai=95 : ($nilai_ikpa>= 0.1 && $nilai_ikpa <= 0.99 ? $nilai=90 : ($nilai_ikpa>= 1 && $nilai_ikpa <= 4.99 ? $nilai=85 : $nilai=80))) @endphp <strong>
                                                                    {{ $nilai }}
                                                                    </strong>
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
                <!-- Argon Scripts -->
                <!-- Core -->
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
</body>

</html>
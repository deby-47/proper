@extends('layouts.deviasi.app')
<title>Ubah Data Deviasi</title>
<style>
    .box-form {
        height: 600px;
        overflow-y: auto;
        overflow-x: hidden;
    }
</style>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</head>

<body>
    @include('layouts.navbars.sidebar')
    <div class="mt-3" style="position:fixed; left: 820px;">
        <h2 class="mb-0">Ubah Data Deviasi RPD</h2>
    </div>
    <div class="header bg-gradient" style="position:fixed; left: 300px; right: 80px; top: 100px;">
        <div class="container-fluid mt--7">
            <div class="header-body mt-7 mb-7">
                <div class="col-xs-6" style="position:fixed; left: 300px; right: 80px;">
                    @foreach ($dv as $dvs)
                    <form method="POST" class="box-form">
                        @csrf
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="opd">Organisasi Perangkat Daerah</label>
                            <input value="{{ $dvs->nama }}" id="opd" type="text" class="form-control" name="opd" disabled>
                        </div>
                        <div class="form-group">
                            <label for="n_rpd">Total Rencana Penarikan Dana</label>
                            <input value="{{ $dvs->n_rpd }}" id="n_rpd" type="text" class="form-control" name="n_rpd" required>
                        </div>
                        <div class="form-group">
                            <label for="n_realisasi">Total Realisasi</label>
                            <input value="{{ $dvs->n_realisasi }}" id="n_realisasi" type="text" class="form-control" name="n_realisasi" required>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('deviasi.index') }}" class="btn btn-primary">Kembali</a>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
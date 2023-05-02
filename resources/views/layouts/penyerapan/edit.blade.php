@extends('layouts.penyerapan.app')
<title>Ubah Data Penyerapan</title>
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
        <h2 class="mb-0">Ubah Data Penyerapan Anggaran</h2>
    </div>
    <div class="header bg-gradient" style="position:fixed; left: 300px; right: 80px; top: 100px;">
        <div class="container-fluid mt--7">
            <div class="header-body mt-7 mb-7">
                <div class="col-xs-6" style="position:fixed; left: 300px; right: 80px;">
                    @foreach ($py as $pys)
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
                            <input value="{{ $pys->nama }}" id="opd" type="text" class="form-control" name="opd" disabled>
                        </div>
                        <div class="form-group">
                            <label for="p_pegawai">Pagu Belanja Pegawai</label>
                            <input value="{{ $pys->p_pegawai }}" id="p_pegawai" type="text" class="form-control" name="p_pegawai" required>
                        </div>
                        <div class="form-group">
                            <label for="p_barjas">Pagu Belanja Barang & Jasa</label>
                            <input value="{{ $pys->p_barjas }}" id="p_barjas" type="text" class="form-control" name="p_barjas" required>
                        </div>
                        <div class="form-group">
                            <label for="p_modal">Pagu Belanja Modal</label>
                            <input value="{{ $pys->p_modal }}" id="p_modal" type="text" class="form-control" name="p_modal" required>
                        </div>
                        <div class="form-group">
                            <label for="p_bansos">Pagu Belanja Bantuan Sosial & Hibah</label>
                            <input value="{{ $pys->p_bansos }}" id="p_bansos" type="text" class="form-control" name="p_bansos" required>
                        </div>
                        <div class="form-group">
                            <label for="r_pegawai">Realisasi Belanja Pegawai</label>
                            <input value="{{ $pys->r_pegawai }}" id="r_pegawai" type="text" class="form-control" name="r_pegawai" required>
                        </div>
                        <div class="form-group">
                            <label for="r_barjas">Realisasi Belanja Barang & Jasa</label>
                            <input value="{{ $pys->r_barjas }}" id="r_barjas" type="text" class="form-control" name="r_barjas" required>
                        </div>
                        <div class="form-group">
                            <label for="r_modal">Realisasi Belanja Modal</label>
                            <input value="{{ $pys->r_modal }}" id="r_modal" type="text" class="form-control" name="r_modal" required>
                        </div>
                        <div class="form-group">
                            <label for="r_bansos">Realisasi Belanja Bantuan Sosial & Hibah</label>
                            <input value="{{ $pys->r_bansos }}" id="r_bansos" type="text" class="form-control" name="r_bansos" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
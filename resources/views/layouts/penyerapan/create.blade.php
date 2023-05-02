@extends('layouts.penyerapan.app')
<title>Tambah Data Penyerapan</title>
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
        <h2 class="mb-0">Tambah Data Penyerapan Anggaran</h2>
    </div>
    <div class="header bg-gradient" style="position:fixed; left: 300px; right: 80px; top: 100px;">
        <div class="container-fluid mt--7">
            <div class="header-body mt-7 mb-7">
                <div class="col-xs-6" style="position:fixed; left: 300px; right: 80px;">
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
                            <label for="opd">Organisasi Perangkat Daerah</label><br />
                            <select id="opd" class="custom-select" name="opd" style="width:100%" required>
                                <option selected>Pilih Organisasi Perangkat Daerah</option>
                                @foreach (App\Models\Opd::selectOpd() as $o)
                                <option value="{{ $o->id }}">{{ $o->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="p_pegawai">Pagu Belanja Pegawai</label>
                            <input id="p_pegawai" type="text" class="form-control" name="p_pegawai" placeholder="Pagu Belanja Pegawai" required>
                        </div>
                        <div class="form-group">
                            <label for="p_barjas">Pagu Belanja Barang & Jasa</label>
                            <input id="p_barjas" type="text" class="form-control" name="p_barjas" placeholder="Pagu Belanja Barang & Jasa" required>
                        </div>
                        <div class="form-group">
                            <label for="p_modal">Pagu Belanja Modal</label>
                            <input id="p_modal" type="text" class="form-control" name="p_modal" placeholder="Pagu Belanja Modal" required>
                        </div>
                        <div class="form-group">
                            <label for="p_bansos">Pagu Belanja Bantuan Sosial & Hibah</label>
                            <input id="p_bansos" type="text" class="form-control" name="p_bansos" placeholder="Pagu Belanja Bantuan Sosial" required>
                        </div>
                        <div class="form-group">
                            <label for="r_pegawai">Realisasi Belanja Pegawai</label>
                            <input id="r_pegawai" type="text" class="form-control" name="r_pegawai" placeholder="Realisasi Belanja Pegawai" required>
                        </div>
                        <div class="form-group">
                            <label for="r_barjas">Realisasi Belanja Barang & Jasa</label>
                            <input id="r_barjas" type="text" class="form-control" name="r_barjas" placeholder="Realisasi Belanja Barang & Jasa" required>
                        </div>
                        <div class="form-group">
                            <label for="r_modal">Realisasi Belanja Modal</label>
                            <input id="r_modal" type="text" class="form-control" name="r_modal" placeholder="Realisasi Belanja Modal" required>
                        </div>
                        <div class="form-group">
                            <label for="r_bansos">Realisasi Belanja Bantuan Sosial & Hibah</label>
                            <input id="r_bansos" type="text" class="form-control" name="r_bansos" placeholder="Realisasi Belanja Bantuan Sosial & Hibah" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#opd').select2();
    </script>
</body>
@extends('layouts.welcome.welcome-app', ['class' => 'bg-default'])

@section('content')
<div class="container">
    <div class="header-body text-center mt-9 mb-7 ml-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-6">
                <h1 class="text-black" style=font-size:50px>{{ __('SAPPA - PERADI') }}</h1>
                <h2 class="text-black" style=font-size:25px>{{ __('Sistem Analisis Penilaian Pelaksanaan Anggaran - Perangkat Daerah Berintegritas') }}</h2>
            </div>
        </div>
    </div>
</div>

@endsection
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RealisasiKeuanganController extends Controller
{
    public function index()
    {
        $rks = DB::table('tab_realisasi_keuangan')
        ->join('tab_opd', 'tab_realisasi_keuangan.id_opd', '=', 'tab_opd.id')
        ->where('tab_realisasi_keuangan.status', '=', 1)
        ->paginate(10);

        return view('layouts.realisasi-keuangan.index', [
            'rk' => $rks,
        ]);
    }
}

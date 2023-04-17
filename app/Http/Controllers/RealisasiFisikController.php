<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RealisasiFisikController extends Controller
{
    public function index()
    {
        $rfs = DB::table('tab_realisasi_fisik')
        ->join('tab_opd', 'tab_realisasi_fisik.id_opd', '=', 'tab_opd.id')
        ->where('tab_realisasi_fisik.status', '=', 1)
        ->paginate(10);

        return view('layouts.realisasi-fisik.index', [
            'rf' => $rfs,
        ]);
    }
}

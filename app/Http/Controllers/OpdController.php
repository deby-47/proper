<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OpdController extends Controller
{
    public function index()
    {
        $opds = DB::table('tab_opd')
            ->leftJoin('tab_ikpa', 'tab_ikpa.id_opd', '=', 'tab_opd.id')
            ->where('status', '=', 1)
            ->orderBy('tab_opd.id', 'ASC')
            ->paginate(10);

        return view('layouts.opd.index', [
            'opd' => $opds,
        ]); // return with view
    }

    public function search(Request $request)
    {
        $search = $request->search;
        Session::put('pg_url', request()->fullUrl());

        $opds = DB::table('tab_opd')
            ->leftJoin('tab_ikpa', 'tab_ikpa.id_opd', '=', 'tab_opd.id')
            ->where('nama', 'LIKE', '%' . $search . '%')
            ->where('status', 1)
            ->orderBy('nama', 'ASC')
            ->paginate(10);

        return view('layouts.opd.index', [
            'opd' => $opds
        ]);
    }

    public function details(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $n_pergeseran = DB::table('tab_ikpa')->where('id_opd', $id)->pluck('n_pergeseran')->first();
        $n_deviasi = DB::table('tab_ikpa')->where('id_opd', $id)->pluck('n_deviasi')->first();
        $n_penyerapan = DB::table('tab_ikpa')->where('id_opd', $id)->pluck('n_penyerapan')->first();
        $n_up = DB::table('tab_ikpa')->where('id_opd', $id)->pluck('n_up')->first();
        $n_dispensasi = DB::table('tab_ikpa')->where('id_opd', $id)->pluck('n_dispensasi')->first();
        $n_output = DB::table('tab_ikpa')->where('id_opd', $id)->pluck('n_output')->first();

        $n_ikpa = ($n_pergeseran * (15 / 100)) + ($n_deviasi * (15 / 100)) + ($n_penyerapan * (25 / 100)) +
            ($n_up * (10 / 100)) + ($n_dispensasi * (5 / 100)) + ($n_output * (30 / 100));
        DB::table('tab_ikpa')->where('id_opd', $id)->update(['n_ikpa' => $n_ikpa]);

        $opds = DB::table('tab_opd')
            ->join('tab_ikpa', 'tab_ikpa.id_opd', '=', 'tab_opd.id')
            ->where('tab_opd.status', '=', 1)
            ->where('tab_opd.id', $id)
            ->orderBy('tab_opd.id', 'ASC')
            ->get();
        $title = DB::table('tab_opd')
            ->where('id',  $id)
            ->pluck('nama')
            ->first();

        return view('layouts.opd.details', [
            'title' => $title,
            'id' => $id,
            'opd' => $opds
        ]);
    }
}

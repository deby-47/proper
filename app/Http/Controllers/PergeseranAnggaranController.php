<?php

namespace App\Http\Controllers;

use App\Models\PergeseranAnggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PergeseranAnggaranController extends Controller
{
    public function index()
    {
        $pgs = DB::table('tab_pergeseran')
        ->join('tab_opd', 'tab_pergeseran.id_opd', '=', 'tab_opd.id')
        ->where('tab_pergeseran.status', '=', 1)
        ->paginate(10);

        return view('layouts.pergeseran.index', [
            'pg' => $pgs
        ]);
    }

    public function create()
    {
        return view('layouts.pergeseran.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'opd' => 'required|numeric',
            'frekuensi' => 'required|numeric'
        ];
        $msg = [
            'opd.required' => 'Organisasi Perangkat Daerah harus diisi.',
            'frekuensi.numeric' => 'Frekuensi harus berupa angka.',
            'frekuensi.required' => 'Frekuensi harus diisi.'
        ];

        $this->validate($request, $rules, $msg);

        $pgs = new PergeseranAnggaran;
        $pgs->id_opd = $request->opd;
        $pgs->frekuensi_revisi = $request->frekuensi;
        $pgs->save();

        Alert::success('Sukses!', 'Data berhasil tersimpan');
        return view('layouts.pergeseran.create');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PergeseranAnggaran;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class PergeseranAnggaranController extends Controller
{
    public function index()
    {
        $pgs = DB::table('tab_pergeseran')
        ->join('tab_opd', 'tab_pergeseran.id_opd', '=', 'tab_opd.id')
        ->where('tab_pergeseran.status', '=', 1)
        ->paginate(10);

        Session::put('pg_url', request()->fullUrl());

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

    public function edit(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $pg = DB::table('tab_pergeseran')
            ->join('tab_opd', 'tab_pergeseran.id_opd', '=', 'tab_opd.id')
            ->where('tab_pergeseran.status', '=', 1)
            ->where('tab_pergeseran.id_pg', $id)
            ->get();
        
        return view('layouts.pergeseran.edit', [
            'pg' => $pg
        ]);
    }

    public function update(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $rules = [
            'frekuensi' => 'required|numeric'
        ];
        $msg = [
            'frekuensi.numeric' => 'Frekuensi harus berupa angka.',
            'frekuensi.required' => 'Frekuensi harus diisi.'
        ];

        $this->validate($request, $rules, $msg);

        DB::table('tab_pergeseran')->where('id_pg', $id)->update([
            'frekuensi_revisi' => $request->frekuensi
        ]);

        // return Redirect::to(Session::get('pg_url'));
        return redirect(Session::get('pg_url'))->with('success','Data berhasi diubah!');
    }

    public function delete($id)
    {
        // PergeseranAnggaran::find($id);
        DB::table('tab_pergeseran')->where('id_pg', $id)->update([
            'status' => 0
        ]);
        
        
        return redirect(Session::get('pg_url'))->with('info','Data berhasi dihapus!');
    }
}

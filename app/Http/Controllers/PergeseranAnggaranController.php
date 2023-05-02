<?php

namespace App\Http\Controllers;

use App\Models\PergeseranAnggaran;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PergeseranAnggaranController extends Controller
{
    public function index()
    {
        $pgs = DB::table('tab_pergeseran')
            ->join('tab_opd', 'tab_pergeseran.id_opd', '=', 'tab_opd.id')
            ->select('tab_pergeseran.id_opd', 'tab_opd.nama', DB::raw('count(id_opd) as opd'))
            ->groupBy('tab_opd.nama', 'tab_pergeseran.id_opd')
            ->where('tab_pergeseran.status', 1)
            ->paginate(10);

        Session::put('pg_url', request()->fullUrl());

        return view('layouts.pergeseran.index', [
            'pg' => $pgs
        ]);
    }

    public function details($id_opd)
    {
        $id = Crypt::decrypt($id_opd);

        $details = DB::table('tab_pergeseran')
            ->join('tab_opd', 'tab_pergeseran.id_opd', '=', 'tab_opd.id')
            ->where('id_opd', '=', $id)
            ->orderBy('tab_pergeseran.tanggal')
            ->where('tab_pergeseran.status', 1)
            ->paginate(10);

        $title = DB::table('tab_opd')
            ->join('tab_pergeseran', 'tab_pergeseran.id_opd', '=', 'tab_opd.id')
            ->where('id',  $id)
            ->pluck('nama')
            ->first();

        Session::put('details_url', request()->fullUrl());

        return view('layouts.pergeseran.details', [
            'detail' => $details,
            'title' => $title
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
            'keterangan' => 'required',
            'tanggal' => 'required'
        ];
        $msg = [
            'opd.required' => 'Organisasi Perangkat Daerah harus dipilih.',
            'opd.numeric' => 'Organisasi Perangkat Daerah harus dipilih.',
            'keterangan.required' => 'Keterangan harus diisi.',
            'tanggal.required' => 'Tanggal harus dipilih.'
        ];

        $this->validate($request, $rules, $msg);

        $pgs = new PergeseranAnggaran;
        $pgs->id_opd = $request->opd;
        $pgs->keterangan = $request->keterangan;
        $pgs->tanggal = $request->tanggal;
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
            'keterangan' => 'required',
            'tanggal' => 'required'
        ];
        $msg = [
            'keterangan.required' => 'Keterangan harus diisi.',
            'tanggal.required' => 'Tanggal harus dipilih.'
        ];

        $this->validate($request, $rules, $msg);

        DB::table('tab_pergeseran')->where('id_pg', $id)->update([
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'updated_at' => now()
        ]);

        // return Redirect::to(Session::get('pg_url'));
        return redirect(Session::get('pg_url'))->with('success', 'Data berhasi diubah!');
    }

    public function delete($id)
    {
        // PergeseranAnggaran::find($id);
        DB::table('tab_pergeseran')->where('id_pg', $id)->update([
            'status' => 0
        ]);

        return redirect(Session::get('details_url'))->with('info', 'Data berhasi dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        Session::put('pg_url', request()->fullUrl());

        $pgs = DB::table('tab_pergeseran')
            ->join('tab_opd', 'tab_pergeseran.id_opd', '=', 'tab_opd.id')
            ->select('tab_pergeseran.id_opd', 'tab_opd.nama', DB::raw('count(id_opd) as opd'))
            ->groupBy('tab_opd.nama', 'tab_pergeseran.id_opd')
            ->where('nama', 'LIKE', '%' . $search . '%')
            ->where('tab_pergeseran.status', 1)
            ->paginate(10);

        return view('layouts.pergeseran.index', [
            'pg' => $pgs
        ]);
    }
}

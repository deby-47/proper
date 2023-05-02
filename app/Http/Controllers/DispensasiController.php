<?php

namespace App\Http\Controllers;

use App\Models\DispensasiSPM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class DispensasiController extends Controller
{
    public function index()
    {
        $dsps = DB::table('tab_dispensasi')
            ->join('tab_opd', 'tab_dispensasi.id_opd', '=', 'tab_opd.id')
            ->orderBy('tab_dispensasi.id_ds', 'ASC')
            ->where('tab_dispensasi.status', 1)
            ->paginate(10);

        Session::put('dsp_url', request()->fullUrl());

        return view('layouts.dispensasi.index', [
            'dsp' => $dsps
        ]);
    }

    public function create()
    {
        return view('layouts.dispensasi.create');
    }

    public function store(Request $request)
    {
        $pgs = new DispensasiSPM();
        $pgs->id_opd = $request->opd;
        $pgs->jumlah_spm = $request->jumlah_spm;
        $pgs->jumlah_dispensasi = $request->jumlah_dispensasi;
        $pgs->save();

        Alert::success('Sukses!', 'Data berhasil tersimpan');
        return view('layouts.dispensasi.create');
    }

    public function edit(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $dispen = DB::table('tab_dispensasi')
            ->join('tab_opd', 'tab_dispensasi.id_opd', '=', 'tab_opd.id')
            ->where('tab_dispensasi.status', '=', 1)
            ->where('tab_dispensasi.id_ds', $id)
            ->get();

        return view('layouts.dispensasi.edit', [
            'dsp' => $dispen
        ]);
    }

    public function update(Request $request)
    {
        $id = Crypt::decrypt($request->id);

        DB::table('tab_dispensasi')->where('id_ds', $id)->update([
            'jumlah_spm' => $request->jumlah_spm,
            'jumlah_dispensasi' => $request->jumlah_dispensasi,
            'updated_at' => now()
        ]);

        return redirect(Session::get('dsp_url'))->with('success', 'Data berhasi diubah!');
    }

    public function delete($id)
    {
        DB::table('tab_dispensasi')->where('id_ds', $id)->update([
            'status' => 0
        ]);

        return redirect(Session::get('dsp_url'))->with('warning', 'Data berhasi dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        Session::put('dsp_url', request()->fullUrl());

        $dsps = DB::table('tab_dispensasi')
            ->join('tab_opd', 'tab_opd.id', '=', 'tab_dispensasi.id_opd')
            ->where('nama', 'LIKE', '%' . $search . '%')
            ->where('tab_dispensasi.status', '=', 1)
            ->paginate(10);

        return view('layouts.penyerapan.index', [
            'dsp' => $dsps
        ]);
    }
}

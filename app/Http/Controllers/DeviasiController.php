<?php

namespace App\Http\Controllers;

use App\Models\Deviasi;
use App\Models\NilaiIKPA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class DeviasiController extends Controller
{
    public function index()
    {
        $dvs = DB::table('tab_deviasi')
            ->join('tab_opd', 'tab_deviasi.id_opd', '=', 'tab_opd.id')
            ->where('tab_deviasi.status', '=', 1)
            ->orderBy('tab_deviasi.id_dv')
            ->paginate(10);
        
        Session::put('dv_url', request()->fullUrl());

        return view('layouts.deviasi.index', [
            'dv' => $dvs
        ]);
    }

    public function create()
    {
        return view('layouts.deviasi.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'opd' => 'required|numeric',
            'n_rpd' => 'required|numeric',
            'n_realisasi' => 'required|numeric'
        ];

        $msg = [
            'opd.required' => 'Organisasi Perangkat Daerah harus dipilih.',
            'opd.numeric' => 'Organisasi Perangkat Daerah harus dipilih.',
            'n_rpd.required' => 'Nilai RPD Daerah harus diisi.',
            'n_rpd.numeric' => 'Nilai RPD harus berupa angka.',
            'n_realisasi.required' => 'Nilai Realisasi harus diisi.',
            'n_realisasi.numeric' => 'Nilai Realisasi harus berupa angka.',
        ];

        $this->validate($request, $rules, $msg);

        $deviasi = new Deviasi;
        $deviasi->id_opd = $request->opd;
        $deviasi->n_rpd = $request->n_rpd;
        $deviasi->n_realisasi = $request->n_realisasi;
        $deviasi->save();

        $n_deviasi = (abs($deviasi->n_realisasi - $deviasi->n_rpd) / $deviasi->n_rpd) * 100;
        $ikpa = 100 - $n_deviasi;

        $nilai = new NilaiIKPA;
        $nilai->id_opd = $request->opd;

        $exist = DB::table('tab_ikpa')->where('id_opd', $request->opd)
            ->exists();

        if (!$exist) {
            $nilai->id_opd = $request->opd;
            $nilai->n_deviasi = $ikpa;
            $nilai->save();
        } else {
            DB::table('tab_ikpa')->where('id_opd', $request->opd)->update([
                'n_deviasi' => $ikpa,
                'updated_at' => now()
            ]);
        }

        Alert::success('Sukses!', 'Data berhasil tersimpan');
        return view('layouts.dispensasi.create');
    }

    public function edit(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $deviasi = DB::table('tab_deviasi')
                ->join('tab_opd', 'tab_opd.id', '=', 'tab_deviasi.id_opd')
                ->where('tab_deviasi.status', 1)
                ->where('tab_deviasi.id_dv', $id)
                ->get();
        
        return view('layouts.deviasi.edit', [
            'dv' => $deviasi
        ]);
    }

    public function update(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $rules = [
            'n_rpd' => 'required|numeric',
            'n_realisasi' => 'required|numeric'
        ];

        $msg = [
            'n_rpd.required' => 'Nilai RPD Daerah harus diisi.',
            'n_rpd.numeric' => 'Nilai RPD harus berupa angka.',
            'n_realisasi.required' => 'Nilai Realisasi harus diisi.',
            'n_realisasi.numeric' => 'Nilai Realisasi harus berupa angka.',
        ];

        $this->validate($request, $rules, $msg);

        DB::table('tab_deviasi')->where('id_dv', $id)->update([
            'n_rpd' => $request->n_rpd,
            'n_realisasi' => $request->n_realisasi,
            'updated_at' => now()
        ]);

        $id_opd = DB::table('tab_deviasi')->select('id_opd')->where('id_dv', $id)->pluck('id_opd')->first();

        $n_deviasi = (abs($request->n_realisasi - $request->n_rpd) / $request->n_rpd) * 100;
        $ikpa = 100 - $n_deviasi;

        $nilai = new NilaiIKPA;
        $nilai->id_opd = $request->opd;

        DB::table('tab_ikpa')->where('id_opd', $id_opd)->update([
            'n_deviasi' => $ikpa,
            'updated_at' => now()
        ]);

        return redirect(Session::get('dv_url'))->with('success', 'Data berhasil diubah!');
    }

    public function delete($id)
    {
        DB::table('tab_deviasi')->where('id_dv', $id)->update(['status' => 0]);

        $id_opd = DB::table('tab_deviasi')->select('id_opd')->where('id_dv', $id)->pluck('id_opd')->first();
        DB::table('tab_ikpa')->where('id_opd', $id_opd)->update([
            'n_deviasi' => 0,
            'updated_at' => now()
        ]);

        return redirect(Session::get('dv_url'))->with('warning', 'Data berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        Session::put('dv_url', request()->fullUrl());

        $dvs = DB::table('tab_deviasi')
            ->join('tab_opd', 'tab_opd.id', '=', 'tab_deviasi.id_opd')
            ->where('nama', 'LIKE', '%' . $search . '%')
            ->where('tab_deviasi.status', 1)
            ->paginate(10);

        return view('layouts.deviasi.index', [
            'dv' => $dvs
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PenyerapanAnggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class PenyerapanAnggaranController extends Controller
{
    public function index()
    {
        $pys = DB::table('tab_penyerapan')
            ->join('tab_opd', 'tab_penyerapan.id_opd', '=', 'tab_opd.id')
            ->where('tab_penyerapan.status', '=', 1)
            ->orderBy('tab_penyerapan.id_py')
            ->paginate(10);

        Session::put('py_url', request()->fullUrl());

        return view('layouts.penyerapan.index', [
            'py' => $pys
        ]); // return with view
    }

    public function create()
    {
        return view('layouts.penyerapan.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'opd' => 'required|numeric',
            'p_pegawai' => 'required',
            'p_barjas' => 'required',
            'p_modal' => 'required',
            'p_bansos' => 'required',
            'r_pegawai' => 'required',
            'r_barjas' => 'required',
            'r_modal' => 'required',
            'r_bansos' => 'required',
        ];

        $msg = [
            'opd.required' => 'Organisasi Perangkat Daerah harus dipilih.',
            'opd.numeric' => 'Organisasi Perangkat Daerah harus dipilih.',
            'p_pegawai.required' => 'Pagu Belanja Pegawai harus diisi.',
            'p_barjas.required' => 'Pagu Belanja Barang & Jasa harus diisi.',
            'p_modal.required' => 'Pagu Belanja Modal harus diisi.',
            'p_bansos.required' => 'Pagu Belanja Bantuan Sosial harus diisi.',
            'r_pegawai.required' => 'Realisasi Belanja Pegawai harus diisi.',
            'r_barjas.required' => 'Realisasi Belanja Barang & Jasa harus diisi.',
            'r_modal.required' => 'Realisasi Belanja Modal harus diisi.',
            'r_bansos.required' => 'Realisasi Belanja Bantuan Sosial harus diisi.',
        ];

        $this->validate($request, $rules, $msg);

        $pys = new PenyerapanAnggaran;
        $pys->id_opd = $request->opd;
        $pys->p_pegawai = $request->p_pegawai;
        $pys->p_barjas = $request->p_barjas;
        $pys->p_modal = $request->p_modal;
        $pys->p_bansos = $request->p_bansos;
        $pys->r_pegawai = $request->r_pegawai;
        $pys->r_barjas = $request->r_barjas;
        $pys->r_modal = $request->r_modal;
        $pys->r_bansos = $request->r_bansos;
        $pys->save();

        Alert::success('Sukses!', 'Data berhasil tersimpan');
        return view('layouts.pergeseran.create');
    }

    public function edit(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $py = DB::table('tab_penyerapan')
            ->join('tab_opd', 'tab_penyerapan.id_opd', '=', 'tab_opd.id')
            ->where('tab_penyerapan.status', '=', 1)
            ->where('tab_penyerapan.id_py', $id)
            ->get();

        return view('layouts.penyerapan.edit', [
            'py' => $py
        ]);
    }

    public function update(Request $request)
    {
        $id = Crypt::decrypt($request->id);

        $rules = [
            'p_pegawai' => 'required',
            'p_barjas' => 'required',
            'p_modal' => 'required',
            'p_bansos' => 'required',
            'r_pegawai' => 'required',
            'r_barjas' => 'required',
            'r_modal' => 'required',
            'r_bansos' => 'required',
        ];

        $msg = [
            'p_pegawai.required' => 'Pagu Belanja Pegawai harus diisi.',
            'p_barjas.required' => 'Pagu Belanja Barang & Jasa harus diisi.',
            'p_modal.required' => 'Pagu Belanja Modal harus diisi.',
            'p_bansos.required' => 'Pagu Belanja Bantuan Sosial harus diisi.',
            'r_pegawai.required' => 'Realisasi Belanja Pegawai harus diisi.',
            'r_barjas.required' => 'Realisasi Belanja Barang & Jasa harus diisi.',
            'r_modal.required' => 'Realisasi Belanja Modal harus diisi.',
            'r_bansos.required' => 'Realisasi Belanja Bantuan Sosial harus diisi.',
        ];

        $this->validate($request, $rules, $msg);

        DB::table('tab_penyerapan')->where('id_py', $id)->update([
            'p_pegawai' => $request->p_pegawai,
            'p_barjas' => $request->p_barjas,
            'p_modal' => $request->p_modal,
            'p_bansos' => $request->p_bansos,
            'r_pegawai' => $request->r_pegawai,
            'r_barjas' => $request->r_barjas,
            'r_modal' => $request->r_modal,
            'r_bansos' => $request->r_bansos,
            'updated_at' => now()
        ]);

        return redirect(Session::get('py_url'))->with('success', 'Data berhasi diubah!');
    }
}

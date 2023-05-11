<?php

namespace App\Http\Controllers;

use App\Models\NilaiIKPA;
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
            'p_pegawai' => 'required|numeric',
            'p_barjas' => 'required|numeric',
            'p_modal' => 'required|numeric',
            'p_bansos' => 'required|numeric',
            'p_subsidi' => 'required|numeric',
            'p_hibah' => 'required|numeric',
            'r_pegawai' => 'required|numeric',
            'r_barjas' => 'required|numeric',
            'r_modal' => 'required|numeric',
            'r_bansos' => 'required|numeric',
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
            'r_subsidi.required' => 'Realisasi Belanja Subsidi harus diisi.',
            'r_hibah.required' => 'Realisasi Belanja Hibah harus diisi.',
            'p_pegawai.numeric' => 'Pagu Belanja Pegawai harus berupa angka.',
            'p_barjas.numeric' => 'Pagu Belanja Barang & Jasa harus berupa angka.',
            'p_modal.numeric' => 'Pagu Belanja Modal harus berupa angka.',
            'p_bansos.numeric' => 'Pagu Belanja Bantuan Sosial harus berupa angka.',
            'r_pegawai.numeric' => 'Realisasi Belanja Pegawai harus berupa angka.',
            'r_barjas.numeric' => 'Realisasi Belanja Barang & Jasa harus berupa angka.',
            'r_modal.numeric' => 'Realisasi Belanja Modal harus berupa angka.',
            'r_bansos.numeric' => 'Realisasi Belanja Bantuan Sosial harus berupa angka..',
            'r_subsidi.numeric' => 'Realisasi Belanja Subsidi harus berupa angka.',
            'r_hibah.numeric' => 'Realisasi Belanja Hibah harus berupa angka.',
        ];

        $this->validate($request, $rules, $msg);

        $pys = new PenyerapanAnggaran;
        $pys->id_opd = $request->opd;
        $pys->p_pegawai = $request->p_pegawai;
        $pys->p_barjas = $request->p_barjas;
        $pys->p_modal = $request->p_modal;
        $pys->p_bansos = $request->p_bansos;
        $pys->p_subsidi = $request->p_subsidi;
        $pys->p_hibah = $request->p_hibah;
        $pys->r_pegawai = $request->r_pegawai;
        $pys->r_barjas = $request->r_barjas;
        $pys->r_modal = $request->r_modal;
        $pys->r_bansos = $request->r_bansos;
        $pys->r_subsidi = $request->r_hibah;
        $pys->r_hibah = $request->r_hibah;
        $pys->save();

        $t_pegawai = $pys->p_pegawai * (20 / 100);
        $t_barjas = $pys->p_barjas * (15 / 100);
        $t_modal = $pys->p_modal * (10 / 100);
        $t_bansos = $pys->p_bansos * (25 / 100);
        $t_subsidi = $pys->p_subsidi * (25 / 100);
        $t_hibah = $pys->p_hibah * (25 / 100);

        $t_kumulatif = $t_pegawai + $t_barjas + $t_modal + $t_bansos + $t_subsidi + $t_hibah;
        $r_kumulatif = $pys->r_pegawai + $pys->r_barjas + $pys->r_modal + $pys->r_bansos + $pys->r_subsidi + $pys->r_hibah;
        $ikpa = ($r_kumulatif / $t_kumulatif) * 100;

        $ikpa > 100 ? $ikpa = 100 : $ikpa;

        $nilai = new NilaiIKPA;
        $nilai->id_opd = $request->opd;

        $exist = DB::table('tab_ikpa')->where('id_opd', $request->opd)
            ->exists();

        if (!$exist) {
            $nilai->id_opd = $request->opd;
            $nilai->n_penyerapan = $ikpa;
            $nilai->save();
        } else {
            DB::table('tab_ikpa')->where('id_opd', $request->opd)->update([
                'n_penyerapan' => $ikpa,
                'updated_at' => now()
            ]);
        }

        Alert::success('Sukses!', 'Data berhasil tersimpan');
        return view('layouts.penyerapan.create');
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
            'p_pegawai' => 'required|numeric',
            'p_barjas' => 'required|numeric',
            'p_modal' => 'required|numeric',
            'p_bansos' => 'required|numeric',
            'p_subsidi' => 'required|numeric',
            'p_hibah' => 'required|numeric',
            'r_pegawai' => 'required|numeric',
            'r_barjas' => 'required|numeric',
            'r_modal' => 'required|numeric',
            'r_bansos' => 'required|numeric',
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
            'r_subsidi.required' => 'Realisasi Belanja Subsidi harus diisi.',
            'r_hibah.required' => 'Realisasi Belanja Hibah harus diisi.',
            'p_pegawai.numeric' => 'Pagu Belanja Pegawai harus berupa angka.',
            'p_barjas.numeric' => 'Pagu Belanja Barang & Jasa harus berupa angka.',
            'p_modal.numeric' => 'Pagu Belanja Modal harus berupa angka.',
            'p_bansos.numeric' => 'Pagu Belanja Bantuan Sosial harus berupa angka.',
            'r_pegawai.numeric' => 'Realisasi Belanja Pegawai harus berupa angka.',
            'r_barjas.numeric' => 'Realisasi Belanja Barang & Jasa harus berupa angka.',
            'r_modal.numeric' => 'Realisasi Belanja Modal harus berupa angka.',
            'r_bansos.numeric' => 'Realisasi Belanja Bantuan Sosial harus berupa angka..',
            'r_subsidi.numeric' => 'Realisasi Belanja Subsidi harus berupa angka.',
            'r_hibah.numeric' => 'Realisasi Belanja Hibah harus berupa angka.',
        ];

        $this->validate($request, $rules, $msg);

        DB::table('tab_penyerapan')->where('id_py', $id)->update([
            'p_pegawai' => $request->p_pegawai,
            'p_barjas' => $request->p_barjas,
            'p_modal' => $request->p_modal,
            'p_bansos' => $request->p_bansos,
            'p_subsidi' => $request->p_subsidi,
            'p_hibah' => $request->p_hibah,
            'r_pegawai' => $request->r_pegawai,
            'r_barjas' => $request->r_barjas,
            'r_modal' => $request->r_modal,
            'r_bansos' => $request->r_bansos,
            'r_subsidi' => $request->r_subsidi,
            'r_hibah' => $request->r_hibah,
            'updated_at' => now()
        ]);

        $id_opd = DB::table('tab_penyerapan')->select('id_opd')->where('id_py', $id)->pluck('id_opd')->first();

        $t_pegawai = $request->p_pegawai * (20 / 100);
        $t_barjas = $request->p_barjas * (15 / 100);
        $t_modal = $request->p_modal * (10 / 100);
        $t_bansos = $request->p_bansos * (25 / 100);
        $t_subsidi = $request->p_subsidi * (25 / 100);
        $t_hibah = $request->p_hibah * (25 / 100);

        $t_kumulatif = $t_pegawai + $t_barjas + $t_modal + $t_bansos + $t_subsidi + $t_hibah;
        $r_kumulatif = $request->r_pegawai + $request->r_barjas + $request->r_modal + $request->r_bansos + $request->r_subsidi + $request->r_hibah;
        $ikpa = ($r_kumulatif / $t_kumulatif) * 100;

        $ikpa > 100 ? $ikpa = 100 : $ikpa;

        $nilai = new NilaiIKPA;
        $nilai->id_opd = $request->opd;

        DB::table('tab_ikpa')->where('id_opd', $id_opd)->update([
            'n_penyerapan' => $ikpa,
            'updated_at' => now()
        ]);

        return redirect(Session::get('py_url'))->with('success', 'Data berhasi diubah!');
    }

    public function delete($id)
    {
        DB::table('tab_penyerapan')->where('id_py', $id)->update([
            'status' => 0
        ]);

        $id_opd = DB::table('tab_penyerapan')->select('id_opd')->where('id_py', $id)->pluck('id_opd')->first();
        
        DB::table('tab_ikpa')->where('id_opd', $id_opd)->update([
            'n_penyerapan' => 0,
            'updated_at' => now()
        ]);

        return redirect(Session::get('py_url'))->with('warning', 'Data berhasi dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        Session::put('py_url', request()->fullUrl());

        $pys = DB::table('tab_penyerapan')
            ->join('tab_opd', 'tab_opd.id', '=', 'tab_penyerapan.id_opd')
            ->where('nama', 'LIKE', '%' . $search . '%')
            ->where('tab_penyerapan.status', '=', 1)
            ->paginate(10);

        return view('layouts.penyerapan.index', [
            'py' => $pys
        ]);
    }
}

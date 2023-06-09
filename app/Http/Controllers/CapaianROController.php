<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\ExportCapaianRO;
use App\Models\CapaianROModel;
use Excel;


class CapaianROController extends Controller
{
    private $capaian;

    function __construct()
    {
        $this->capaian = new CapaianROModel;
    }

    public function index()
    {
        $data['capaian'] = $this->capaian->getData();
        return view('layouts.capaian-ro.index', $data);
    }

    public function details($id_opd)
    {
        $id = Crypt::decrypt($id_opd);
        Session::put('id_detail', $id);

        $details = DB::table('tab_capaian_ro')
            ->where('id_opd', '=', $id)
            ->join('tab_opd', 'tab_opd.id', '=', 'tab_capaian_ro.id_opd')
            ->paginate(10);

        $title = DB::table('tab_opd')
            ->join('tab_capaian_ro', 'tab_capaian_ro.id_opd', '=', 'tab_opd.id')
            ->where('id',  $id)
            ->pluck('nama')
            ->first();

        return view('layouts.capaian-ro.details', [
            'detail' => $details,
            'title' => $title
        ]);
    }

    public function create()
    {
        $data['opd']        = $this->capaian->getOPD();
        $data['pelaporan']  = $this->capaian->getTahunPelaporan();
        return view('layouts.capaian-ro.create', $data);
    }

    public function store(REQUEST $request)
    {
        $simpan = $this->capaian->savecapaian($request);
        if ($simpan) {
            $this->hitungCapaianRO($request->id_opd);
            Session::flash('success', 'Data Capaian RK berhasil ditambahkan');
            return redirect('capaian-ro');
        }
        Session::flash('failed', 'Data Capaian RK gagal ditambahkan');
        return redirect('capaian-ro');
    }

    public function edit($id)
    {
        $data['capaian']    = $this->capaian->getData($id);
        $data['opd']        = $this->capaian->getOPD();
        $data['pelaporan']  = $this->capaian->getTahunPelaporan();

        return view('layouts.capaian-ro.edit', $data);
    }

    public function update(REQUEST $request)
    {
        $simpan = $this->capaian->updatecapaian($request);
        if ($simpan) {
            $this->hitungCapaianRO($request->id_opd);
            Session::flash('success', 'Data Capaian RK berhasil diubah');
            return redirect('capaian-ro');
        }
        Session::flash('failed', 'Data Capaian RK gagal diubah');
        return redirect('capaian-ro');
    }

    public function delete(REQUEST $request)
    {
        $simpan = $this->capaian->deletecapaian($request);
        if ($simpan) {
            Session::flash('success', 'Data Capaian RK berhasil dihapus');
            return redirect('capaian-ro');
        }
        Session::flash('failed', 'Data Capaian RK gagal dihapus');
        return redirect('capaian-ro');
    }


    public function export(REQUEST $request)
    {
        $namafile = 'Capaian RO.xlsx';
        return Excel::download(new ExportCapaianRO(), $namafile);
    }

    public function hitungCapaianRO($id_opd)
    {
        $capaianRO = $this->capaian->getDataRO($id_opd);
        $total_tepat_waktu  = 0;
        $total_capaian_ro   = 0;
        $nk_tepat_waktu     = 0;
        $nk_capaian_ro      = 0;

        foreach ($capaianRO as $key => $value) {
            $total_tepat_waktu += $value->komponen_tepat_waktu;
            $total_capaian_ro  += $value->komponen_capaian_ro;
        }

        $jumlah_data = count($capaianRO);
        if ($jumlah_data != 0) {
            $nk_tepat_waktu = $total_tepat_waktu / $jumlah_data;
            $nk_capaian_ro  = $total_capaian_ro / $jumlah_data;
        }

        $nilai_akhir = ($nk_tepat_waktu * 0.3) + ($nk_capaian_ro * 0.7);
        $update = $this->capaian->updateNilaiOutput($id_opd, $nilai_akhir);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        Session::put('rk_url', request()->fullUrl());

        $capaian = DB::table('tab_capaian_ro')
            ->select('tab_capaian_ro.id_opd', 'tab_opd.nama', DB::raw('count(id_opd) as opd'))
            ->groupBy('tab_opd.nama', 'tab_capaian_ro.id_opd')
            ->join('tab_opd', 'tab_opd.id', '=', 'tab_capaian_ro.id_opd')
            ->where('nama', 'LIKE', '%' . $search . '%')
            ->paginate(10);

        return view('layouts.capaian-ro.index', [
            'capaian' => $capaian
        ]);
    }

    public function searchDetails(Request $request)
    {
        $search = $request->search;
        Session::put('rkd_url', request()->fullUrl());

        $details = DB::table('tab_capaian_ro')
            ->join('tab_opd', 'tab_opd.id', '=', 'tab_capaian_ro.id_opd')
            ->where('program', 'LIKE', '%' . $search . '%')
            ->where('id_opd', '=', Session::get('id_detail'))
            ->paginate(10);

        $title = DB::table('tab_opd')
            ->join('tab_capaian_ro', 'tab_capaian_ro.id_opd', '=', 'tab_opd.id')
            ->where('id',  Session::get('id_detail'))
            ->pluck('nama')
            ->first();

        return view('layouts.capaian-ro.details', [
            'detail' => $details,
            'title' => $title
        ]);
    }
}

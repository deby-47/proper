<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
Use App\Exports\ExportUPTUP;
use App\Models\UPTUPModel;
use Excel;

class UPTUPController extends Controller
{
    private $uptup;

    function __construct()
    {
        $this->uptup = new UPTUPModel;
    }

    public function index()
    {
        $data['uptup'] = $this->uptup->getData();
        return view('layouts.up-tup.index',$data);
    }

    public function create()
    {
        $data['opd'] = $this->uptup->getOPD();
        return view('layouts.up-tup.create',$data);
    }

    public function store(REQUEST $request)
    {
        $simpan = $this->uptup->saveUPTUP($request);
        if($simpan){
            Session::flash('success','Data UP TUP berhasil di tambahkan');
            return redirect('up-tup');
        }
        Session::flash('failed','Data UP TUP gagal di tambahkan');
        return redirect('up-tup');
    }

    public function edit($id)
    {
        $data['up']  = $this->uptup->getData($id);
        $data['opd']    = $this->uptup->getOPD();
        return view('layouts.up-tup.edit',$data);
    }

    public function update(REQUEST $request)
    {
        $simpan = $this->uptup->updateUPTUP($request);
        if($simpan){
            Session::flash('success','Data UP TUP berhasil di edit');
            return redirect('up-tup');
        }
        Session::flash('failed','Data UP TUP gagal di edit');
        return redirect('up-tup');
    }

    public function delete(REQUEST $request)
    {
        $simpan = $this->uptup->deleteUPTUP($request);
        if($simpan){
            Session::flash('success','Data UP TUP berhasil di hapus');
            return redirect('up-tup');
        }
        Session::flash('failed','Data UP TUP gagal di hapus');
        return redirect('up-tup');
    }

    // public function export(REQUEST $request)
    // {
    //     $namafile = 'UP TUP.xlsx';
    //     return Excel::download(new ExportUPTUP(),$namafile);
    // }


    // public function store(Request $request)
    // {
    //     $pgs = new DispensasiSPM();
    //     $pgs->id_opd = $request->opd;
    //     $pgs->jumlah_spm = $request->jumlah_spm;
    //     $pgs->jumlah_dispensasi = $request->jumlah_dispensasi;
    //     $pgs->save();

    //     Alert::success('Sukses!', 'Data berhasil tersimpan');
    //     return view('layouts.dispensasi.create');
    // }

    // public function edit(Request $request)
    // {
    //     $id = Crypt::decrypt($request->id);
    //     $dispen = DB::table('tab_dispensasi')
    //         ->join('tab_opd', 'tab_dispensasi.id_opd', '=', 'tab_opd.id')
    //         ->where('tab_dispensasi.status', '=', 1)
    //         ->where('tab_dispensasi.id_ds', $id)
    //         ->get();

    //     return view('layouts.dispensasi.edit', [
    //         'dsp' => $dispen
    //     ]);
    // }

    // public function update(Request $request)
    // {
    //     $id = Crypt::decrypt($request->id);

    //     DB::table('tab_dispensasi')->where('id_ds', $id)->update([
    //         'jumlah_spm' => $request->jumlah_spm,
    //         'jumlah_dispensasi' => $request->jumlah_dispensasi,
    //         'updated_at' => now()
    //     ]);

    //     return redirect(Session::get('dsp_url'))->with('success', 'Data berhasi diubah!');
    // }

    // public function delete($id)
    // {
    //     DB::table('tab_dispensasi')->where('id_ds', $id)->update([
    //         'status' => 0
    //     ]);

    //     return redirect(Session::get('dsp_url'))->with('warning', 'Data berhasi dihapus!');
    // }

    // public function search(Request $request)
    // {
    //     $search = $request->search;
    //     Session::put('dsp_url', request()->fullUrl());

    //     $dsps = DB::table('tab_dispensasi')
    //         ->join('tab_opd', 'tab_opd.id', '=', 'tab_dispensasi.id_opd')
    //         ->where('nama', 'LIKE', '%' . $search . '%')
    //         ->where('tab_dispensasi.status', '=', 1)
    //         ->paginate(10);

    //     return view('layouts.penyerapan.index', [
    //         'dsp' => $dsps
    //     ]);
    // }
}

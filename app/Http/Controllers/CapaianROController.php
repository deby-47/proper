<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
Use App\Exports\ExportCapaianRO;
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
        return view('layouts.capaian-ro.index',$data);
    }

    public function create()
    {
        $data['opd'] = $this->capaian->getOPD();
        return view('layouts.capaian-ro.create',$data);
    }

    public function store(REQUEST $request)
    {
        $simpan = $this->capaian->savecapaian($request);
        if($simpan){
            Session::flash('success','Data Capaian RO berhasil ditambah');
            return redirect('capaian-ro');
        }
        Session::flash('failed','Data Capaian RO gagal ditambah');
        return redirect('capaian-ro');
    }

    public function edit($id)
    {
        $data['capaian']  = $this->capaian->getData($id);
        $data['opd']    = $this->capaian->getOPD();
        return view('layouts.capaian-ro.edit',$data);
    }

    public function update(REQUEST $request)
    {
        $simpan = $this->capaian->updatecapaian($request);
        if($simpan){
            Session::flash('success','Data Capaian RO berhasil diubah');
            return redirect('capaian-ro');
        }
        Session::flash('failed','Data Capaian RO gagal diubah');
        return redirect('capaian-ro');
    }

    public function delete(REQUEST $request)
    {
        $simpan = $this->capaian->deletecapaian($request);
        if($simpan){
            Session::flash('success','Data Capaian RO berhasil dihapus');
            return redirect('capaian-ro');
        }
        Session::flash('failed','Data Capaian RO gagal di hapus');
        return redirect('capaian-ro');
    }

    
    // public function export(REQUEST $request)
    // {
    //     $namafile = 'Capaian RO.xlsx';
    //     return Excel::download(new ExportCapaianRO(),$namafile);
    // }

}

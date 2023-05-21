<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
Use App\Exports\ExportUPTUP;
use App\Models\UPTUPModel;
use Carbon\Carbon;
use DateTime;
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
            $this->hitung($request->id_opd);
            Session::flash('success','Data UP TUP berhasil ditambahkan');
            return redirect('up-tup');
        }
        Session::flash('failed','Data UP TUP gagal ditambahkan');
        return redirect('up-tup');
    }

    public function edit($id)
    {
        $data['up']     = $this->uptup->getData($id);
        $data['opd']    = $this->uptup->getOPD();
        return view('layouts.up-tup.edit',$data);
    }

    public function update(REQUEST $request)
    {
        $simpan = $this->uptup->updateUPTUP($request);
        if($simpan){
            $this->hitung($request->id_opd);
            Session::flash('success','Data UP TUP berhasil diubah');
            return redirect('up-tup');
        }
        Session::flash('failed','Data UP TUP gagal diubah');
        return redirect('up-tup');
    }

    public function delete(REQUEST $request)
    {
        $simpan = $this->uptup->deleteUPTUP($request);
        if($simpan){
            Session::flash('success','Data UP TUP berhasil dihapus');
            return redirect('up-tup');
        }
        Session::flash('failed','Data UP TUP gagal dihapus');
        return redirect('up-tup');
    }

    public function export(REQUEST $request)
    {
        $namafile = 'UP TUP.xlsx';
        return Excel::download(new ExportUPTUP(),$namafile);
    }

    public function last_up($id_opd,$tgl,$jenis)
    {
        $lastup      = $this->uptup->getlastup($id_opd,$tgl);
        $firstup     = $this->uptup->getfirstup($id_opd,$tgl);
        $lastmonth     = $this->uptup->lastMonthUP($id_opd,$tgl);
        
        if($lastup){
            $tgl_terakhir       = $lastup->tanggal_up;
            $to                 = new DateTime($tgl_terakhir);
            $from               = new DateTime($tgl);
            $selisih            = ($to->diff($from))->format('%a');
            if($jenis == 1){
                $jumlah_hari        = 0;
            }else{
                $tahun          = date('Y',strtotime($lastmonth->tanggal_up)); 
                $bulan          = date('m',strtotime($lastmonth->tanggal_up)); 
                $jumlah_hari    = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            }
            
        }else{
            $jumlah_hari    = 0;
            $selisih        = 0;
        }
        $up_outstanding = 0;
        if($firstup){
            $up_outstanding = $firstup->total_gu_up;
        }
        $dataArray  = array(
            "data"          => $lastup,
            "count_days"    => $jumlah_hari,
            "selisih"       => $selisih,
            "up_outstanding"=> $up_outstanding,
        );

        return response()->json($dataArray);      
    }

    public function last_tup($id_opd,$tgl,$jenis)
    {
        $lastup     = $this->uptup->getlasttup($id_opd,$tgl);
        if($lastup){
            $tanggal        = $lastup->tanggal_up;
            $tahun          = date('Y',strtotime($tanggal)); 
            $bulan          = date('m',strtotime($tanggal)); 
            $to             = new DateTime($tanggal);
            $from           = new DateTime($tgl);
            $jumlah_hari    = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            if($jenis == 3){
                $selisih = 0;
            }else{
                $selisih        = ($to->diff($from))->format('%a');
            }
        }else{
            $jumlah_hari    = 0;
            $selisih        = 0;
        }
        
        $dataArray  = array(
            "data"          => $lastup,
            "count_days"    => $jumlah_hari,
            "selisih"       => $selisih
        );

        return response()->json($dataArray);      
    }

    public function hitung($id_opd)
    {
        $dataUPGUP      = $this->uptup->getGUP($id_opd);
        $dataSetoran    = $this->uptup->getSetoranTUP($id_opd);
        $dataPTUP       = $this->uptup->dataPTUP($id_opd);

        $kepatuhan      = 0;
        $presentase_gup = 0;
        $setoran        = 0;
        $total_tup      = 0;

        foreach ($dataSetoran as $key => $value) {
            $setoran += $value->total_gu_up;
        }

        foreach ($dataUPGUP as $key => $value) {
            $presentase_gup += $value->presentase_gup_up;
            $kepatuhan  += $value->kepatuhan_up;
        }

       
        for ($i=0; $i < count($dataPTUP) ; $i++) { 
            $kepatuhan += $dataPTUP[$i]['kepatuhan'];
            $total_tup += $dataPTUP[$i]['tup']->total_gu_up;
        }

        $jumlah_ptup_upgup = count($dataPTUP) +  count($dataUPGUP);
        if($jumlah_ptup_upgup != 0){
         
            $nilai_komponen_kepatuhan   = $kepatuhan/(count($dataPTUP) +  count($dataUPGUP));   
        }else{
            
            $nilai_komponen_kepatuhan   = $kepatuhan;
        }
        
        if(count($dataUPGUP) != 0){
            $nilai_komponen_presentase  = $presentase_gup/(count($dataUPGUP));
        }else{
            $nilai_komponen_presentase  = $presentase_gup;
        }
        if($total_tup != 0){
            $nilai_komponen_setoran     = 100-($setoran/$total_tup);
        }else{
            $nilai_komponen_setoran     = 100;
        }
        
        $nilai_akhir = ($nilai_komponen_kepatuhan*0.5)+($nilai_komponen_presentase*0.25)+($nilai_komponen_setoran*0.25);
        
        $update = $this->uptup->updateNilaiOutput($id_opd,$nilai_akhir);

    }

    public function search(Request $request)
    {
        $search = $request->search;
        Session::put('up_url', request()->fullUrl());

        $up = DB::table('tab_up_tup')
            ->join('tab_opd', 'tab_opd.id', '=', 'tab_up_tup.id_opd')
            ->where('nama', 'LIKE', '%' . $search . '%')
            ->paginate(10);

        return view('layouts.up-tup.index', [
            'uptup' => $up
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CapaianROModel extends Model
{
    protected $table    = "tab_capaian_ro";
    public $timestamps  = false;


    public function getAllData()
    {
        return DB::table('tab_capaian_ro')
            ->get();
    }


    public function getData($id = NULL)
    {
        if($id != NULL){
            return DB::table('tab_capaian_ro')
            ->where('id_capaian_ro',$id)
            ->first();
        }
        return DB::table('tab_capaian_ro')
            ->paginate(10);
    }

    public function getOPD()
    {
        return DB::table('tab_opd')
            ->get();
    }

    public function savecapaian($request)
    {
        try {
            $sv                         = new CapaianROModel();
            $sv->id_opd                 = $request->id_opd;
            $sv->sub_kegiatan           = $request->sub_kegiatan;
            $sv->ro                     = $request->ro;
            $sv->target_ro              = $request->target_ro;
            $sv->satuan                 = $request->satuan;
            $sv->rvro                   = $request->rvro;
            $sv->pcro                   = $request->pcro;
            $sv->status_konfirmasi      = $request->status_konfirmasi;
            $sv->target_pcro            = $request->target_pcro;
            $sv->batas_waktu_pelaporan  = $request->batas_waktu_pelaporan;
            $sv->tanggal_kirim          = $request->tanggal_kirim;
            $sv->tanggal_kosong         = $request->tanggal_kosong;
            $sv->status                 = $request->status;
            $sv->komponen_tepat_waktu   = $request->komponen_tepat_waktu;
            $sv->komponen_capaian_ro    = $request->komponen_capaian_ro;
            $sv->save();
            return TRUE;
        } catch (\Throwable $th) {
            dd($th);
            return FALSE;
        }
    }

    public function updatecapaian($request)
    {
        try {
            DB::table('tab_capaian_ro')
            ->where('id_capaian_ro',$request->id_capaian_ro)
            ->update([
                "id_opd"                 => $request->id_opd,
                "sub_kegiatan"           => $request->sub_kegiatan,
                "ro"                     => $request->ro,
                "target_ro"              => $request->target_ro,
                "satuan"                 => $request->satuan,
                "rvro"                   => $request->rvro,
                "pcro"                   => $request->pcro,
                "status_konfirmasi"      => $request->status_konfirmasi,
                "target_pcro"            => $request->target_pcro,
                "batas_waktu_pelaporan"  => $request->batas_waktu_pelaporan,
                "tanggal_kirim"          => $request->tanggal_kirim,
                "tanggal_kosong"         => $request->tanggal_kosong,
                "status"                 => $request->status,
                "komponen_tepat_waktu"   => $request->komponen_tepat_waktu,
                "komponen_capaian_ro"    => $request->komponen_capaian_ro
            ]);
            return TRUE;
        } catch (\Throwable $th) {
            dd($th);
            return FALSE;
        }
    }

    public function deletecapaian($request)
    {
        try {
            DB::table('tab_capaian_ro')->where('id_capaian_ro',$request->id_capaian_ro)
            ->delete();
            return TRUE;
        } catch (\Throwable $th) {
            return FALSE;
        }
    }
}

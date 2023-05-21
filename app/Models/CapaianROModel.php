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
        if ($id != NULL) {
            return DB::table('tab_capaian_ro')
                ->where('id_capaian_ro', $id)
                ->first();
        }
        return DB::table('tab_capaian_ro')
            ->select('tab_capaian_ro.id_opd', 'tab_opd.nama', DB::raw('count(id_opd) as opd'))
            ->groupBy('tab_opd.nama', 'tab_capaian_ro.id_opd')
            ->join('tab_opd', 'tab_opd.id', '=', 'tab_capaian_ro.id_opd')
            ->orderBy('opd', 'DESC')
            ->paginate(10);
    }

    public function getOPD()
    {
        return DB::table('tab_opd')
            ->get();
    }

    public function getTahunPelaporan()
    {
        return DB::table('tab_pelaporan')
            ->where('status', 1)
            ->first();
    }


    public function savecapaian($request)
    {
        try {
            $sv                         = new CapaianROModel();
            $sv->id_opd                 = $request->id_opd;
            $sv->program                = $request->program;
            $sv->id_pelaporan           = $this->getTahunPelaporan()->id_pelaporan;
            $sv->target_ro              = $request->target_ro;
            $sv->satuan                 = $request->satuan;
            $sv->rvro                   = $request->rvro;
            $sv->pcro                   = $request->pcro;
            $sv->status_konfirmasi      = $request->status_konfirmasi;
            $sv->target_pcro            = $request->target_pcro;
            $sv->tanggal_kirim          = $request->tanggal_kirim;
            $sv->status                 = $request->status_kode;
            $sv->komponen_tepat_waktu   = $request->komponen_tepat_waktu;
            $sv->komponen_capaian_ro    = $request->komponen_capaian_ro;
            $sv->save();
            return TRUE;
        } catch (\Throwable $th) {
            return FALSE;
        }
    }

    public function updatecapaian($request)
    {
        try {
            DB::table('tab_capaian_ro')
                ->where('id_capaian_ro', $request->id_capaian_ro)
                ->update([
                    "id_opd"                 => $request->id_opd,
                    "program"                => $request->program,
                    "target_ro"              => $request->target_ro,
                    "satuan"                 => $request->satuan,
                    "rvro"                   => $request->rvro,
                    "pcro"                   => $request->pcro,
                    "status_konfirmasi"      => $request->status_konfirmasi,
                    "target_pcro"            => $request->target_pcro,
                    "tanggal_kirim"          => $request->tanggal_kirim,
                    "status"                 => $request->status_kode,
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
            DB::table('tab_capaian_ro')->where('id_capaian_ro', $request->id_capaian_ro)
                ->delete();
            return TRUE;
        } catch (\Throwable $th) {
            return FALSE;
        }
    }

    public function getDataRO($id_opd)
    {
        $id_pelaporan = $this->getTahunPelaporan()->id_pelaporan;

        return DB::table('tab_capaian_ro')
            ->where('id_opd', $id_opd)
            ->where('id_pelaporan', $id_pelaporan)
            ->get();
    }

    public function updateNilaiOutput($id_opd, $nilai_akhir)
    {
        try {
            DB::table('tab_ikpa')
                ->where('id_opd', $id_opd)
                ->update([
                    "n_output" => $nilai_akhir,
                ]);
            return TRUE;
        } catch (\Throwable $th) {
            return FALSE;
        }
    }
}

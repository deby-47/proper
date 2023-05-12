<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UPTUPModel extends Model
{
    protected $table    = "tab_up_tup";
    public $timestamps  = true;

    public function getAllData()
    {
        return DB::table('tab_up_tup')
            ->get();
    }

    public function getData($id = NULL)
    {
        if($id != NULL){
            return DB::table('tab_up_tup')
            ->where('id_up_tup',$id)
            ->first();
        }
        return DB::table('tab_up_tup')
            ->paginate(10);
    }

    public function getOPD()
    {
        return DB::table('tab_opd')
            ->get();
    }

    public function saveUPTUP($request)
    {
        try {
            $sv                     = new UPTUPModel();
            $sv->id_opd             = $request->id_opd;
            $sv->jenis_up           = $request->jenis_up;
            $sv->tanggal_up         = $request->tanggal_up;
            $sv->selisih_hari_up    = $request->selisih_hari_up;
            $sv->total_gu_up        = $request->total_gu_up;
            $sv->outstanding_up     = $request->outstanding_up;
            $sv->persen_up          = $request->persen_up;
            $sv->status_up          = $request->status_up;
            $sv->kepatuhan_up       = $request->kepatuhan_up;
            $sv->presentase_gup_up  = $request->presentase_gup_up;
            $sv->presentase         = $request->presentase;
            $sv->setoran_tup_up     = $request->setoran_tup_up;
            $sv->save();
            return TRUE;
        } catch (\Throwable $th) {
            return FALSE;
        }
    }

    public function updateUPTUP($request)
    {
        try {
            DB::table('tab_up_tup')->where('id_up_tup',$request->id_up_tup)
            ->update([
                "id_opd"             => $request->id_opd,
                "jenis_up"           => $request->jenis_up,
                "tanggal_up"         => $request->tanggal_up,
                "selisih_hari_up"    => $request->selisih_hari_up,
                "total_gu_up"        => $request->total_gu_up,
                "outstanding_up"     => $request->outstanding_up,
                "persen_up"          => $request->persen_up,
                "status_up"          => $request->status_up,
                "kepatuhan_up"       => $request->kepatuhan_up,
                "presentase_gup_up"  => $request->presentase_gup_up,
                "presentase"         => $request->presentase,
                "setoran_tup_up"     => $request->setoran_tup_up,
            ]);
            return TRUE;
        } catch (\Throwable $th) {
            return FALSE;
        }
    }

    public function deleteUPTUP($request)
    {
        try {
            DB::table('tab_up_tup')->where('id_up_tup',$request->id_up_tup)
            ->delete();
            return TRUE;
        } catch (\Throwable $th) {
            return FALSE;
        }
    }
}

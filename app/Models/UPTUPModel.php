<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

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
        if ($id != NULL) {
            return DB::table('tab_up_tup')
                ->where('id_up_tup', $id)
                ->first();
        }
        return DB::table('tab_up_tup')
            ->join('tab_opd', 'tab_opd.id', '=', 'tab_up_tup.id_opd')
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


    public function saveUPTUP($request)
    {
        try {

            $sv                     = new UPTUPModel();
            $sv->id_opd             = $request->id_opd;
            $sv->jenis_up           = $request->jenis_up;
            $sv->id_pelaporan       = $this->getTahunPelaporan()->id_pelaporan;
            $sv->tanggal_up         = $request->tanggal_up;
            $sv->selisih_hari_up    = $request->selisih_hari_up;
            $sv->total_gu_up        = $request->total_gu_up;
            $sv->outstanding_up     = NULL;
            $sv->persen_up          = $request->persen_up;
            $sv->status_up          = $request->status_kode;
            $sv->kepatuhan_up       = ($request->jenis_up == 1) ? 0 : $request->kepatuhan_up;
            $sv->presentase_gup_up  = $request->presentase_gup_up;
            $sv->setoran_tup_up     = NULL;
            $sv->save();
            return TRUE;
        } catch (\Throwable $th) {
            return FALSE;
        }
    }

    public function updateUPTUP($request)
    {
        try {
            DB::table('tab_up_tup')->where('id_up_tup', $request->id_up_tup)
                ->update([
                    "id_opd"             => $request->id_opd,
                    "jenis_up"           => $request->jenis_up,
                    "tanggal_up"         => $request->tanggal_up,
                    "selisih_hari_up"    => $request->selisih_hari_up,
                    "total_gu_up"        => $request->total_gu_up,
                    "outstanding_up"     => NULL,
                    "persen_up"          => $request->persen_up,
                    "status_up"          => $request->status_up,
                    "kepatuhan_up"       => ($request->jenis_up == 1) ? 0 : $request->kepatuhan_up,
                    "presentase_gup_up"  => $request->presentase_gup_up,
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
            DB::table('tab_up_tup')->where('id_up_tup', $request->id_up_tup)
                ->delete();
            return TRUE;
        } catch (\Throwable $th) {
            return FALSE;
        }
    }

    public function getfirstup($id_opd, $tgl)
    {
        return DB::table('tab_up_tup')
            ->where('id_opd', $id_opd)
            ->whereDate('tanggal_up', '<', ($tgl))
            ->where('jenis_up', '=', 1)
            ->first();
    }


    public function getlastup($id_opd, $tgl)
    {

        $data = DB::table('tab_up_tup')
            ->where('id_opd', $id_opd)
            ->whereDate('tanggal_up', '<', ($tgl))
            ->whereIn('jenis_up', [1, 2])
            ->orderBy('tanggal_up', "DESC")
            ->first();
        if ($data) {
            return $data;
        }
        return NULL;
    }

    public function lastMonthUP($id_opd, $tgl)
    {
        $data = DB::table('tab_up_tup')
            ->where('id_opd', $id_opd)
            ->whereMonth('tanggal_up', '<', date('m', strtotime($tgl)))
            ->whereIn('jenis_up', [1, 2])
            ->orderBy('tanggal_up', "DESC")
            ->first();

        if ($data) {
            return $data;
        }
        return NULL;
    }


    public function getlasttup($id_opd, $tgl)
    {
        return DB::table('tab_up_tup')
            ->where('id_opd', $id_opd)
            ->whereDate('tanggal_up', '<', $tgl)
            ->where('jenis_up', '=', 3)
            ->orderBy('tanggal_up', "DESC")
            ->first();
    }

    public function getUPGUP()
    {
        return DB::table('tab_up_tup')
            ->whereIn('jenis_up', [1, 2])
            ->get();
    }

    public function getGUP($id_opd)
    {
        return DB::table('tab_up_tup')
            ->where('jenis_up', 2)
            ->where('id_opd', $id_opd)
            ->get();
    }


    public function getSetoranTUP($id_opd)
    {
        return DB::table('tab_up_tup')
            ->where('jenis_up', 5)
            ->where('id_opd', $id_opd)
            ->get();
    }

    public function dataPTUP($id_opd)
    {
        // return DB::table('tab_up_tup')
        //         ->where('jenis_up',4)
        //         ->get();

        $tup = DB::table('tab_up_tup')
            ->where('jenis_up', 3)
            ->orderBy('tanggal_up', "ASC")
            ->where('id_opd', $id_opd)
            ->get();

        $dtarrayTUP = array();
        foreach ($tup as $key => $value) {
            $dtarrayTUP[$key] = $value;
        }

        //ambil rentang antar TUP
        $dtArray = array();
        for ($i = 0; $i < count($dtarrayTUP); $i++) {
            $ambildata = DB::table('tab_up_tup')
                ->orderBy('tanggal_up', "ASC")
                ->where('jenis_up', "<>", 1)
                ->where('id_opd', $id_opd)
                ->where('jenis_up', "<>", 2);
            if (isset($dtarrayTUP[$i]->tanggal_up)) {
                $ambildata->whereDate('tanggal_up', '>', $dtarrayTUP[$i]->tanggal_up);
            }
            if (isset($dtarrayTUP[$i + 1]->tanggal_up)) {
                $ambildata->whereDate('tanggal_up', '<', $dtarrayTUP[$i + 1]->tanggal_up);
            }
            $result = $ambildata->get();
            if ($result != "[]") {
                array_push($dtArray, $result);
            }
        }

        // dd($dtArray);

        $arrayHasil = array();
        foreach ($dtArray as $key => $value) {
            $jumlah     = 0;
            $outstandig = $dtarrayTUP[$key]->total_gu_up;
            $to         = new DateTime($dtarrayTUP[$key]->tanggal_up);
            $selisih    = 0;
            foreach ($value as $k => $v) {
                $jumlah += $v->total_gu_up;
                $last_transaksi = $v->tanggal_up;
                $from               = new DateTime($v->tanggal_up);
                $selisih            = ($to->diff($from))->format('%a');
            }

            $dtAarray = array(
                "tup"           => $dtarrayTUP[$key],
                "sisa"          => $outstandig - $jumlah,
                "selisih_hari"  => $selisih,
                "status"        => ($selisih <= 30) ? 1 :  2,
                "kepatuhan"     => ($selisih <= 30) ? 100 :  0,

            );

            array_push($arrayHasil, $dtAarray);
        }

        return $arrayHasil;
    }

    public function updateNilaiOutput($id_opd, $nilai_akhir)
    {
        try {
            DB::table('tab_ikpa')->where('id_opd', $id_opd)
                ->update([
                    "n_up"             => $nilai_akhir,
                ]);
            return TRUE;
        } catch (\Throwable $th) {
            dd($th);
            return FALSE;
        }
    }
}

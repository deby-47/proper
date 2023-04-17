<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RealisasiKeuangan extends Model
{
    use HasFactory;

    public $table = "tab_realisasi_keuangan";

    protected $fillable = ['id_opd', 'jml_anggaran', 'jml_realisasi'];

    public function selectRealisasiKeuangan()
    {
        $rk = DB::table('tab_realisasi_keuangan')
                ->select('id', 'id_opd', 'jml_anggaran', 'jml_realisasi')
                ->where('status', '=', 1)
                ->get();
        
        return $rk;
    }
}

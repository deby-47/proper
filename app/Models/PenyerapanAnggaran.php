<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PenyerapanAnggaran extends Model
{
    use HasFactory;

    public $table = "tab_penyerapan";

    protected $fillable = ['id_opd', 'p_pegawai', 'r_pegawai', 'p_barjas', 'r_barjas', 
                        'p_modal', 'r_modal', 'p_bansos', 'r_bansos'];

    public function selectPenyerapan()
    {
        $pys = DB::table('tab_penyerapan')
                ->select('id_py', 'id_opd', 'p_pegawai', 'r_pegawai', 'p_barjas', 'r_barjas', 'p_modal', 'r_modal', 'p_bansos', 'r_bansos')
                ->where('status', '=', 1)
                ->get();
        
        return $pys;                
    }
}

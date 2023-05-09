<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Deviasi extends Model
{
    use HasFactory;

    public $table = "tab_deviasi";

    protected $fillable = ['id_opd', 'n_rpd', 'n_realisasi'];

    public function selectDeviasi()
    {
        $dv = DB::table('tab_deviasi')
            ->select('id_dv', 'id_opd', 'n_rpd', 'n_realisasi')
            ->where('status', '=', 1)
            ->get();
        
            return $dv;
    }
}

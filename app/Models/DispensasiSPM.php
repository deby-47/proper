<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DispensasiSPM extends Model
{
    use HasFactory;

    public $table = "tab_dispensasi";

    protected $fillable = ['id_opd', 'jumlah_spm', 'jumlah_dispensasi'];

    public function selectDispensasi()
    {
        $dsp = DB::table('tab_dispensasi')
            ->select('id_ds', 'id_opd', 'jumlah_spm', 'jumlah_dispensasi')
            ->where('status', '=', 1)
            ->get();

        return $dsp;
    }
}

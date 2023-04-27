<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PergeseranAnggaran extends Model
{
    use HasFactory;

    public $table = "tab_pergeseran";

    protected $fillable = ['id_opd', 'frekuensi_revisi'];

    public function selectPergeseran()
    {
        $pg = DB::table('tab_pergeseran')
                ->select('id_pg', 'id_opd', 'frekuensi_revisi')
                ->where('status', '=', 1)
                ->get();
        
        return $pg;
    }
}

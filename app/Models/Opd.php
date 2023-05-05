<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Opd extends Model
{
    use HasFactory;

    public $table = ["tab_opd", "tab_ikpa"];

    protected $fillable = ['nama', 'id_opd', 'n_pergeseran', 'n_penyerapan', 'n_up', 'n_output'];

    public function selectOpd()
    {
        $opd = DB::table('tab_opd')
                ->select('id', 'nama')
                ->where('status', '=', 1)
                ->get();
        
        return $opd;
    }

    public function selectNilai()
    {
        $nilai = DB::table('tab_ikpa')
                ->select('id_ikpa', 'id_opd', 'n_pergeseran', 'n_penyerapan', 'n_up', 'n_output', 'n_ikpa')
                ->get();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NilaiIKPA extends Model
{
    use HasFactory;

    public $table = "tab_ikpa";

    protected $primaryKey = 'id_ikpa';

    protected $fillable = ['id_opd', 'n_pergeseran', 'n_penyerapan', 'n_up', 'n_output'];

    public function selectNilai()
    {
        $nilai = DB::table('tab_ikpa')
                ->select('id_ikpa', 'id_opd', 'n_pergeseran', 'n_penyerapan', 'n_up', 'n_output', 'n_ikpa')
                ->get();
                
        return $nilai;
    }
}

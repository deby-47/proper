<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Opd extends Model
{
    use HasFactory;

    public $table = "tab_opd";

    protected $fillable = ['nama'];

    public function selectOpd()
    {
        $opd = DB::table('tab_opd')
                ->select('id', 'nama')
                ->where('status', '=', 1)
                ->get();
        
        return $opd;
    }
}

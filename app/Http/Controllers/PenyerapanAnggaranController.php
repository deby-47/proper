<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyerapanAnggaranController extends Controller
{
    public function index()
    {
        $pys = DB::table('tab_penyerapan')
            ->join('tab_opd', 'tab_penyerapan.id_opd', '=', 'tab_opd.id')
            ->where('tab_penyerapan.status', '=', 1)
            ->orderBy('tab_penyerapan.id_py')
            ->paginate(10);
        
        return view('layouts.penyerapan.index', [
            'py' => $pys
        ]); // return with view
    }
}

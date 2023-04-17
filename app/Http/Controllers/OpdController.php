<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OpdController extends Controller
{
    public function index()
    {
        $opds = DB::table('tab_opd')
            ->where('status', '=', 1)
            ->orderBy('tab_opd.id', 'ASC')
            ->paginate(10);
        
        return view('layouts.opd.index', [
            'opd' => $opds,
        ]); // return with view
    }
}

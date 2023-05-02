<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

    public function search(Request $request)
    {
        $search = $request->search;
        Session::put('pg_url', request()->fullUrl());

        $opds = DB::table('tab_opd')
            ->where('nama', 'LIKE', '%' . $search . '%')
            ->where('status', 1)
            ->orderBy('nama', 'ASC')
            ->paginate(10);
        
        return view('layouts.opd.index', [
            'opd' => $opds
        ]);
    }
}

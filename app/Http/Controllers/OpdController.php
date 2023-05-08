<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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

    public function details(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $opds = DB::table('tab_opd')
            ->join('tab_ikpa', 'tab_ikpa.id_opd', '=', 'tab_opd.id')
            ->where('tab_opd.status', '=', 1)
            ->where('tab_opd.id', $id)
            ->orderBy('tab_opd.id', 'ASC')
            ->get();
        $title = DB::table('tab_opd')
            ->where('id',  $id)
            ->pluck('nama')
            ->first();

        return view('layouts.opd.details', [
            'title' => $title,
            'id' => $id,
            'opd' => $opds,
        ]);
    }
}

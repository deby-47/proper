<?php

namespace App\Http\Controllers;
use App\Models\NilaiIKPA;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pgs = DB::table('tab_ikpa')
            ->join('tab_opd', 'tab_ikpa.id_opd', '=', 'tab_opd.id')
            ->select('tab_ikpa.n_ikpa','tab_ikpa.id_opd' ,'tab_opd.nama')
            ->orderBy('tab_ikpa.n_ikpa', 'DESC')
            ->get();
        //dd($pgs);
        $opd = array();
        $n_ikpa = array();
        foreach($pgs as $ikpa){
            $opd = array_merge($opd, array($ikpa->nama));
            $n_ikpa = array_merge($n_ikpa, array($ikpa->n_ikpa));
        }
        return view('layouts.dashboard',[
            'pg' => $pgs,
            'opd' => $opd,
            'n_ikpa' => $n_ikpa
        ]);
    }
}

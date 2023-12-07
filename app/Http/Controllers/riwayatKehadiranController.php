<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Kehadiran;

class RiwayatkehadiranController extends Controller
{
    public function index()
    {
        $riwayatKehadiran = Kehadiran::all();
        // dd($riwayatKehadiran);
        return view('riwayatkehadiran.index', compact('riwayatKehadiran'));
    }    

    public function create()
    {
        return view('riwayatkehadiran.create');
    }

    // public function search(Request $request) {
    //     if ($request->has('search')) {
    //         $riwayatKehadiran = Kehadiran::where('nama','LIKE','%'.$request->search.'%')->get();
    // }
    // else {
    //     $riwayatKehadiran = Kehadiran::all();
    // }
    // return view('admin.riwayatkehadiran.riwayatkehadiran',['riwayatkehadiran'=> $riwayatKehadiran]);
   
   
}


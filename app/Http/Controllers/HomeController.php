<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $currentDate = Carbon::now()->toDateString();

    //     $kehadiranToday = $user->kehadiran()
    //     ->where(function ($query) use ($currentDate) {
    //         $query->whereDate('created_at', $currentDate);
    //     })
    //     ->get();
    
    // //    dd($kehadiranToday == null );
    //     if($kehadiranToday->isEmpty()){
    //         // dd(Carbon::now()->isoFormat("HH:mm"));
    //         if(Carbon::now()->isoFormat("HH:mm") > "08:00")
    //         {
    //             if ($user->kelas) {
    //              Kehadiran::create([
    //                 'user_id' => $user->id,
    //                 'status_kehadiran' => 'tidak hadir',
    //                 'kelas_id' => $user->kelas->id// Menyimpan kelas_id
    //             ]);
    //         }

    //         }
    //     }
        return view('home');
    }

    
}

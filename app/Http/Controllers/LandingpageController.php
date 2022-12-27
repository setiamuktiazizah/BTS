<?php

namespace App\Http\Controllers;

use App\Models\Bts;
use App\Models\User;
use App\Models\Kuesioner;
use App\Models\KondisiBts;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use App\Models\JawabanKuesioner;
use Illuminate\Routing\Controller;

class LandingpageController extends Controller
{
    public function index(Request $request)
    {   
        return view('landing');
    }

    public function view_bts()
    {
        return view('user_view.bts', [
            'data_bts' => Bts::latest()->get()
        ]);
    }
    
    public function maps()
    {
        return view('user_view.maps');
    }
    
    public function view_monitoring()
    {
        return view('user_view.monitoring', [
            'monitorings' => Monitoring::where('user_surveyor_id', auth()->user()->id)->get(),
            'data_bts' => Bts::all(),
            'data_kondisi_bts' => KondisiBts::all(),
            'data_surveyor' => User::all()
        ]);
    }
}

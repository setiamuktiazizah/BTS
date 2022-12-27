<?php

namespace App\Http\Controllers;

use App\Models\Bts;
use App\Models\User;
use App\Models\Pemilik;
use App\Models\Wilayah;
use App\Models\JenisBts;
use App\Models\LoginLog;
use App\Models\Kuesioner;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use App\Models\RecentActivity;
use App\Models\JawabanKuesioner;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $dateNow = date('Y-m-d');
        $timeNow = date('Y-m-d H:i:s');
        $time30MinutesEarlier = date('Y-m-d H:i:s', (strtotime($timeNow) - (30 * 60)));
        $still_online = LoginLog::where('is_online', true);
        $online = LoginLog::whereDate('created_at', $dateNow)
                    ->whereTime('created_at', '<=', $timeNow)
                    ->whereTime('created_at', '>=', $time30MinutesEarlier)
                    ->union($still_online)
                    ->get();
        return view('dashboard.index', [
            'jumlah_monitoring' => Monitoring::all()->count(),
            'activities' => RecentActivity::latest('at')->take(5)->get(),
            'online_users' => $online
        ]);
    }

    public function bts()
    {
        return view('dashboard.data.dataBTS', [
            'data_bts' => Bts::latest()->get(),
            'data_pemilik' => Pemilik::all(),
            'data_jenis' => JenisBts::all(),
            'data_wilayah' => Wilayah::all(),
        ]);
    }

    public function operator()
    {
        return view('dashboard.data.dataOperator', [
            'data_operator' => User::where('role', 'surveyor')->get()
        ]);
    }
    
    public function monitoring(Request $request)
    {
        if($request->bts){
            return view('dashboard.data.dataMonitoring', [
                'monitorings' => Monitoring::where('bts_id', $request->bts)->get(),
                'data_bts' => Bts::all(),
            ]);
        }
        return view('dashboard.data.dataMonitoring', [
            'monitorings' => Monitoring::all(),
            'data_bts' => Bts::all()
        ]);
    }
    
    public function maps()
    {
        return view('dashboard.maps.MapsBTS');
    }

    public function profile()
    {
        return view('dashboard.profile.index');
    }

    public function kuesioner()
    {
        return view('dashboard.kuesioner.index', [
            'kuesioners' => Kuesioner::all(),
            'jawabans' => JawabanKuesioner::all()
        ]);
    }
    
    public function user()
    {
        return view('dashboard.data.dataOperator', [
            'data_operator' => User::all()
        ]);
    }
}

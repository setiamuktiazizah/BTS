<?php

namespace App\Http\Controllers;

use App\Models\Bts;
use App\Models\User;
use App\Models\KondisiBts;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use App\Models\RecentActivity;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMonitoringRequest;
use App\Http\Requests\UpdateMonitoringRequest;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->bts){
            return view('dashboard.data.dataMonitoring', [
                'monitorings' => Monitoring::where('bts_id', $request->bts)->get(),
                'data_bts' => Bts::all(),
                'data_kondisi_bts' => KondisiBts::all(),
                'data_surveyor' => User::all()
            ]);
        }
        return view('dashboard.data.dataMonitoring', [
            'monitorings' => Monitoring::all(),
            'data_bts' => Bts::all(),
            'data_kondisi_bts' => KondisiBts::all(),
            'data_surveyor' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMonitoringRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMonitoringRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function show(Monitoring $monitoring)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function edit(Monitoring $monitoring)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function destroy(Monitoring $monitoring)
    {
        $activity = [
            'user_id' => auth()->user()->id,
            'action' => 'delete',
            'object' => 'monitoring on ' . $monitoring->bts->nama,
        ];

        RecentActivity::create($activity);
        Monitoring::destroy($monitoring->id);

        return redirect('/monitoring')->with('success', 'Data deleted!');
    }

    
}

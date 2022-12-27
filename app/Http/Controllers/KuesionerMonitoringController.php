<?php

namespace App\Http\Controllers;

use App\Models\Bts;
use App\Models\Kuesioner;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use App\Models\JawabanKuesioner;
use Illuminate\Routing\Controller;
use App\Models\KuesionerMonitoring;

class KuesionerMonitoringController extends Controller
{
    public function store_monitoring(Request $request)
    {
        $validatedData = $request->validate([
            'tahun' => 'required:|min:4|max:4',
            'bts_id' => 'required',
            'tgl_kunjungan' => 'required'
        ]);

        $validatedData['user_surveyor_id'] = auth()->user()->id;
        $validatedData['created_by'] = auth()->user()->id;
        $validatedData['edited_by'] = auth()->user()->id;

        $monitoring = Monitoring::create($validatedData);
        
        return redirect('/v/monitoring/'. $monitoring->id);
    }

    public function store_kuesioner(Request $request, Monitoring $monitoring)
    {
        // dd($request);
        $input = $request->all();
        ksort($input);
        // dd($input['pertanyaan1']);

        $validatedData = [];
        for($i = 1; $i <= end($input); $i++){
            $validatedData['jawaban' . $i] = 'required';
        }

        // $this->validate($request, $validatedData );
        $request->validate($validatedData);

        for($i = 1; $i <= end($input); $i++){
            $to_insert = [
                'monitoring_id' => $monitoring->id,
                'kuesioner_id' => $input['pertanyaan' . $i],
                'jawaban_kuesioner_id' => $input['jawaban' . $i],
                'created_by' => auth()->user()->id,
                'edited_by' => auth()->user()->id
            ];

            KuesionerMonitoring::create($to_insert);
        }

        return redirect('/v/monitoring')->with('success', 'Monitoring berhasil ditambahkan!');
    }

    public function show_kuesioner(Monitoring $monitoring)
    {
        return view('user_view.show_kuesioner', [
            'kuesioner' => KuesionerMonitoring::where('monitoring_id', $monitoring->id)->get(),
            'jawabans' => JawabanKuesioner::all()
        ]);
    }

    public function view_kuesioner(Monitoring $monitoring)
    {
        return view('user_view.kuesioner', [
            'pertanyaans' => Kuesioner::all(),
            'jawabans' => JawabanKuesioner::all(),
            'data_bts' => Bts::all(),
            'monitoring' => $monitoring
        ]);
    }

    public function edit_monitoring(Request $request, Monitoring $monitoring)
    {
        $validatedData = $request->validate([
            'tahun' => 'required:|min:4|max:4',
            'bts_id' => 'required',
            'tgl_kunjungan' => 'required',
            'kondisi_bts_id' => '',
            'user_surveyor_id' => 'required'
        ]);

        $validatedData['edited_by'] = auth()->user()->id;

        Monitoring::where('id', $monitoring->id)
                    ->update($validatedData);
        
        return redirect('/v/monitoring')->with('success', 'Monitoring berhasil diupdate!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kuesioner;
use Illuminate\Http\Request;
use App\Models\RecentActivity;
use Illuminate\Routing\Controller;
use App\Http\Requests\UpdateKuesionerRequest;
use App\Models\JawabanKuesioner;

class KuesionerController extends Controller
{

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
     * @param  \App\Http\Requests\StoreKuesionerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Kuesioner
        $validatedData = $request->validate([
            'pertanyaan' => 'required'
        ]);

        $validatedData['created_by'] = auth()->user()->id;
        $validatedData['edited_by'] = auth()->user()->id;

        Kuesioner::create($validatedData);

        // Record Activity
        $activity = [
            'user_id' => auth()->user()->id,
            'action' => 'add',
            'object' => 'pertanyaan kuesioner'
        ];

        RecentActivity::create($activity);

        return redirect('/kuesioner')->with('success', 'Pertanyaan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kuesioner  $kuesioner
     * @return \Illuminate\Http\Response
     */
    public function show(Kuesioner $kuesioner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kuesioner  $kuesioner
     * @return \Illuminate\Http\Response
     */
    public function edit(Kuesioner $kuesioner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKuesionerRequest  $request
     * @param  \App\Models\Kuesioner  $kuesioner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kuesioner $kuesioner)
    {
        // Kuesioner
        $validatedData = $request->validate([
            'pertanyaan' => 'required'
        ]);

        $validatedData['edited_by'] = auth()->user()->id;

        // dd($kuesioner);
        Kuesioner::where('id', $kuesioner->id)
                    ->update($validatedData);

        // Record Activity
        $activity = [
            'user_id' => auth()->user()->id,
            'action' => 'edit',
            'object' => 'pertanyaan kuesioner'
        ];

        RecentActivity::create($activity);

        return redirect('/kuesioner')->with('success', 'Pertanyaan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kuesioner  $kuesioner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kuesioner $kuesioner)
    {
        Kuesioner::destroy($kuesioner->id);

        // Record Activity
        $activity = [
            'user_id' => auth()->user()->id,
            'action' => 'delete',
            'object' => 'pertanyaan kuesioner'
        ];

        RecentActivity::create($activity);

        return redirect('/kuesioner')->with('success', 'Pertanyaan berhasil dihapus!');
    }
}

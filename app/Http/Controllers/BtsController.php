<?php

namespace App\Http\Controllers;

use App\Models\Bts;
use App\Models\FotoBts;
use Illuminate\Http\Request;
use App\Models\RecentActivity;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreBtsRequest;
use App\Http\Requests\UpdateBtsRequest;

class BtsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreBtsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // data BTS yang mau diinsert
        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'tinggi_tower' => 'required',
            'panjang_tanah' => 'required',
            'lebar_tanah' => 'required',
            'foto' => 'required|file|image'
        ]);

        $validatedData['jenis_bts_id'] = $request->jenis_bts_id;
        $validatedData['pemilik_id'] = $request->pemilik_id;
        $validatedData['wilayah_id'] = $request->wilayah_id;
        $validatedData['ada_genset'] = $request->ada_genset;
        $validatedData['ada_tembok_batas'] = $request->ada_tembok_batas;
        $validatedData['created_by'] = auth()->user()->id;
        $validatedData['edited_by'] = auth()->user()->id;

        unset($validatedData['foto']); // dihapus biar ga keinsert ke tabel bts

        $bts = Bts::create($validatedData);

        // upload foto
        $path = $request->file('foto')->store('foto-bts');

        $foto = [
            'bts_id' => $bts->id,
            'path_foto' => $path
        ];
        $foto['created_by'] = auth()->user()->id;
        $foto['edited_by'] = auth()->user()->id;

        FotoBts::create($foto);

        // Record activity
        $bts_record = DB::select("select nama from bts where id = $bts->id");
        $activity = [
            'user_id' => auth()->user()->id,
            'action' => 'add',
            'object' => $bts_record[0]->nama
        ];

        RecentActivity::create($activity);
        
        return redirect('/bts')->with('success', 'BTS berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bts  $bts
     * @return \Illuminate\Http\Response
     */
    public function show(Bts $bts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bts  $bts
     * @return \Illuminate\Http\Response
     */
    public function edit(Bts $bts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBtsRequest  $request
     * @param  \App\Models\Bts  $bts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bts $bt)
    {
        // dd($request);
        // data BTS yang mau diinsert
        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'tinggi_tower' => 'required',
            'panjang_tanah' => 'required',
            'lebar_tanah' => 'required'
        ]);

        $validatedData['jenis_bts_id'] = $request->jenis_bts_id;
        $validatedData['pemilik_id'] = $request->pemilik_id;
        $validatedData['wilayah_id'] = $request->wilayah_id;
        $validatedData['ada_genset'] = $request->ada_genset;
        $validatedData['ada_tembok_batas'] = $request->ada_tembok_batas;
        $validatedData['edited_by'] = auth()->user()->id;

        $bts = Bts::where('id', $bt->id)
                    ->update($validatedData);

        // upload foto
        if($request->file('foto')){
            $path = $request->file('foto')->store('foto-bts');
    
            $foto = [
                'bts_id' => $bt->id,
                'path_foto' => $path
            ];
            $foto['created_by'] = auth()->user()->id;
            $foto['edited_by'] = auth()->user()->id;
    
            FotoBts::create($foto);
        }

        // Record activity
        $bts = DB::select("select nama from bts where id = $bt->id");
        $activity = [
            'user_id' => auth()->user()->id,
            'action' => 'edit',
            'object' => $bts[0]->nama
        ];

        RecentActivity::create($activity);
        
        return redirect('/bts')->with('success', 'BTS berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bts  $bts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bts $bt)
    {
        // Record activity
        $bts = DB::select("select nama from bts where id = $bt->id");
        $activity = [
            'user_id' => auth()->user()->id,
            'action' => 'delete',
            'object' => $bts[0]->nama
        ];

        RecentActivity::create($activity);

        Bts::destroy($bt->id);

        return redirect('/bts')->with('success', 'BTS berhasil dihapus!');
    }
}

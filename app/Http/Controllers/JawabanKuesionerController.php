<?php

namespace App\Http\Controllers;

use App\Models\JawabanKuesioner;
use Illuminate\Http\Request;
use App\Models\RecentActivity;
use Illuminate\Routing\Controller;

class JawabanKuesionerController extends Controller
{
    public function store(Request $request)
    {
        // JawabanKuesioner
        $validatedData = $request->validate([
            'nama' => 'required'
        ]);

        $validatedData['created_by'] = auth()->user()->id;
        $validatedData['edited_by'] = auth()->user()->id;

        JawabanKuesioner::create($validatedData);

        // Record Activity
        $activity = [
            'user_id' => auth()->user()->id,
            'action' => 'add',
            'object' => 'jawaban kuesioner'
        ];

        RecentActivity::create($activity);

        return redirect('/kuesioner')->with('success', 'Jawaban berhasil ditambahkan!');
    }

    public function update(Request $request, JawabanKuesioner $jawabankuesioner)
    {
        // JawabanKuesioner
        $validatedData = $request->validate([
            'nama' => 'required'
        ]);

        $validatedData['edited_by'] = auth()->user()->id;

        JawabanKuesioner::where('id', $jawabankuesioner->id)
                            ->update($validatedData);

        // Record Activity
        $activity = [
            'user_id' => auth()->user()->id,
            'action' => 'edit',
            'object' => 'jawaban kuesioner'
        ];

        RecentActivity::create($activity);

        return redirect('/kuesioner')->with('success', 'Jawaban berhasil diupdate!');
    }

    public function destroy(JawabanKuesioner $jawabankuesioner)
    {
        JawabanKuesioner::destroy($jawabankuesioner->id);

        // Record Activity
        $activity = [
            'user_id' => auth()->user()->id,
            'action' => 'delete',
            'object' => 'jawaban kuesioner'
        ];

        RecentActivity::create($activity);

        return redirect('/kuesioner')->with('success', 'Jawaban berhasil dihapus!');
    }
}

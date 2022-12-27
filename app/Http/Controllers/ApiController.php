<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function chart()
    {
        $result = DB::select('select tahun, count(tahun) as jumlah from monitorings group by tahun');
        return response()->json($result);
    }

    public function monitoring_data(Request $request)
    {
        $result = DB::select("select id, tahun, bts_id, tgl_kunjungan, kondisi_bts_id, user_surveyor_id from monitorings where id = $request->id");
        return response()->json($result);
    }

    public function kuesioner_data(Request $request)
    {
        $result = DB::select("select id, pertanyaan from kuesioners where id = $request->id");
        return response()->json($result);
    }

    public function jawaban_kuesioner_data(Request $request)
    {
        $result = DB::select("select id, nama from jawaban_kuesioners where id = $request->id");
        return response()->json($result);
    }

    public function locations()
    {
        $location = DB::select('select nama, alamat, latitude, longitude from bts');
        return response()->json($location);
    }

    public function bts(Request $request)
    {
        $result = DB::select(
            "select bts.nama as nama, bts.alamat, latitude, longitude, tinggi_tower, panjang_tanah, lebar_tanah, jenis_bts_id, jenis_bts.nama as jenis_bts, pemilik_id, pemiliks.nama as nama_pemilik, wilayah_id, wilayahs.nama as nama_wilayah, ada_genset, ada_tembok_batas, foto_bts.path_foto 
            from bts 
            left join foto_bts on bts.id = foto_bts.bts_id 
            inner join pemiliks on bts.pemilik_id = pemiliks.id 
            inner join wilayahs on bts.wilayah_id = wilayahs.id
            inner join jenis_bts on bts.jenis_bts_id = jenis_bts.id
            where bts.id = $request->id"
        );
        // $result = DB::select("select * from bts left join foto_bts on bts.id = foto_bts.bts_id inner join pemiliks on bts.pemilik_id = pemiliks.id where bts.id = $request->id");
        return response()->json($result);
    }

    public function user(Request $request)
    {
        $result = DB::select("select * from users where id = $request->id");
        return response()->json($result);
    }
}

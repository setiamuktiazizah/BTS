@extends('layouts.main')

@section('container')
    <!-- Header-->
    <header class="py-5">
        <div class="container px-lg-5">
            <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
                <div class="m-4 m-lg-5">
                    <h1 class="display-5 fw-bold">BTS</h1>
                    <p class="fs-4">Sudah banyak BTS yang terdaftar dalam aplikasi kami. Berikut ini adalah daftarnya.</p>
                </div>
            </div>
        </div>
    </header>
    <div class="mt-3">
        {{-- <div>
            <h2 style="text-align: center; margin-bottom: 2rem">
                Data BTS
            </h2>
        </div> --}}
        <div class="col-md-10 mx-auto mb-5 pb-3">
            <table class="table table-striped" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Wilayah</th>
                        <th>Alamat</th>
                        <th>Pemilik</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_bts as $bts)
                    <tr>
                        <td>{{$loop->iteration}} </td>
                        <td>{{$bts->nama}} </td>
                        <td>{{$bts->wilayah->nama}} </td>
                        <td>{{$bts->alamat}} </td>
                        <td>{{$bts->pemilik->nama}} </td>
                        <td>{{$bts->latitude}} </td>
                        <td>{{$bts->longitude}} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
@endsection
@extends('dashboard.layouts.main')

@section('container')
        <div aria-label="breadcrumb" class="container py-2">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/admin" class=" text-black">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data BTS</li>
            </ol>
        </div>

        <!-- Tambahin disini.... -->
        <div class = "ps-3 pt-3 bg-white col-md-10 rounded" >
            @if (session()->has('success'))
                <div class="alert alert-success my-3 me-3">{{ session('success') }}</div>
            @endif
            
            <div class="d-flex align-items-center">
                <h2>
                    Data BTS
                </h2>
            </div>
            <div class="mt-3">
                <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#myModal" ><i class="bi-plus-square-fill"></i> 
                Tambah Data 
                </button>
                {{-- <button type="button" class="btn btn-danger me-3" ><i class="bi-file-pdf"></i> PDF </button>
                    </button>
                <button type="button" class="btn btn-success me-3" ><i class="bi-file-excel"></i> Excel </button> --}}
            <div>
            <div class="mt-3 pb-5 me-2">
                <table class="table table-striped" id="table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama BTS</th>
                        <th>Alamat</th>
                        <th>Pemilik</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($data_bts as $bts)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bts->nama }}</td>
                            <td>{{ $bts->alamat }}</td>
                            <td>{{ $bts->pemilik->nama}} </td>
                            <td>{{ $bts->latitude }}</td>
                            <td>{{ $bts->longitude }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example" style="margin-left: 5rem">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myDetail" data-id="{{ $bts->id }}" width="10"><i class="bi bi-clipboard-fill"></i>Detail</button>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myEdit" data-id="{{ $bts->id }}" width="10"><i class="bi bi-pencil-square"></i>Edit</button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myDelete" data-id="{{ $bts->id }}" width="10"><i class="bi bi-trash"></i>Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>
            </div>
        </div>
        

        <!-- The Modal Input -->
        <div class="modal fade" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Input Data BTS</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" required></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="/bts">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama')
                            is-invalid
                        @enderror">
                    </div>
                    @error('nama')
                        <p class="invalid-feedback d-block">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="jenis_bts" class="form-label">Jenis BTS</label>
                        <select class="form-select" id="jenis_bts" name="jenis_bts_id">
                            @foreach ($data_jenis as $jenis)
                                <option value="{{$jenis->id}}">{{$jenis->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pemilik</label>
                        <select class="form-select" name="pemilik_id">
                            @foreach ($data_pemilik as $pemilik)
                                <option value="{{ $pemilik->id }}">{{ $pemilik->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('pemilik'))
                      <div class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('pemilik') }}</strong>
                      </div>
                    @endif
                    <div class="form-group">
                        <label>Wilayah</label>
                        <select class="form-select" name="wilayah_id" id="wilayah_id">
                            @foreach ($data_wilayah as $wilayah)
                                <option value="{{$wilayah->id}}">{{$wilayah->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" id="alamat" name="alamat" class="form-control {{$errors->has('alamat') ? 'is-invalid' : ''}}">
                    </div>
                    @if($errors->has('alamat'))
                      <div class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('alamat') }}</strong>
                      </div>
                    @endif
                    <div class="form-group">
                        <label>Latitude</label>
                        <input type="text" id="latitude" name="latitude" class="form-control {{$errors->has('latitude') ? 'is-invalid' : ''}}">
                    </div>
                    @if($errors->has('latitude'))
                      <div class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('latitude') }}</strong>
                      </div>
                    @endif
                    <div class="form-group">
                        <label>Longitude</label>
                        <input type="text" id="longitude" name="longitude" class="form-control {{$errors->has('longitude') ? 'is-invalid' : ''}}">
                    </div>
                    @if($errors->has('longitude'))
                      <div class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('longitude') }}</strong>
                      </div>
                    @endif
                    <div class="form-group">
                        <label>Tinggi Tower</label>
                        <input type="number" id="tinggi_tower" name="tinggi_tower" class="form-control {{$errors->has('tinggi_tower') ? 'is-invalid' : ''}}">
                    </div>
                    @if($errors->has('tinggi_tower'))
                    <div class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('tinggi_tower') }}</strong>
                    </div>
                    @endif
                    <div class="form-group">
                        <label>Panjang Tanah</label>
                        <input type="number" id="panjang_tanah" name="panjang_tanah" class="form-control {{$errors->has('panjang_tanah') ? 'is-invalid' : ''}}">
                    </div>
                    @if($errors->has('panjang_tanah'))
                    <div class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('panjang_tanah') }}</strong>
                    </div>
                    @endif
                    <div class="form-group">
                        <label>Lebar Tanah</label>
                        <input type="number" id="lebar_tanah" name="lebar_tanah" class="form-control {{$errors->has('lebar_tanah') ? 'is-invalid' : ''}}">
                    </div>
                    @if($errors->has('lebar_tanah'))
                    <div class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('lebar_tanah') }}</strong>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="ada_genset" class="form-label">Ada Genset</label>
                        <select class="form-select" id="ada_genset" name="ada_genset">
                            <option value="1">Ada</option>
                            <option value="0">Tidak Ada</option>
                        </select>
                    </div>
                    <div class="form-group">
                         <label for="ada_tembok_batas" class="form-label">Ada Tembok Batas</label>
                        <select class="form-select" id="ada_tembok_batas" name="ada_tembok_batas">
                            <option value="1">Ada</option>
                            <option value="0">Tidak Ada</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="foto">File Foto</label>
                        <input type="file" name="foto" class="form-control {{$errors->has('foto') ? 'is-invalid' : ''}}" id="foto">
                    </div>
                    @if($errors->has('foto'))
                        <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('foto') }}</strong>
                        </div>
                    @endif
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <section>
                <button type="submit" class="btn btn-primary">Submit</button>
                </section>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              </div>

            </form>
            </div>
          </div>
        </div>

        <!-- The Modal Edit -->
        <div class="modal fade" id="myEdit">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Edit Data BTS</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form method="POST" action="/bts/" id="form_edit" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="" id="nama">
                    </div>
                     <div class="form-group">
                        <label for="jenis_bts" class="form-label">Jenis BTS</label>
                        <select class="form-select" name="jenis_bts_id" value="">
                            @foreach ($data_jenis as $jenis_bts)
                            <option value="{{$jenis_bts->id}}" >{{$jenis_bts->nama}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pemilik</label>
                        <select class="form-select" name="pemilik_id" value="" >
                            @foreach ($data_pemilik as $pemilik)
                                <option value="{{ $pemilik->id }}"> {{$pemilik->nama}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Wilayah</label>
                        <select class="form-select" name="wilayah_id" value="">
                            @foreach ($data_wilayah as $wilayah)
                                <option value="{{ $wilayah->id }}">{{$wilayah->nama}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>Latitude</label>
                        <input type="text" name="latitude" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>Longitude</label>
                        <input type="text" name="longitude" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>Tinggi Tower</label>
                        <input type="number" name="tinggi_tower" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>Panjang Tanah</label>
                        <input type="number" name="panjang_tanah" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>Lebar Tanah</label>
                        <input type="number" name="lebar_tanah" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="ada_genset" class="form-label">Ada Genset</label>
                        <select class="form-select" id="ada_genset" name="ada_genset" value="">
                            <option value="1">Ada</option>
                            <option value="0">Tidak Ada</option>
                        </select>
                    </div>
                    <div class="form-group">
                         <label for="ada_tembok_batas" class="form-label">Ada Tembok Batas</label>
                        <select class="form-select" id="ada_tembok_batas" name="ada_tembok_batas" value="">
                            <option value="1">Ada</option>
                            <option value="0">Tidak Ada</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto
                            <span style="font-size: 0.8rem">(Upload untuk menambah foto)</span>
                        </label>
                        <div id="image-edit-container">
                            {{-- <img src="" style="width: 200px; height: 200px" class="my-3 d-block" id="image-edit"> --}}
                        </div>
                        <input type="file" name="foto" class="form-control">
                    </div>

              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              </div>

            </form>
            </div>
          </div>
        </div>
       

         <!-- The Modal Detail -->
        <div class="modal" id="myDetail">
          <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">DETAIL DATA BTS</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              
              <div class="modal-body">
                <table class="table">
                    <div class="d-flex justify-content-center mb-3" id="image-detail-container">
                        {{-- <img src="" style="width: 300px; height: 300px" class="me-3" id="image-detail"> --}}
                    </div>
                    
                    <tr>
                        <th>Nama BTS</th>
                        <td id="nama"></td>
                    </tr>
                    <tr>
                        <th>Jenis BTS</th>
                        <td id="jenis_bts"></td>
                    </tr>
                    <tr>
                        <th>Pemilik</th>
                        <td id="pemilik"></td> 
                    </tr>
                    <tr>
                        <th>Wilayah</th>
                        <td id="wilayah"></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td id="alamat"></td>
                    </tr>
                    <tr>
                        <th>Latitude</th>
                        <td id="latitude"></td>
                    </tr>
                    <tr>
                        <th>Longitude</th>
                        <td id="longitude"></td>
                    </tr>
                    <tr>
                        <th>Tinggi Tower</th>
                        <td id="tinggi_tower"></td>
                    </tr>
                    <tr>
                        <th>Panjang Tanah</th>
                        <td id="panjang_tanah"></td>
                    </tr>
                    <tr>
                        <th>Lebar Tanah</th>
                        <td id="lebar_tanah"></td>
                    </tr>
                    <tr>
                        <th>Ada Genset</th>
                        <td id="ada_genset"></td>
                    </tr>
                    <tr>
                        <th>Ada Tembok Batas</th>
                        <td id="ada_tembok_batas"></td>
                    </tr>
                </table>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              </div>

            </div>
          </div>
        </div> 
        
        <!-- Modal Delete -->
        <div class="modal fade" id="myDelete" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="" id="form-delete">
                    @csrf
                    @method('delete')
                    <div class="modal-body" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                        <h5 class="text-center">Apakah Anda yakin ingin menghapus?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Ya</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                    </div>
                </form>
            </div>
            </div>
            </div>
        </div>
        
        <script>
            // show data on edit
            $('#myEdit').on('show.bs.modal', function(e) {
                var bts_id = $(e.relatedTarget).data('id');
                const url = '{{ url('/api/bts') }}' + '/' + bts_id;

                $.get(url, function(response){
                    
                    var nama = response[0].nama;
                    var alamat = response[0].alamat;
                    var latitude = response[0].latitude;
                    var longitude = response[0].longitude;
                    var tinggi_tower = response[0].tinggi_tower;
                    var panjang_tanah = response[0].panjang_tanah;
                    var lebar_tanah = response[0].lebar_tanah;
                    var jenis_bts_id = response[0].jenis_bts_id;
                    var pemilik = response[0].pemilik_id;
                    var wilayah_id = response[0].wilayah_id;
                    var ada_genset = response[0].ada_genset;
                    var ada_tembok_batas = response[0].ada_tembok_batas;
                    var path_foto = response[0].path_foto;
                    // console.log(path_foto);
            
                    $(e.currentTarget).find('#form_edit').attr('action', '/bts/' + bts_id);
                    $(e.currentTarget).find('input[name="nama"]').val(nama);
                    $(e.currentTarget).find('input[name="alamat"]').val(alamat);
                    $(e.currentTarget).find('input[name="latitude"]').val(latitude);
                    $(e.currentTarget).find('input[name="longitude"]').val(longitude);
                    $(e.currentTarget).find('input[name="tinggi_tower"]').val(tinggi_tower);
                    $(e.currentTarget).find('input[name="panjang_tanah"]').val(panjang_tanah);
                    $(e.currentTarget).find('input[name="lebar_tanah"]').val(lebar_tanah);
                    $(e.currentTarget).find('select[name="jenis_bts_id"]').val(jenis_bts_id);
                    $(e.currentTarget).find('select[name="pemilik_id"]').val(pemilik);
                    $(e.currentTarget).find('select[name="wilayah_id"]').val(wilayah_id);
                    $(e.currentTarget).find('select[name="ada_genset"]').val(ada_genset);
                    $(e.currentTarget).find('select[name="ada_tembok_batas"]').val(ada_tembok_batas);
                    if(response[0].path_foto !== null){
                        response.forEach(function(data){
                            var path = "{{ asset('storage/') }}" + '/' + data.path_foto;
                            $(e.currentTarget).find('#image-edit-container').append('<img src="' + path +'" style="width: 200px; height: 200px" class="my-3 d-block">');
                        })
                    }
                    
                });
            });

            // reset image on edit
            $('#myEdit').on('hide.bs.modal', function(e){
                $(e.currentTarget).find('#image-edit-container').empty();
            });

            // show data on detail
            $('#myDetail').on('show.bs.modal', function(e) {
                var bts_id = $(e.relatedTarget).data('id');
                const url = '{{ url('/api/bts') }}' + '/' + bts_id;

                $.get(url, function(response){
                    var nama = response[0].nama;
                    var alamat = response[0].alamat;
                    var latitude = response[0].latitude;
                    var longitude = response[0].longitude;
                    var tinggi_tower = response[0].tinggi_tower;
                    var panjang_tanah = response[0].panjang_tanah;
                    var lebar_tanah = response[0].lebar_tanah;
                    var jenis_bts_id = response[0].jenis_bts_id;
                    var jenis_bts = response[0].jenis_bts;
                    var pemilik = response[0].pemilik_id;
                    var nama_pemilik = response[0].nama_pemilik;
                    var wilayah_id = response[0].wilayah_id;
                    var nama_wilayah = response[0].nama_wilayah;
                    var ada_genset = response[0].ada_genset;
                    var ada_tembok_batas = response[0].ada_tembok_batas;
            
                    $(e.currentTarget).find('td#nama').text(nama).attr('class', 'w-75');
                    $(e.currentTarget).find('td#alamat').text(alamat);
                    $(e.currentTarget).find('td#latitude').text(latitude);
                    $(e.currentTarget).find('td#longitude').text(longitude);
                    $(e.currentTarget).find('td#tinggi_tower').text(tinggi_tower);
                    $(e.currentTarget).find('td#panjang_tanah').text(panjang_tanah);
                    $(e.currentTarget).find('td#lebar_tanah').text(lebar_tanah);
                    $(e.currentTarget).find('td#pemilik').text(nama_pemilik);
                    $(e.currentTarget).find('td#wilayah').text(nama_wilayah);
                    $(e.currentTarget).find('td#jenis_bts').text(jenis_bts);
                    (ada_genset) ? $(e.currentTarget).find('td#ada_genset').text('Ada') : $(e.currentTarget).find('td#ada_genset').text('Tidak ada');
                    (ada_tembok_batas) ? $(e.currentTarget).find('td#ada_tembok_batas').text('Ada') : $(e.currentTarget).find('td#ada_tembok_batas').text('Tidak ada');
                    
                    if(response[0].path_foto !== null){
                        response.forEach(function(data){
                            var path = "{{ asset('storage/') }}" + '/' + data.path_foto;
                            $(e.currentTarget).find('#image-detail-container').append('<img src="' + path +'" style="width: 300px; height: 300px" class="me-3">');
                        })
                    }
                    
                });
            });

            // reset image on detail
            $('#myDetail').on('hide.bs.modal', function(e){
                $(e.currentTarget).find('#image-detail-container').empty();
            });

            $('#myDelete').on('show.bs.modal', function (e) {
                var bts_id = $(e.relatedTarget).data('id');
                console.log(bts_id);
                $(e.currentTarget).find('#form-delete').attr('action', '/bts/' + bts_id);
            })
        </script>
@endsection
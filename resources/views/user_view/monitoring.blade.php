@extends('layouts.main')

@section('container')
    <!-- Header-->
    {{-- <header class="masthead text-center text-white">
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
    </header> --}}

    <!-- Tambahin disini.... -->
    <div class="ps-3 col-md-10 mx-auto mt-5" >
      @if (session()->has('success'))
        <div class="alert alert-success my-3">{{ session('success') }}</div>
      @endif


      <div class="d-flex align-items-center">
        <h2>
          Data Monitoring
        </h2>
      </div>

      <!-- Select BTS -->
      <div class="me-3" >
        <div>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert">Add Monitoring</button>
          
          <div class="mt-3 mb-5 pb-3">
            <table class="table table-striped mt-4 pb-3" id="table">
              <thead>
                <tr>
                  <th >No</th>
                  <th >Tahun</th>
                  <th >BTS</th>
                  <th >Tanggal Kunjungan</th>
                  <th >Kondisi</th>
                  <th >Surveyor</th>
                  <th >Opsi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($monitorings as $monitoring)
                  <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td id="tahun">{{ $monitoring->tahun }}</td>
                    <td id="bts_tabel">{{ $monitoring->bts->nama }}</td>
                    <td id="tgl_kunjungan">{{ $monitoring->tgl_kunjungan }}</td>
                    <td id="kondisi_id">{{ ($monitoring->kondisi_bts) ? $monitoring->kondisi_bts->nama : ''}}</td>
                    <td id="surveyor_id">{{ $monitoring->user_surveyor->name }}</td>
                    <td class="">
                        <button type="button" class="btn btn-primary btn-sm me-3" data-bs-toggle="modal" data-bs-target="#myEdit" data-id="{{ $monitoring->id }}"><i class="bi-pencil-square"></i> Edit</button>
                        <a href="/v/monitoring/{{ $monitoring->id }}/pertanyaan" class="btn btn-success btn-sm"><i class="bi bi-arrow-right"></i> Kuesioner</a>
                    </td>
                  </tr>
                @endforeach
                
              </tbody>
            </table>
            
          </div>
        </div>

        {{-- Modal Insert --}}
        <div class="modal fade" id="insert">
            <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Add Monitoring</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                <form method="post" action="/v/monitoring" id="form-insert">
                    @csrf
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="text" name="tahun" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="bts" class="form-label">BTS</label>
                        <select class="form-select" id="bts" name="bts_id" value="">
                            @foreach ($data_bts as $row)
                                <option value="{{ $row->id }}">{{ $row->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tgl_kunjungan">Tanggal Kunjungan</label>
                        <input type="date" name="tgl_kunjungan" class="form-control" value="">
                    </div>
                    {{-- <div class="form-group">
                        <label>Kondisi BTS</label>
                        <select class="form-select" id="kondisi_bts" name="kondisi_bts_id" value="">
                            @foreach ($data_kondisi_bts as $row)
                                <option value="{{ $row->id }}">{{ $row->nama }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    {{-- <div class="form-group">
                        <label>Surveyor</label>
                        <select class="form-select" id="surveyor" name="user_surveyor_id" value="">
                            @foreach ($data_surveyor as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
                </div>


            </div>
            </div>
        </div>
        </div>

        <!-- The Modal Edit -->
        <div class="modal fade" id="myEdit">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Edit Data Monitoring</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form method="post" action="/v/monitoring" id="form-edit">
                  @csrf
                  @method('put')
                  <div class="form-group">
                    <label>Tahun</label>
                    <input type="text" name="tahun" class="form-control" value="">
                  </div>
                  <div class="form-group">
                    <label for="bts" class="form-label">BTS</label>
                    <select class="form-select" id="bts" name="bts_id" value="">
                      @foreach ($data_bts as $row)
                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="tgl_kunjungan">Tanggal Kunjungan</label>
                    <input type="date" name="tgl_kunjungan" class="form-control" value="">
                  </div>
                  <div class="form-group">
                    <label>Kondisi BTS</label>
                    <select class="form-select" id="kondisi_bts" name="kondisi_bts_id" value="">
                      @foreach ($data_kondisi_bts as $row)
                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Surveyor</label>
                    <select class="form-select" id="surveyor" name="user_surveyor_id" value="">
                      @foreach ($data_surveyor as $row)
                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  
                  
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>


            </div>
          </div>
        </div>
      </div>

  <script>
    $('#myEdit').on('show.bs.modal', function(e) {
      var monitoring_id = $(e.relatedTarget).data('id');
      const url = '{{ url('/api/monitoring') }}' + '/' + monitoring_id;

      $.get(url, function(response){
        var tahun = response[0].tahun;
        var bts = response[0].bts_id;
        var tgl_kunjungan = response[0].tgl_kunjungan;
        var kondisi_id = response[0].kondisi_bts_id;
        var surveyor_id = response[0].user_surveyor_id;
  
        $(e.currentTarget).find('#form-edit').attr('action', '/v/monitoring/' + monitoring_id);
        $(e.currentTarget).find('input[name="tahun"]').val(tahun);
        $(e.currentTarget).find('select[name="bts_id"]').val(bts);
        $(e.currentTarget).find('input[name="tgl_kunjungan"]').val(tgl_kunjungan);
        $(e.currentTarget).find('select[name="kondisi_bts_id"]').val(kondisi_id);
        $(e.currentTarget).find('select[name="user_surveyor_id"]').val(surveyor_id);
      });
    });
  </script>

  
@endsection
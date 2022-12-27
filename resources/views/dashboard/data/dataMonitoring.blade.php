@extends('dashboard.layouts.main')

@section('container')
    <div aria-label="breadcrumb" class="container py-2">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../home/index.php" class=" text-black">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Monitoring</li>
      </ol>
    </div>

    <!-- Tambahin disini.... -->
    <div class="ps-3 pt-3 bg-white rounded col-md-10" >
      @if (session()->has('success'))
        <div class="alert alert-success my-3 me-3">{{ session('success') }}</div>
      @endif


      <div class="d-flex align-items-center">
        <h2>
          Data Monitoring
        </h2>
      </div>

      <!-- Select BTS -->
      <div class="me-3" >
        <div class="">
          <form action="#" method="get">
            <label for="bts" class="form-label">Select BTS</label>
            <select name="bts" id="bts" class="form-select" onchange="submit();">
              @foreach ($data_bts as $row)
                @if (!empty($_GET['bts']) && $_GET['bts'] == $row->id)
                  <option value="{{ $row->id }}" selected>{{ $row->nama }}</option>
                @else
                  <option value="{{ $row->id }}">{{ $row->nama }}</option>                
                @endif
              @endforeach
            </select>
          </form>
        </div>

        <div>
          {{-- <button type="button" class="btn btn-danger mt-3 me-3" ><i class="bi-file-pdf"></i> PDF </button>
          <button type="button" class="btn btn-success mt-3"><i class="bi-file-excel"></i> Excel </button> --}}
          
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
                    <td id="kondisi_id">{{($monitoring->kondisi_bts) ? $monitoring->kondisi_bts->nama : ''}}</td>
                    <td id="surveyor_id">{{ $monitoring->user_surveyor->name }}</td>
                    <td class="d-flex justify-content-between">
                        <button type="button" class="btn btn-primary btn-sm me-3" data-bs-toggle="modal" data-bs-target="#myEdit1" data-id="{{ $monitoring->id }}"><i class="bi-pencil-square"></i></button>
                        <form action="/monitoring/{{ $monitoring->id }}" method="post" class="d-inline">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-danger btn-sm me-3" onclick="return confirm('Anda yakin?');"><i class="bi-trash"></i></button>
                        </form>
                        <a href="/v/monitoring/{{ $monitoring->id }}/pertanyaan" class="btn btn-success btn-sm "><i class="bi-arrow-right"></i></a>
                    </td>
                  </tr>
                @endforeach
                
              </tbody>
            </table>
            
          </div>
        </div>

        <!-- The Modal Edit -->
        <div class="modal fade" id="myEdit1">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Edit Data Monitoring</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form method="post" action="/monitoring" id="modal-form">
                  @csrf
                  @method('put')
                  <input type="hidden" name="id" value="">
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
    $('#myEdit1').on('show.bs.modal', function(e) {
      var monitoring_id = $(e.relatedTarget).data('id');
      const url = '{{ url('/api/monitoring') }}' + '/' + monitoring_id;

      $.get(url, function(response){
        var id = response[0].id;
        var tahun = response[0].tahun;
        var bts = response[0].bts_id;
        var tgl_kunjungan = response[0].tgl_kunjungan;
        var kondisi_id = response[0].kondisi_bts_id;
        var surveyor_id = response[0].user_surveyor_id;
  
        $(e.currentTarget).find('input[name="id"]').val(id);
        $(e.currentTarget).find('input[name="tahun"]').val(tahun);
        $(e.currentTarget).find('select[name="bts_id"]').val(bts);
        $(e.currentTarget).find('input[name="tgl_kunjungan"]').val(tgl_kunjungan);
        $(e.currentTarget).find('select[name="kondisi_bts_id"]').val(kondisi_id);
        $(e.currentTarget).find('select[name="user_surveyor_id"]').val(surveyor_id);
      });
    });
  </script>

  
@endsection
@extends('dashboard.layouts.main')

@section('container')
    <div aria-label="breadcrumb" class="container py-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin" class=" text-black">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kuesioner</li>
        </ol>
    </div>

    <div class="col-md-10">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active " id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Pertanyaan</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Jawaban</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active bg-white rounded px-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <a href="#" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#add">Tambah pertanyaan</a>
                <div class="mt-3 mb-5 pb-3">
                    <table class="table table-striped mt-4 pb-3" id="table">
                      <thead>
                        <tr>
                          <th width="50px">No</th>
                          <th >Pertanyaan</th>
                          <th >Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($kuesioners as $kuesioner)
                          <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td id="tahun">{{ $kuesioner->pertanyaan }}</td>
                            <td >
                                <button type="button" class="btn btn-primary btn-sm me-3" data-bs-toggle="modal" data-bs-target="#edit" data-id="{{ $kuesioner->id }}"><i class="bi-pencil-square"></i></button>
                                <form action="/kuesioner/{{ $kuesioner->id }}" method="post" class="d-inline">
                                  @csrf
                                  @method('delete')
                                  <button type="submit" class="btn btn-danger btn-sm me-3" onclick="return confirm('Anda yakin?');"><i class="bi-trash"></i></button>
                                </form>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade bg-white rounded px-3" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
              <a href="#" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#add_jawaban">Tambah Jawaban</a>
              <div class="mt-3 mb-5 pb-3">
                <table class="table table-striped mt-4 pb-3 w-100" id="table_jawaban">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th >Jawaban</th>
                      <th >Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($jawabans as $jawaban)
                      <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td id="tahun">{{ $jawaban->nama }}</td>
                        <td >
                            <button type="button" class="btn btn-primary btn-sm me-3" data-bs-toggle="modal" data-bs-target="#edit_jawaban" data-id="{{ $jawaban->id }}"><i class="bi-pencil-square"></i></button>
                            <form action="/jawabankuesioner/{{ $jawaban->id }}" method="post" class="d-inline">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-danger btn-sm me-3" onclick="return confirm('Anda yakin?');"><i class="bi-trash"></i></button>
                            </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
      
    {{-- Modal Add --}}
    <div class="modal fade" id="add">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Tambah Pertanyaan</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <form method="post" action="/kuesioner" id="form-add">
                @csrf
                <div class="form-group">
                  <label class="form-label">Pertanyaan</label>
                  <input type="text" name="pertanyaan" class="form-control" required autofocus>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Tambah</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
              </form>
            </div>


          </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit Pertanyaan</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <form method="post" action="/kuesioner" id="form-edit">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="">
                <div class="form-group">
                  <label class="form-label">Pertanyaan</label>
                  <input type="text" name="pertanyaan" class="form-control" required value="" >
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

    {{-- Modal Add Jawaban --}}
    <div class="modal fade" id="add_jawaban">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Tambah Jawaban</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form method="post" action="/jawabankuesioner" id="form-add">
              @csrf
              <div class="form-group">
                <label class="form-label">Jawaban</label>
                <input type="text" name="nama" class="form-control" required autofocus>
              </div>
              
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Tambah</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              </div>
            </form>
          </div>


        </div>
      </div>
  </div>

  {{-- Modal Edit --}}
  <div class="modal fade" id="edit_jawaban">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Edit Jawaban</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form method="post" action="/jawabankuesioner" id="form-edit-jawaban">
              @csrf
              @method('put')
              <input type="hidden" name="id" value="">
              <div class="form-group">
                <label class="form-label">Jawaban</label>
                <input type="text" name="nama" class="form-control" required value="">
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

    <script>
      $(document).ready(function(){
        $('#table_jawaban').DataTable();
      });
      
      $('#edit').on('show.bs.modal', function(e) {
        var kuesioner_id = $(e.relatedTarget).data('id');
        const url = '{{ url('/api/kuesioner') }}' + '/' + kuesioner_id;
  
        $.get(url, function(response){
          var id = response[0].id;
          var pertanyaan = response[0].pertanyaan;
    
          $(e.currentTarget).find('form[action="/kuesioner"]').attr('action', '/kuesioner/' + id);
          $(e.currentTarget).find('input[name="id"]').val(id);
          $(e.currentTarget).find('input[name="pertanyaan"]').val(pertanyaan);
        });
      });

      $('#edit_jawaban').on('show.bs.modal', function(e) {
        var jawaban_kuesioner_id = $(e.relatedTarget).data('id');
        const url = '{{ url('/api/jawabankuesioner') }}' + '/' + jawaban_kuesioner_id;
  
        $.get(url, function(response){
          var id = response[0].id;
          var nama = response[0].nama;
    
          $(e.currentTarget).find('form[action="/jawabankuesioner"]').attr('action', '/jawabankuesioner/' + id);
          $(e.currentTarget).find('input[name="id"]').val(id);
          $(e.currentTarget).find('input[name="nama"]').val(nama);
        });
      });
    </script>
@endsection
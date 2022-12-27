@extends('dashboard.layouts.main')

@section('container')
        <div aria-label="breadcrumb" class="container py-2">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin" class=" text-black">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data {{ Request::is('operator') ? 'Operator' : 'User' }}</li>
          </ol>
        </div>

        <!-- Tambahin disini.... -->
        <div class = "ps-3 col-md-10 bg-white rounded pt-3" >
          @if (session()->has('success'))
            <div class="alert alert-success mt-3 me-3">{{ session('success') }}</div>
          @endif

            <div class="d-flex align-items-center">
                <h2>
                    Data {{ Request::is('operator') ? 'Operator' : 'User' }}
                </h2>
            </div>
            <div class="mt-3 pb-3 mb-5" >
                <div>
                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style="margin-top: 15px; margin-right: 30px; margin-left: 15px;"><i class="bi-plus-square-fill"></i> 
                    Tambah Data 
                    </button> --}}
                    {{-- <button type="button" class="btn btn-danger" ><i class="bi-file-pdf"></i> PDF </button>
                     </button>
                    <button type="button" class="btn btn-success" ><i class="bi-file-excel"></i> Excel </button> --}}
                <div>
                <div class="mt-3 pe-3">
                  <table class="table table-striped border-top" id="table">
                    <thead>
                      <tr>
                        <th >No</th>
                        <th >Nama Operator</th>
                        <th >Email</th>
                        <th >Role</th>
                        <th >Aksi</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($data_operator as $operator)
                      <tr>
                        <th >{{$loop->iteration}} </th>
                        <td >{{$operator->name}} </td>
                        <td >{{$operator->email}} </td>
                        <td >{{ucfirst($operator->role)}} </td>
                        <td>
                          <div class="btn-group" role="group" aria-label="Basic example" style="margin-left: 5rem">
                            <a href="/profile/{{ $operator->id }}" class="btn btn-success" width="10"><i class="bi bi-bag-plus"></i> Detail</a>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myEdit" data-id="{{ $operator->id }}" width="10"><i class="bi bi-pencil-square"></i> Edit</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myDelete" data-id="{{ $operator->id }}" width="10"><i class="bi bi-trash"></i> Delete</button>
                        </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table> 
                </div>
            </div>
        </div>

        {{-- Modal Edit --}}
        <div class="modal fade" id="myEdit">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form method="post" action="/user/" id="form-edit">
                  @csrf
                  @method('put')
                  <div class="form-group">
                    <label>Role</label>
                    <select name="role" id="role" class="form-select">
                      <option value="admin">Admin</option>
                      <option value="surveyor">Surveyor</option>
                      <option value="user">User</option>
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
        $('#myDelete').on('show.bs.modal', function (e) {
          var operator_id = $(e.relatedTarget).data('id');

          $(e.currentTarget).find('#form-delete').attr('action', '/user/' + operator_id);
        });
        
        $('#myEdit').on('show.bs.modal', function (e) {
          var operator_id = $(e.relatedTarget).data('id');
          var url = '{{ url('/api/user') }}' + '/' + operator_id;

          $.get(url, function(response){
            $(e.currentTarget).find('#form-edit').attr('action', '/user/' + operator_id);
            $(e.currentTarget).find('select[name="role"]').val(response[0].role);
          })

        });
      </script>
@endsection
@extends('dashboard.layouts.main')

@section('container')
    <div aria-label="breadcrumb" class="container py-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin" class=" text-black">Home</a></li>
            <li class="breadcrumb-item"><a href="/profile" class=" text-black">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
        </ol>
    </div>

    <div class="container row" >
        <h3 class="ps-0">Change Password</h3>
        <form action="" method="post" class="col-md-6 bg-light rounded mt-3">
            @csrf
            <div class="row pt-3">
                <div class="col-md-4 ">    
                    <label class="form-label">Password Lama</label>
                </div>
                <div class="col-md-8">
                    <input type="password" id="password_old" name="password_old" class="form-control @error('password_old')
                        is-invalid
                    @enderror">
                </div>
                @error('password_old')
                <div class="col-md-8 ms-auto">
                    <p class="text-danger mb-0 mt-1">{{ $message }}</p>
                </div>
                @enderror
            </div>
            <div class="row mt-3">
                <div class="col-md-4 ">    
                    <label class="form-label">Password Baru</label>
                </div>
                <div class="col-md-8">
                    <input type="password" id="password" name="password" class="form-control @error('password')
                        is-invalid
                    @enderror">
                </div>
                @error('password')
                    <div class="col-md-8 ms-auto">
                    <p class="text-danger mb-0 mt-1">{{ $message }}</p>
                </div>
                @enderror
            </div>
            <div class="row mt-3">
                <div class="col-md-4 ">    
                    <label class="form-label">Konfirmasi Password</label>
                </div>
                <div class="col-md-8">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation')
                        is-invalid
                    @enderror">
                </div>
                @error('password_confirmation')
                    <div class="col-md-8 ms-auto">
                    <p class="text-danger mb-0 mt-1">{{ $message }}</p>
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary my-3">Ganti Password</button>
        </form>
    </div>
@endsection
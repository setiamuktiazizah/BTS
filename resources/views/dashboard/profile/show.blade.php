@extends('dashboard.layouts.main')

@section('container')
    <div aria-label="breadcrumb" class="container py-2 ">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="/admin" class=" text-black">Home</a></li>
            <li class="breadcrumb-item"><a href="" class=" text-black">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $profile->name }}</li>
        </ol>
    </div>

    <div class="container">
        <h3 class="fw-bold mb-3">Profile</h3>
        <div class="row">
            <div class="col-md-2">
                <img src="{{ asset('img/profile-pic.png') }}" alt="Profile picture" class="rounded-circle w-75">
            </div>
            <div class="col-md-3 d-flex flex-column justify-content-center">
                <h5 class="fw-bold">{{ $profile->name }}</h5>
                <div class="badge bg-success align-self-start">{{ ucfirst($profile->role) }}</div>
            </div>
        </div>
        <form action="" class="form-group col-md-9 my-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control disabled" value="{{ $profile->email }}" disabled>
            <label for="" class="form-label">Alamat</label>
            <textarea type="text" class="form-control disabled" disabled>{{ $profile->alamat }}</textarea>
            <label for="" class="form-label">No Hp</label>
            <input type="text" class="form-control disabled" value="{{ $profile->no_hp }}" disabled>
        </form>
    </div>
@endsection
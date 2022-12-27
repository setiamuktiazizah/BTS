@extends('dashboard.layouts.main')

@section('container')
    <div aria-label="breadcrumb" class="container py-2 ">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="/admin" class=" text-black">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </div>

    @if (session()->has('success'))
        <div class="col-md-9 ">
            <div class="alert alert-success">{{ session('success') }}</div>
        </div>
    @endif

    <div class="container">
        <h3 class="fw-bold mb-3">Profile</h3>
        <div class="row">
            <div class="col-md-2">
                <img src="{{ asset('img/profile-pic.png') }}" alt="Profile picture" class="rounded-circle w-75">
            </div>
            <div class="col-md-3 d-flex flex-column justify-content-center">
                <h5 class="fw-bold">{{ auth()->user()->name }}</h5>
                <div class="badge bg-success align-self-start">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
        </div>
        <form action="" class="form-group col-md-9 my-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control disabled" value="{{ auth()->user()->email }}" disabled>
            <label for="" class="form-label">Alamat</label>
            <textarea type="text" class="form-control disabled" disabled>{{ auth()->user()->alamat }}</textarea>
            <label for="" class="form-label">No Hp</label>
            <input type="text" class="form-control disabled" value="{{ auth()->user()->no_hp }}" disabled>
        </form>
        <a href="/profile/{{ auth()->user()->id }}/edit" class="btn btn-primary">Edit Profile</a>
    </div>
@endsection
@extends('layouts.main')

@section('container')
    <!-- Header-->
    <header class="py-5">
        <div class="container px-lg-5">
            <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
                <div class="m-4 m-lg-5">
                    <h1 class="display-5 fw-bold">Kuesioner</h1>
                    <p class="fs-4">Form pertanyaan di bawah ini kami butuhkan sebagai salah satu media untuk memantau kondisi BTS.</p>
                </div>
            </div>
        </div>
    </header>

    <div class="col-md-9 my-3 mx-auto">
        {{-- <a href="/v/monitoring" class="btn btn-primary mb-3"><i class="bi bi-arrow-left"></i> Back</a>
        <h2>Kuesioner</h2> --}}
        <form action="/v/monitoring/pertanyaan" method="post" class="form-group">
            <?php $count = 1; ?>
            @foreach ($kuesioner as $row)
                <label class="form-label d-block">{{ $row->kuesioner->pertanyaan }}</label>
                <div class="form-group mb-3">
                    @foreach ($jawabans as $jawaban)
                        <div class="form-check">
                            <label for="{{ $count }}_{{ $jawaban->id }}" class="form-check-label">{{ $jawaban->nama }}</label>
                            <input type="radio" id="{{ $count }}_{{ $jawaban->id }}" class="form-check-input"
                            name="jawaban{{ $count }}" value="{{ $jawaban->id }}" 
                            @if ($row->jawaban_kuesioner->id == $jawaban->id)
                                checked
                            @endif disabled>
                        </div>
                    @endforeach
                </div>
            <?php $count = $count + 1; ?>
            @endforeach
        </form>
        <div class="d-grid">
            <a href="/v/monitoring" class="btn btn-primary my-3">Back</a>
        </div>
    </div>
@endsection
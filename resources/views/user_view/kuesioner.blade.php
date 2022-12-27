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

    <div class="col-md-9 mt-3 mx-auto">
        <form action="/v/monitoring/{{ $monitoring->id }}" method="post" class="form-group">
            @csrf
            <?php $count = 1; ?>
            @foreach ($pertanyaans as $row)
                <label class="form-label d-block">{{ $row->pertanyaan }}</label>
                <input type="hidden" name="pertanyaan{{ $row->id }}" value="{{ $row->id }}">
                <div class="form-group mb-3">
                    @foreach ($jawabans as $jawaban)
                        <div class="form-check">
                            <label for="{{ $count }}_{{ $jawaban->id }}" class="form-check-label is-invalid">{{ $jawaban->nama }}</label>
                            <input type="radio" id="{{ $count }}_{{ $jawaban->id }}" class="form-check-input 
                            @error('jawaban' . $count)
                                is-invalid
                            @enderror" 
                            name="jawaban{{ $count }}" value="{{ $jawaban->id }}" 
                            @if (old('jawaban' . $count) == $jawaban->id)
                                checked
                            @endif>
                        </div>
                    @endforeach
                    @error('jawaban' . $count)
                        <p class="invalid-feedback d-block">{{ $message }}</p>
                    @enderror
                </div>
            <?php $count = $count + 1; ?>
            @endforeach

            <div class="d-grid mb-5">
                <button class="btn btn-primary " id="submitButton" type="submit">Submit</button>
            </div>
        </form>
    </div>
@endsection
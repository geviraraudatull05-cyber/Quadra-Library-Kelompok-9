@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-4">
        <img src="{{ asset('storage/'.$book->cover_path) }}"
             class="img-fluid rounded"
             style="box-shadow:0px 4px 10px rgba(0,0,0,0.2)">
    </div>

    <div class="col-md-8">
        <h2 class="fw-bold">{{ $book->title }}</h2>
        <p class="text-muted">{{ $book->author }}</p>

        <p>{{ $book->description }}</p>

        <p><b>Total Buku:</b> {{ $book->total_copies }}</p>
        <p><b>Tersedia:</b> {{ $book->available_copies }}</p>


    </div>
</div>

@endsection

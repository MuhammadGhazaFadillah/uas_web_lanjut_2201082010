@extends('layout.template')

@section('title', $mine ? $mine->nama : 'Detail Bahasa')

@section('content')
    @if ($mine)
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-9">
                    <div class="card-body">
                        <h2 class="card-title">{{ $mine->nama }}</h2>
                        <p class="card-text">{{ $mine->sinopsis }}</p>
                        <p class="card-text">Kategori :
                            {{ $mine->category ? $mine->category->nama_kategori : 'Tidak ada kategori' }}</p>
                        <p class="card-text">Tahun : {{ $mine->tahun }}</p>
                        <p class="card-text">Penemu : {{ $mine->penemu }}</p>
                        <a href="/" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <img src="/images/{{ $mine->foto_sampul }}" class="img-fluid rounded-end" alt="...">
                </div>
            </div>
        </div>
    @else
        <p>Data Tambang tidak ditemukan.</p>
    @endif
@endsection

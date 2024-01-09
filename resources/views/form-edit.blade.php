@extends('layout.template')
@section('title', 'Input Data Tambang')
@section('content')
    <h2 class="mb-4">Edit Tambang</h2>
    <form action="/mine/{{ $mine->id }}/edit" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="id" class="form-label">ID Mine:</label>
            <input type="text" class="form-control" id="id" name="id" value="{{ $mine->id }}" disabled>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $mine->nama }}"
                required="">
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori:</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $mine->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="sinopsis" class="form-label">Sinopsis:</label>
            <textarea class="form-control" id="sinopsis" name="sinopsis" rows="4" required="">{{ $mine->sinopsis }}</textarea>
        </div>
        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun:</label>
            <input type="number" class="form-control" id="tahun" name="tahun" value="{{ $mine->tahun }}"
                required="">
        </div>
        <div class="mb-3">
            <label for="pemain" class="form-label">Penemu:</label>
            <input type="text" class="form-control" id="penemu" name="penemu" value="{{ $mine->penemu }}"
                required="">
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto Sebelumnya:</label>
            <img src="/images/{{ $mine['foto_sampul'] }}" class="img-thumbnail" alt="..." width="100px">
        </div>
        <div class="mb-3">
            <label for="foto_sampul" class="form-label">Foto Sampul:</label>
            <input type="file" class="form-control" id="foto_sampul" name="foto_sampul">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
@endsection

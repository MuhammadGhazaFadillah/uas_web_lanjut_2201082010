@extends('layout.template')

@section('title', 'Data Movie')

@section('content')

    <h1>Data Tambang</h1>
    <a href="/mines/create" class="btn btn-primary">Input</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Kategori</th>
                <th scope="col">Tahun</th>
                <th scope="col">Penemu</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mines as $mine)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $mine->nama }}</td>
                    <td>{{ $mine->category->nama_kategori }}</td>
                    <td>{{ $mine->tahun }}</td>
                    <td>{{ $mine->penemu }}</td>
                    <td class="text-nowrap">
                        <a href="/mine/{{ $mine['id'] }}/edit" class="btn btn-warning">Edit</a>
                        <a href="/mine/delete/{{ $mine->id }}" class="btn btn-danger"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $mines->links() }}
    </div>
@endsection

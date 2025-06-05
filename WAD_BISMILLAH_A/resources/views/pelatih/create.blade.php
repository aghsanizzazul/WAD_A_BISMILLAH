@extends('pelatih.app')

@section('content')
    <h3>Tambah Pelatih</h3>

    <form action="{{ route('pelatih.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Spesialisasi</label>
            <input type="text" name="specialization" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>No. HP</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <a href="{{ route('pelatih.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
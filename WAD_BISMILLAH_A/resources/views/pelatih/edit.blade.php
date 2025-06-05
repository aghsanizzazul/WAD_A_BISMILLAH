@extends('pelatih.app')

@section('content')
    <h3>Edit Pelatih</h3>

    <form action="{{ route('pelatih.update', $pelatih->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $pelatih->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Spesialisasi</label>
            <input type="text" name="specialization" value="{{ $pelatih->specialization }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $pelatih->email }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>No. HP</label>
            <input type="text" name="phone" value="{{ $pelatih->phone }}" class="form-control" required>
        </div>
        <a href="{{ route('pelatih.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
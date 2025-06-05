@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Anggota</div>

                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama</label>
                        <p>{{ $anggota->nama }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p>{{ $anggota->email }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor Telepon</label>
                        <p>{{ $anggota->nomor_telepon }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat</label>
                        <p>{{ $anggota->alamat }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Kembali</a>
                        <div>
                            <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
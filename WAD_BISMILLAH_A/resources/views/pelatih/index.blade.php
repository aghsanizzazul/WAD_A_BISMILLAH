@extends('pelatih.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Pelatih</h3>
        <a href="{{ route('pelatih.create') }}" class="btn btn-primary">+ Tambah Pelatih</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Spesialisasi</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pelatih as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->specialization }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->phone }}</td>
                    <td>
                        <a href="{{ route('pelatih.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('pelatih.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Belum ada data pelatih</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
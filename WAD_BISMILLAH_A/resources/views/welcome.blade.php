<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Data Kelas Gym</h1>
            <a href="{{ route('classes.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Kelas Baru
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Kelas</th>
                                <th>Instruktur</th>
                                <th>Jadwal</th>
                                <th>Kapasitas</th>
                                <th>Ruangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($classes as $index => $class)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $class->name }}</td>
                                    <td>{{ $class->instructor }}</td>
                                    <td>
                                        {{ $class->schedule_day }}<br>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }} - 
                                            {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }}
                                        </small>
                                    </td>
                                    <td>{{ $class->capacity }} orang</td>
                                    <td>{{ $class->room }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('classes.edit', $class->id) }}" 
                                               class="btn btn-primary me-2">
                                                Edit
                                            </a>
                                            <form action="{{ route('classes.destroy', $class->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas ini?');"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data kelas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Kelas Gym</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('classes.update', $class->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $class->name }}" required>
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Kapasitas</label>
                <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $class->capacity }}" required>
            </div>
            <div class="mb-3">
                <label for="room" class="form-label">Ruangan</label>
                <input type="text" class="form-control" id="room" name="room" value="{{ $class->room }}" required>
            </div>
            <div class="mb-3">
                <label for="instructor" class="form-label">Instruktur</label>
                <input type="text" class="form-control" id="instructor" name="instructor" value="{{ $class->instructor }}" required>
            </div>
            <div class="mb-3">
                <label for="schedule_day" class="form-label">Hari</label>
                <select class="form-control" id="schedule_day" name="schedule_day" required>
                    <option value="Senin" {{ $class->schedule_day == 'Senin' ? 'selected' : '' }}>Senin</option>
                    <option value="Selasa" {{ $class->schedule_day == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                    <option value="Rabu" {{ $class->schedule_day == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                    <option value="Kamis" {{ $class->schedule_day == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                    <option value="Jumat" {{ $class->schedule_day == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                    <option value="Sabtu" {{ $class->schedule_day == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                    <option value="Minggu" {{ $class->schedule_day == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="start_time" class="form-label">Waktu Mulai</label>
                <input type="time" class="form-control" id="start_time" name="start_time" value="{{ $class->start_time }}" required>
            </div>
            <div class="mb-3">
                <label for="end_time" class="form-label">Waktu Selesai</label>
                <input type="time" class="form-control" id="end_time" name="end_time" value="{{ $class->end_time }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $class->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Kelas</button>
            <a href="{{ route('classes.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
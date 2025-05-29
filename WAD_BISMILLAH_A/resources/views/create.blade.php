<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Kelas Gym</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('classes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Kapasitas</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity') }}" required>
                        @error('capacity')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="room" class="form-label">Ruangan</label>
                        <input type="text" class="form-control" id="room" name="room" value="{{ old('room') }}">
                    </div>
                    <div class="mb-3">
                        <label for="schedules" class="form-label">Jadwal (Opsional)</label>
                        <div id="schedules-container">
                            <div class="schedule-row">
                                <input type="datetime-local" class="form-control" name="schedules[0][start_time]" value="{{ old('schedules.0.start_time') }}" required>
                                <input type="datetime-local" class="form-control" name="schedules[0][end_time]" value="{{ old('schedules.0.end_time') }}" required>
                            </div>
                        </div>
                        <button type="button" id="add-schedule" class="btn btn-secondary btn-sm mt-2">Tambah Jadwal</button>
                        @error('schedules.*.start_time')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('schedules.*.end_time')
                            <div class="alert alert-danger">{{ $message }}
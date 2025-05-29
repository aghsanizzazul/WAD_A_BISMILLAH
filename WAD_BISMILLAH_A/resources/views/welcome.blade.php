<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<h1>Data Kelas</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nama Kelas</th>
            <th>Kapasitas</th>
            <th>Tanggal</th>
            <th>Waktu</th>
        </tr>
    </thead>
    <tbody>
        foreach ($kelas as $kelas)
            <tr>
                <td>{{$kelas->nama}}</td>
                <td>{{$kelas->kapasitas}}</td>
                <td>{{$kelas->tanggal}}</td>
                <td>{{$kelas->waktu}}</td>
            </tr>
        endforeach
    </tbody>
</table>

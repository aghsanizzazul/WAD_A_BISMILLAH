@extends('layouts.app')

@section('content')
<div class="p-10">
    <h1 class="text-2xl font-bold mb-4">Manajemen Paket Langganan</h1>

    <a href="{{ route('langganan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Tambah Paket</a>

    <table class="min-w-full mt-4 bg-white border rounded shadow">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Nama</th>
                <th>Durasi (hari)</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($langganan as $paket)
            <tr class="border-t">
                <td class="p-2">{{ $paket->name }}</td>
                <td class="text-center">{{ $paket->duration_days }}</td>
                <td>Rp{{ number_format($paket->price, 0, ',', '.') }}</td>
                <td class="text-center">
                    <a href="#" class="text-blue-500">Edit</a> |
                    <form action="#" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-500">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-8 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6">
        {{ $langganan->exists ? 'Edit Paket Langganan' : 'Tambah Paket Langganan' }}
    </h1>

    <form action="{{ $langganan->exists ? route('langganan.update', $langganan->id) : route('langganan.store') }}" method="POST">
        @csrf
        @if($langganan->exists)
            @method('PUT')
        @endif

        <div class="mb-4">
            <label class="block font-semibold mb-1">Nama Paket</label>
            <input type="text" name="name" value="{{ old('name', $langganan->name) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Durasi (hari)</label>
            <input type="number" name="duration_days" value="{{ old('duration_days', $langganan->duration_days) }}" class="w-full border rounded px-3 py-2" min="1" required>
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-1">Harga (Rp)</label>
            <input type="number" name="price" value="{{ old('price', $langganan->price) }}" class="w-full border rounded px-3 py-2" min="0" required>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('langganan.index') }}" class="text-gray-600">← Kembali</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $langganan->exists ? 'Update' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
@endsection

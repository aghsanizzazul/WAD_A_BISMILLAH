@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-8 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6">
        {{ isset($pembayaran) && $pembayaran->exists ? 'Edit Pembayaran' : 'Input Pembayaran' }}
    </h1>

    <form action="{{ isset($pembayaran) && $pembayaran->exists ? route('pembayaran.update', $pembayaran->id) : route('pembayaran.store') }}" method="POST">
        @csrf
        @if(isset($pembayaran) && $pembayaran->exists)
            @method('PUT')
        @endif

        <div class="mb-4">
            <label class="block font-semibold mb-1">Member</label>
            <select name="member_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Member --</option>
                @foreach($members as $member)
                    <option value="{{ $member->id }}" {{ old('member_id', $pembayaran->member_id ?? '') == $member->id ? 'selected' : '' }}>
                        {{ $member->name }} ({{ $member->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Langganan</label>
            <select name="langganan_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Langganan --</option>
                @foreach($langganan as $paket)
                    <option value="{{ $paket->id }}" {{ old('langganan_id', $pembayaran->langganan_id ?? '') == $paket->id ? 'selected' : '' }}>
                        {{ $paket->name }} - Rp{{ number_format($paket->price, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Metode Pembayaran</label>
            <select name="payment_method" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Metode --</option>
                <option value="credit_card" {{ old('payment_method', $pembayaran->payment_method ?? '') == 'credit_card' ? 'selected' : '' }}>Kartu Kredit</option>
                <option value="bank_transfer" {{ old('payment_method', $pembayaran->payment_method ?? '') == 'bank_transfer' ? 'selected' : '' }}>Transfer Bank</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Jumlah (Rp)</label>
            <input type="number" name="amount" value="{{ old('amount', $pembayaran->amount ?? '') }}" class="w-full border rounded px-3 py-2" required min="0">
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-1">Tanggal Pembayaran</label>
            <input type="date" name="payment_date" value="{{ old('payment_date', isset($pembayaran) ? date('Y-m-d', strtotime($pembayaran->payment_date)) : now()->toDateString()) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-600">← Kembali</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ isset($pembayaran) && $pembayaran->exists ? 'Update' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
@endsection

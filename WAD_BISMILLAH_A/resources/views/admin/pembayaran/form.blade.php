@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-8 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Input Pembayaran</h1>

    @if($errors->has('duplicate'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ $errors->first('duplicate') }}
        </div>
    @endif

    <form action="{{ route('pembayaran.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-1">Member</label>
            <select name="member_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Member --</option>
                @foreach($members as $member)
                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                        {{ $member->name }} ({{ $member->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Paket Langganan</label>
            <select name="langganan_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Paket --</option>
                @foreach($langganan as $paket)
                    <option value="{{ $paket->id }}" {{ old('langganan_id') == $paket->id ? 'selected' : '' }}>
                        {{ $paket->name }} - Rp{{ number_format($paket->price, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Metode Pembayaran</label>
            <select name="payment_method" class="w-full border rounded px-3 py-2" required>
                <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Kartu Kredit</option>
                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Transfer Bank</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Jumlah (Rp)</label>
            <input type="number" name="amount" value="{{ old('amount') }}" class="w-full border rounded px-3 py-2" min="0" required>
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-1">Tanggal Pembayaran</label>
            <input type="date" name="payment_date" value="{{ old('payment_date', now()->toDateString()) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('pembayaran.index') }}" class="text-gray-600">← Kembali</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md">
            <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg">
                <h1 class="text-xl font-bold">Input Pembayaran</h1>
            </div>
            
            <div class="p-6">
                @if ($errors->any())
                    <div class="bg-red-50 text-red-700 p-4 rounded-lg mb-6">
                        <ul class="list-disc pl-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pembayaran.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Member</label>
                        <select name="member_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                            <option value="">-- Pilih Member --</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->name }} ({{ $member->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Langganan</label>
                        <select name="langganan_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                            <option value="">-- Pilih Langganan --</option>
                            @foreach($langganan as $paket)
                                <option value="{{ $paket->id }}" {{ old('langganan_id') == $paket->id ? 'selected' : '' }}>
                                    {{ $paket->name }} - Rp{{ number_format($paket->price, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                        <select name="payment_method" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                            <option value="">-- Pilih Metode --</option>
                            <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Kartu Kredit</option>
                            <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Transfer Bank</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah (Rp)</label>
                        <input type="number" name="amount" value="{{ old('amount') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required min="0">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pembayaran</label>
                        <input type="date" name="payment_date" value="{{ old('payment_date', now()->toDateString()) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ url('/') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">← Kembali</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 
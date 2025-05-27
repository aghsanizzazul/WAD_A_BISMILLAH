@extends('layouts.app')

@section('content')
<div class="p-10">
    <h1 class="text-3xl font-bold mb-4">Admin Payment Dashboard</h1>

    <div class="grid grid-cols-3 gap-6">

        {{-- Kartu Saldo --}}
        <div class="bg-purple-800 text-white p-6 rounded-2xl shadow">
            <div class="text-xl font-bold mb-2">Saldo Utama:</div>
            <div class="text-3xl font-extrabold mb-4">RP.10.000.000</div>
            <div class="text-sm">VALID THRU 03/25</div>
            <div class="text-sm mb-2">Admin GYM TELKOM UNIVERSITY</div>
            <div class="text-sm">**** **** **** 4563</div>
        </div>

        {{-- Ringkasan Mingguan --}}
        <div class="bg-white p-6 rounded-2xl shadow col-span-2">
            <h2 class="text-lg font-bold mb-4">Ringkasan Mingguan</h2>
            <canvas id="summaryChart"></canvas>
        </div>

        {{-- Saldo Dompet --}}
        <div class="bg-indigo-100 p-6 rounded-2xl shadow">
            <div class="text-sm">Saldo Dompet GYM:</div>
            <div class="text-2xl font-bold text-indigo-700">RP.159.500.000</div>
            <div class="text-sm text-red-500">-10% Dari Minggu Lalu</div>
            <div class="flex mt-4 gap-4">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Kirim Tagihan</button>
                <button class="bg-green-600 text-white px-4 py-2 rounded">Transfer Dana</button>
            </div>
        </div>

        {{-- Riwayat Pembayaran --}}
        <div class="col-span-2 bg-black text-white p-6 rounded-2xl shadow">
            <h2 class="text-lg font-bold mb-4">Riwayat Pembayaran Member</h2>
            <div class="flex gap-4 mb-2">
                <button class="underline">Hari ini</button>
                <button>Mingguan</button>
                <button>Bulanan</button>
            </div>

            {{-- Loop Data --}}
            @foreach($pembayaran as $data)
            <div class="flex items-center justify-between bg-gray-800 p-4 rounded mb-2">
                <div class="flex items-center gap-4">
                    <img src="https://ui-avatars.com/api/?name={{ $data->member->name }}" class="w-10 h-10 rounded-full" />
                    <div>
                        <div class="font-bold">{{ $data->member->name }}</div>
                        <div class="text-sm">{{ $data->keterangan ?? 'Pembayaran' }}</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-sm">{{ \Carbon\Carbon::parse($data->payment_date)->format('d F Y, H:i') }}</div>
                    <div class="text-green-400 font-bold">+Rp{{ number_format($data->amount, 0, ',', '.') }}</div>
                    <div class="text-sm">{{ ucfirst($data->payment_method) }}</div>
                </div>
                <div>
                    <span class="px-3 py-1 bg-purple-600 text-white rounded">
                        {{ ucfirst($data->status ?? 'Menunggu') }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
@endsection

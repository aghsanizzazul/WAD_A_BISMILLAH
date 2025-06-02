@extends('layouts.app')

@section('content')
<div class="p-10">
    <h1 class="text-3xl font-bold mb-4">Admin Payment Dashboard</h1>

    <div class="grid grid-cols-3 gap-6">
        {{-- Saldo Dompet --}}
        <div class="bg-indigo-100 p-6 rounded-2xl shadow">
            <div class="text-sm">Saldo GYM:</div>
                <div class="text-2xl font-bold text-indigo-700">
                    RP.{{ number_format($totalSemua, 0, ',', '.') }}
                </div>
            <div class="flex mt-4 gap-4">
                <a href="{{ route('pembayaran.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Input Pembayaran</a>
            </div>
        </div>
        {{-- Total Pembayaran Periode --}}
        <div class="bg-white p-6 rounded-2xl shadow">
            <div class="text-sm">Total Pembayaran ({{ ucfirst($filter) }})</div>
            <div class="text-2xl font-bold text-blue-600">
                RP.{{ number_format($totalPeriode, 0, ',', '.') }}
            </div>
        </div>


        {{-- Riwayat Pembayaran --}}
        <div class="col-span-2 bg-black text-white p-6 rounded-2xl shadow">
            <h2 class="text-lg font-bold mb-4">Riwayat Pembayaran Member</h2>
            <div class="flex gap-4 mb-4">
                <a href="{{ route('admin.dashboard', ['filter' => 'semua']) }}" class="{{ $filter == 'semua' ? 'underline font-bold' : '' }}">Semua</a>
                <a href="{{ route('admin.dashboard', ['filter' => 'harian']) }}" class="{{ $filter == 'harian' ? 'underline font-bold' : '' }}">Hari ini</a>
                <a href="{{ route('admin.dashboard', ['filter' => 'mingguan']) }}" class="{{ $filter == 'mingguan' ? 'underline font-bold' : '' }}">Mingguan</a>
                <a href="{{ route('admin.dashboard', ['filter' => 'bulanan']) }}" class="{{ $filter == 'bulanan' ? 'underline font-bold' : '' }}">Bulanan</a>
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
                    <div class="text-sm">{{ \Carbon\Carbon::parse($data->payment_date)->format('d F Y') }}</div>
                    <div class="text-green-400 font-bold">+Rp{{ number_format($data->amount, 0, ',', '.') }}</div>
                    <div class="text-sm">{{ ucfirst($data->payment_method) }}</div>
                </div>
                <div class="flex gap-2 mt-2">
                    <a href="{{ route('pembayaran.edit', $data->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Edit</a>

                    <form action="{{ route('pembayaran.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pembayaran ini?');">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
@endsection

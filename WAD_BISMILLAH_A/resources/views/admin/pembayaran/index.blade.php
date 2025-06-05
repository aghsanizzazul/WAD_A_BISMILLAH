@extends('layouts.app')

@section('content')
<div class="p-10">
    <h1 class="text-2xl font-bold mb-4">Riwayat Pembayaran</h1>

    <table class="min-w-full mt-4 bg-white border rounded shadow">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Member</th>
                <th>Langganan</th>
                <th>Metode</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayaran as $p)
            <tr class="border-t">
                <td class="p-2">{{ $p->member->name }}</td>
                <td>{{ $p->langganan->name ?? '-' }}</td>
                <td>{{ ucfirst($p->payment_method) }}</td>
                <td>Rp{{ number_format($p->amount, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($p->payment_date)->format('d M Y') }}</td>
                <td><span class="px-2 py-1 rounded bg-purple-500 text-white">{{ ucfirst($p->status ?? 'Menunggu') }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

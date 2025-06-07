@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Paket Langganan</h1>
        <a href="{{ route('langganan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Tambah Paket
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Paket</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi (Hari)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($langganan as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->duration_days }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('langganan.edit', $item->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                        <form action="{{ route('langganan.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        Belum ada paket langganan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

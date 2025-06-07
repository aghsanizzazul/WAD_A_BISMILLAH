@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Kehadiran</h1>
        <a href="{{ route('attendances.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
            + Tambah Kehadiran
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100 text-left text-gray-700 text-sm uppercase tracking-wider">
                    <th class="px-4 py-3 border-b">Member</th>
                    <th class="px-4 py-3 border-b">Kelas</th>
                    <th class="px-4 py-3 border-b">Check-in</th>
                    <th class="px-4 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $attendance)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $attendance->member->name }}</td>
                        <td class="px-4 py-3">{{ $attendance->classSchedule->class_name ?? 'N/A' }}</td>
                        <td class="px-4 py-3">{{ $attendance->check_in_time->format('d M Y H:i') }}</td>
                        <td class="px-4 py-3 text-center space-x-2">
                            <a href="{{ route('attendances.edit', $attendance->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-center text-gray-500">Belum ada data kehadiran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $attendances->links() }}
    </div>
</div>
@endsection

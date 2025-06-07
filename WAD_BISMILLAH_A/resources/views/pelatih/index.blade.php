@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Trainers</h1>
        <a href="{{ route('pelatih.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
            Add New Trainer
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specialization</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($pelatih as $trainer)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $trainer->nama }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $trainer->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $trainer->nomor_telepon }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $trainer->spesialisasi }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $trainer->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($trainer->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('pelatih.edit', $trainer->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                        <form action="{{ route('pelatih.destroy', $trainer->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this trainer?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 
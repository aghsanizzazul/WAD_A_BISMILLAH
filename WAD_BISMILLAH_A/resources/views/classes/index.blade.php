@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Class Schedules</h1>
        <a href="{{ route('classes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Add New Class
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Class Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instructor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Schedule</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($classes as $class)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $class->name }}</div>
                            @if($class->description)
                            <div class="text-sm text-gray-500">{{ Str::limit($class->description, 50) }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $class->instructor }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $class->schedule_day }}<br>
                            {{ date('H:i', strtotime($class->start_time)) }} - {{ date('H:i', strtotime($class->end_time)) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $class->room }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $class->capacity }} people
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-3">
                                <a href="{{ route('classes.edit', $class->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>

                                <form action="{{ route('classes.destroy', $class->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this class?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            No classes found. Create your first class schedule!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 
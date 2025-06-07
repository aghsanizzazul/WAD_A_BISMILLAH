@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md">
            <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg">
                <h1 class="text-xl font-bold">Add New Class</h1>
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

                <form action="{{ route('classes.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Class Name</label>
                        <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                               id="name" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="instructor" class="block text-sm font-medium text-gray-700 mb-1">Instructor</label>
                        <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                               id="instructor" name="instructor" value="{{ old('instructor') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Capacity</label>
                        <input type="number" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                               id="capacity" name="capacity" value="{{ old('capacity') }}" required min="1">
                    </div>

                    <div class="mb-4">
                        <label for="room" class="block text-sm font-medium text-gray-700 mb-1">Room</label>
                        <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                               id="room" name="room" value="{{ old('room') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="schedule_day" class="block text-sm font-medium text-gray-700 mb-1">Day</label>
                        <select class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                                id="schedule_day" name="schedule_day" required>
                            <option value="">Select Day</option>
                            <option value="Senin" {{ old('schedule_day') == 'Senin' ? 'selected' : '' }}>Monday</option>
                            <option value="Selasa" {{ old('schedule_day') == 'Selasa' ? 'selected' : '' }}>Tuesday</option>
                            <option value="Rabu" {{ old('schedule_day') == 'Rabu' ? 'selected' : '' }}>Wednesday</option>
                            <option value="Kamis" {{ old('schedule_day') == 'Kamis' ? 'selected' : '' }}>Thursday</option>
                            <option value="Jumat" {{ old('schedule_day') == 'Jumat' ? 'selected' : '' }}>Friday</option>
                            <option value="Sabtu" {{ old('schedule_day') == 'Sabtu' ? 'selected' : '' }}>Saturday</option>
                            <option value="Minggu" {{ old('schedule_day') == 'Minggu' ? 'selected' : '' }}>Sunday</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                            <input type="time" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                                   id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                        </div>

                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                            <input type="time" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                                   id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                                  id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('classes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Back</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Save Class</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 
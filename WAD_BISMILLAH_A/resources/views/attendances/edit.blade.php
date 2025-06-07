@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Kehadiran</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Member -->
            <div class="mb-4">
                <label for="member_id" class="block text-gray-700 font-semibold mb-2">Member</label>
                <select name="member_id" id="member_id" class="form-select w-full border border-gray-300 rounded px-4 py-2">
                    <option value="">Pilih member</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}" {{ old('member_id', $attendance->member_id) == $member->id ? 'selected' : '' }}>
                            {{ $member->name }}
                        </option>
                    @endforeach
                </select>
                @error('member_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Kelas -->
            <div class="mb-4">
                <label for="class_schedule_id" class="block text-gray-700 font-semibold mb-2">Kelas</label>
                <select name="class_schedule_id" id="class_schedule_id" class="form-select w-full border border-gray-300 rounded px-4 py-2">
                    <option value="">Pilih kelas</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ old('class_schedule_id', $attendance->class_schedule_id) == $class->id ? 'selected' : '' }}>
                            {{ $class->class_name }} ({{ \Carbon\Carbon::parse($class->schedule_date)->format('d M Y H:i') }})
                        </option>
                    @endforeach
                </select>
                @error('class_schedule_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Waktu Check-in -->
            <div class="mb-4">
                <label for="check_in_time" class="block text-gray-700 font-semibold mb-2">Waktu Check-in</label>
                <input type="datetime-local" name="check_in_time" id="check_in_time"
                    class="form-input w-full border border-gray-300 rounded px-4 py-2"
                    value="{{ old('check_in_time', $attendance->check_in_time->format('Y-m-d\TH:i')) }}" required>
                @error('check_in_time') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded mr-2">
                    Simpan Perubahan
                </button>
                <a href="{{ route('attendances.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Check-in Kehadiran Baru</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf

            <!-- Member -->
            <div class="mb-4">
                <label for="member_id" class="block text-gray-700 font-semibold mb-2">Member</label>
                <select name="member_id" id="member_id" class="form-select w-full border border-gray-300 rounded px-4 py-2">
                    <option value="">Pilih member</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Kelas -->
            <div class="mb-4">
                <label for="class_schedule_id" class="block text-gray-700 font-semibold mb-2">Kelas</label>
                <select name="class_schedule_id" id="class_schedule_id" class="form-select w-full border border-gray-300 rounded px-4 py-2" required>
                    <option value="">Pilih kelas</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ old('class_schedule_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->class_name }} - 
                            {{ optional($class->schedule_date)->format('d M Y H:i') ?? '-' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Waktu Check-in -->
            <div class="mb-4">
                <label for="check_in_time" class="block text-gray-700 font-semibold mb-2">Waktu Check-in</label>
                <input type="datetime-local" name="check_in_time" id="check_in_time"
                       class="form-input w-full border border-gray-300 rounded px-4 py-2"
                       value="{{ old('check_in_time', now()->format('Y-m-d\TH:i')) }}" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded mr-2">
                    Simpan
                </button>
                <a href="{{ route('attendances.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

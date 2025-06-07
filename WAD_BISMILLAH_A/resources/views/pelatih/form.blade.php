@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">
                {{ isset($pelatih) ? 'Edit Trainer' : 'Add New Trainer' }}
            </h1>

            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ isset($pelatih) ? route('pelatih.update', $pelatih->id) : route('pelatih.store') }}" method="POST">
                @csrf
                @if(isset($pelatih))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" name="nama" id="nama" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           value="{{ old('nama', $pelatih->nama ?? '') }}" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           value="{{ old('email', $pelatih->email ?? '') }}" required>
                </div>

                <div class="mb-4">
                    <label for="nomor_telepon" class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
                    <input type="text" name="nomor_telepon" id="nomor_telepon" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           value="{{ old('nomor_telepon', $pelatih->nomor_telepon ?? '') }}" required>
                </div>

                <div class="mb-4">
                    <label for="spesialisasi" class="block text-gray-700 text-sm font-bold mb-2">Specialization</label>
                    <input type="text" name="spesialisasi" id="spesialisasi" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           value="{{ old('spesialisasi', $pelatih->spesialisasi ?? '') }}" required>
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                    <select name="status" id="status" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="active" {{ (old('status', $pelatih->status ?? '') === 'active') ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ (old('status', $pelatih->status ?? '') === 'inactive') ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        {{ isset($pelatih) ? 'Update Trainer' : 'Add Trainer' }}
                    </button>
                    <a href="{{ route('pelatih.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 
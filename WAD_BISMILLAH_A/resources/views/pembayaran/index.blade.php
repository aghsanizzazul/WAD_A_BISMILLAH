@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Payments</h1>
        <a href="{{ route('pembayaran.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
            Add New Payment
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Package</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($pembayaran as $payment)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $payment->member->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $payment->langganan->nama_paket }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">Rp {{ number_format($payment->amount, 0, ',', '.') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $payment->payment_method === 'credit_card' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                            {{ str_replace('_', ' ', ucfirst($payment->payment_method)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ date('d M Y', strtotime($payment->payment_date)) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('pembayaran.edit', $payment->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                        <form action="{{ route('pembayaran.destroy', $payment->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this payment?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 
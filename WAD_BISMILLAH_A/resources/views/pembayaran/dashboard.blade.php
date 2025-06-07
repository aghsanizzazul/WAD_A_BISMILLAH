@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Payment Dashboard</h1>
        <a href="{{ route('pembayaran.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
            Add New Payment
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Revenue Card -->
        <div class="bg-purple-600 text-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Total Revenue</h3>
            <p class="text-3xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="text-sm opacity-75">All time earnings</p>
        </div>

        <!-- Today's Revenue Card -->
        <div class="bg-blue-600 text-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Today's Revenue</h3>
            <p class="text-3xl font-bold">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
            <p class="text-sm opacity-75">Today's earnings</p>
        </div>

        <!-- Total Transactions Card -->
        <div class="bg-green-600 text-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Total Transactions</h3>
            <p class="text-3xl font-bold">{{ $totalTransactions }}</p>
            <p class="text-sm opacity-75">All time transactions</p>
        </div>

        <!-- Today's Transactions Card -->
        <div class="bg-orange-600 text-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Today's Transactions</h3>
            <p class="text-3xl font-bold">{{ $todayTransactions }}</p>
            <p class="text-sm opacity-75">Transactions today</p>
        </div>
    </div>

    <!-- Recent Payments Table -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Payments</h2>
        <div class="overflow-x-auto">
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
                    @foreach($recentPayments as $payment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $payment->member->name }}</div>
                            <div class="text-sm text-gray-500">{{ $payment->member->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $payment->langganan->nama_paket }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Rp {{ number_format($payment->amount, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $payment->payment_method === 'credit_card' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                {{ str_replace('_', ' ', ucfirst($payment->payment_method)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ date('d M Y', strtotime($payment->payment_date)) }}
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

    <!-- Payment Methods Distribution -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Payment Methods Distribution</h2>
        <div class="grid grid-cols-2 gap-4">
            @foreach($paymentMethods as $method)
            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="font-semibold text-gray-700">{{ str_replace('_', ' ', ucfirst($method->payment_method)) }}</h4>
                <p class="text-2xl font-bold text-blue-600">{{ $method->count }}</p>
                <p class="text-sm text-gray-500">transactions</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection 
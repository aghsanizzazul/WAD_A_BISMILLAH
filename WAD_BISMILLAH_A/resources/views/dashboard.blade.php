@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Admin Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Balance Card -->
        <div class="bg-purple-600 text-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Total Balance</h3>
            <p class="text-3xl font-bold">Rp {{ number_format($totalSemua, 0, ',', '.') }}</p>
            <p class="text-sm opacity-75">All time earnings</p>
        </div>

        <!-- Period Revenue Card -->
        <div class="bg-blue-600 text-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">{{ ucfirst($filter) }} Revenue</h3>
            <p class="text-3xl font-bold">Rp {{ number_format($totalPeriode, 0, ',', '.') }}</p>
            <p class="text-sm opacity-75">{{ ucfirst($filter) }} earnings</p>
        </div>

        <!-- Members Card -->
        <div class="bg-green-600 text-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Total Members</h3>
            <p class="text-3xl font-bold">{{ $statistics['total_members'] }}</p>
            <p class="text-sm opacity-75">Active Members</p>
        </div>

        <!-- New Members Card -->
        <div class="bg-orange-600 text-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">New Members</h3>
            <p class="text-3xl font-bold">{{ $statistics['new_members'] }}</p>
            <p class="text-sm opacity-75">{{ ucfirst($filter) }} registrations</p>
        </div>
    </div>

    <!-- Filter Buttons -->
    <div class="flex gap-4 mb-6">
        <a href="{{ request()->url() }}?filter=harian" 
           class="px-4 py-2 rounded {{ $filter === 'harian' ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
            Daily
        </a>
        <a href="{{ request()->url() }}?filter=mingguan" 
           class="px-4 py-2 rounded {{ $filter === 'mingguan' ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
            Weekly
        </a>
        <a href="{{ request()->url() }}?filter=bulanan" 
           class="px-4 py-2 rounded {{ $filter === 'bulanan' ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
            Monthly
        </a>
        <a href="{{ request()->url() }}?filter=semua" 
           class="px-4 py-2 rounded {{ $filter === 'semua' ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
            All Time
        </a>
    </div>

    <!-- Recent Members -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Recent Members</h2>
            <a href="{{ route('members.index') }}" class="text-blue-600 hover:text-blue-800">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Name</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Email</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Join Date</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Last Payment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentMembers as $member)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">
                            <a href="{{ route('members.edit', $member['id']) }}" class="text-blue-600 hover:text-blue-800">
                                {{ $member['name'] }}
                            </a>
                        </td>
                        <td class="px-4 py-2 text-gray-600">{{ $member['email'] }}</td>
                        <td class="px-4 py-2 text-gray-600">{{ date('d M Y', strtotime($member['join_date'])) }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $member['status'] === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($member['status']) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-gray-600">
                            {{ $member['last_payment'] ? date('d M Y', strtotime($member['last_payment'])) : 'No payments' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Payments Table -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Recent Payments</h2>
            <a href="{{ route('pembayaran.index') }}" class="text-blue-600 hover:text-blue-800">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Member</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Package</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Amount</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Method</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayaran as $payment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $payment->member->name }}</td>
                        <td class="px-4 py-2">{{ $payment->langganan->nama_paket ?? 'N/A' }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $payment->payment_method === 'credit_card' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                {{ str_replace('_', ' ', ucfirst($payment->payment_method)) }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ date('d M Y', strtotime($payment->payment_date)) }}</td>
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
            @foreach($statistics['payment_methods'] as $method)
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
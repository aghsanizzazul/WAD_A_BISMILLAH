@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Members</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $stats['total_members'] }}</p>
            <p class="text-sm text-gray-500">Active: {{ $stats['active_members'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Trainers</h3>
            <p class="text-3xl font-bold text-green-600">{{ $stats['total_trainers'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Today's Check-ins</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $stats['today_attendances'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Active Classes</h3>
            <p class="text-3xl font-bold text-orange-600">{{ $stats['total_classes'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Active Subscriptions</h3>
            <p class="text-3xl font-bold text-red-600">{{ $stats['active_subscriptions'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Members -->
        <div class="bg-blue rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Members</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Name</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Email</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Join Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recent_members as $member)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $member->name }}</td>
                            <td class="px-4 py-2">{{ $member->email }}</td>
                            <td class="px-4 py-2">{{ $member->join_date->format('M d, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Upcoming Classes -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Upcoming Classes</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Class</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Trainer</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Schedule</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($upcoming_classes as $class)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $class->name }}</td>
                            <td class="px-4 py-2">{{ $class->trainer->name }}</td>
                            <td class="px-4 py-2">
                                {{ $class->schedule_date->format('M d, Y') }}
                                {{ $class->start_time }} - {{ $class->end_time }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Check-ins -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Check-ins</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Member</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Class</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recent_attendances as $attendance)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $attendance->member->name }}</td>
                            <td class="px-4 py-2">{{ $attendance->classSchedule->name }}</td>
                            <td class="px-4 py-2">{{ $attendance->check_in_time->format('M d, Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 
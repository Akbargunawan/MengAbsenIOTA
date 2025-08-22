@extends('layouts.app')

@section('title', 'Dashboard')
@section('page', 'Dashboard')

@section('content')
<div class="space-y-6">
    {{-- Summary Data --}}
    <h2 class="font-semibold text-lg mb-4 border-b pb-2">Summary Data</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        {{-- Total User --}}
        <div class="flex flex-col p-4 bg-white rounded-lg shadow">
            <p class="text-[#E68540] font-bold text-sm mb-2">Total User</p>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="bg-[#E68540] p-3 rounded-lg">
                        <img src="{{ asset('images/LogoDashboard/VectorUser.svg') }}" alt="Total User" class="w-6 h-6">
                    </div>
                </div>
                <p class="text-[#E68540] font-bold text-lg">{{ $totalUsers }}</p>
            </div>
        </div>

        {{-- Total Cuti --}}
        <div class="flex flex-col p-4 bg-white rounded-lg shadow">
            <p class="text-[#E68540] font-bold text-sm mb-2">Total Cuti</p>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="bg-[#E68540] p-3 rounded-lg">
                        <img src="{{ asset('images/LogoDashboard/Cuti.svg') }}" alt="Total Cuti" class="w-6 h-6">
                    </div>
                </div>
                <p class="text-[#E68540] font-bold text-lg">50</p>
            </div>
        </div>

        {{-- Total Surat Tugas --}}
        <div class="flex flex-col p-4 bg-white rounded-lg shadow">
            <p class="text-[#E68540] font-bold text-sm mb-2">Total Surat Tugas</p>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="bg-[#E68540] p-3 rounded-lg">
                        <img src="{{ asset('images/LogoDashboard/Tugas.svg') }}" alt="Total Surat Tugas" class="w-6 h-6">
                    </div>
                </div>
                <p class="text-[#E68540] font-bold text-lg">50</p>
            </div>
        </div>

        {{-- Total Reimbursement --}}
        <div class="flex flex-col p-4 bg-white rounded-lg shadow">
            <p class="text-[#E68540] font-bold text-sm mb-2">Total Reimbursement</p>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="bg-[#E68540] p-3 rounded-lg">
                        <img src="{{ asset('images/LogoDashboard/Reimbursement.svg') }}" alt="Total Reimbursement" class="w-6 h-6">
                    </div>
                </div>
                <p class="text-[#E68540] font-bold text-lg">50</p>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white rounded-lg shadow p-4">
            <p class="font-semibold mb-2 text-[#E68540]">Absensi (Weekly)</p>
            <div class="w-full h-64">
                <canvas id="weeklyChart" class="w-full h-full"></canvas>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="font-semibold mb-2 text-[#E68540]">Cuti, Izin, Sakit (Monthly)</p>
            <div class="w-full h-64">
                <canvas id="monthlyChart" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>

    {{-- Aktivitas Terkini --}}
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="font-semibold text-lg mb-4 border-b pb-2">Aktivitas Terkini</h2>
        <div class="overflow-x-auto">
    <table class="min-w-full">
        <thead class="bg-[#E68540] text-white">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-semibold border border-orange-200">Timestamp</th>
                <th class="px-4 py-2 text-left text-sm font-semibold border border-orange-200">Method</th>
                <th class="px-4 py-2 text-left text-sm font-semibold border border-orange-200">Time Taken (ms)</th>
                <th class="px-4 py-2 text-left text-sm font-semibold border border-orange-200">Status</th>
                <th class="px-4 py-2 text-left text-sm font-semibold border border-orange-200">URI</th>
                <th class="px-4 py-2 text-left text-sm font-semibold border border-orange-200">Action</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 5; $i++)
                <tr class="{{ $i % 2 == 0 ? 'bg-white' : 'bg-gray-200' }}">
                    <td class="px-4 py-2 text-sm">&nbsp;</td>
                    <td class="px-4 py-2 text-sm">&nbsp;</td>
                    <td class="px-4 py-2 text-sm">&nbsp;</td>
                    <td class="px-4 py-2 text-sm">&nbsp;</td>
                    <td class="px-4 py-2 text-sm">&nbsp;</td>
                    <td class="px-4 py-2 text-sm">&nbsp;</td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>


       {{-- Pagination --}}
<div class="mt-4 flex items-center justify-between text-sm">
    <div>
        Page Size
        <select class="border border-gray-300 rounded px-2 py-1">
            <option>10</option>
            <option>25</option>
            <option>50</option>
        </select>
    </div>
    <div class="flex space-x-2">
        <button class="w-8 h-8 flex items-center justify-center border border-black rounded-full">«</button>
        <button class="w-8 h-8 flex items-center justify-center border border-black rounded-full">‹</button>
        <button class="w-8 h-8 flex items-center justify-center bg-blue-100 text-black rounded-full">1</button>
        <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-full">2</button>
        <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-full">3</button>
        <button class="w-8 h-8 flex items-center justify-center border border-black rounded-full">›</button>
        <button class="w-8 h-8 flex items-center justify-center border border-black rounded-full">»</button>
    </div>
</div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
    const weeklyChart = new Chart(weeklyCtx, {
        type: 'pie',
        data: {
            labels: ['Izin', 'Cuti', 'Sakit'],
            datasets: [{
                label: 'Absensi',
                data: [25, 15, 10],
                backgroundColor: ['#EE964A', '#F1935C', '#FFB26F'],
            }]
        },
        options: { 
            responsive: true,
            maintainAspectRatio: false
        }
    });

    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyChart = new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: ['A', 'B', 'C', 'D'],
            datasets: [{
                label: 'Jumlah',
                data: [100, 20, 300, 200],
                backgroundColor: '#FB923C'
            }]
        },
        options: { 
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endsection

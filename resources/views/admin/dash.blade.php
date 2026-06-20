@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-2xl font-bold text-slate-800 mb-6">Dashboard</h1>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Total Siswa</p>
                        <p class="text-3xl font-bold text-slate-800 mt-1">{{ $allstat['statSiswa'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Wali Kelas</p>
                        <p class="text-3xl font-bold text-slate-800 mt-1">{{ $allstat['statwalKelas'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                        <i class="fas fa-chalkboard-teacher text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Kaprodi</p>
                        <p class="text-3xl font-bold text-slate-800 mt-1">{{ $allstat['statkapJurusan'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-amber-100 flex items-center justify-center">
                        <i class="fas fa-user-tie text-amber-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Total Telat</p>
                        <p class="text-3xl font-bold text-slate-800 mt-1">{{ $allstat['statTelat'] > 0 ? $allstat['statTelat'] : 0 }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chart --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="text-lg font-semibold text-slate-800 mb-4">Grafik Keterlambatan</h3>
            <canvas id="barChart" height="100"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('barChart').getContext('2d');
    var data = {
        labels: @json($dates),
        datasets: [{
            label: 'Siswa telat',
            data: @json($telatData),
            backgroundColor: 'rgba(37, 99, 235, 0.2)',
            borderColor: 'rgba(37, 99, 235, 1)',
            borderWidth: 2,
            tension: 0.3
        }]
    };
    var options = {
        scales: {
            y: { beginAtZero: true }
        },
        plugins: {
            legend: { display: false }
        }
    };
    new Chart(ctx, { type: 'line', data: data, options: options });
</script>
@endpush

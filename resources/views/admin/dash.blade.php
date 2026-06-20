 @extends('layouts.app')

@section('page-header', 'Dashboard')

@section('content')
    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6 stagger-fade">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6" style="--i: 0">
            <div class="flex items-center justify-between mb-2">
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-users text-blue-600 text-lg"></i>
                </div>
                <span class="text-xs text-slate-400 font-medium">Total</span>
            </div>
            <p class="text-3xl font-bold text-slate-900">{{ $allstat['statSiswa'] }}</p>
            <p class="text-sm text-slate-500 mt-1">Total Siswa</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6" style="--i: 1">
            <div class="flex items-center justify-between mb-2">
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-blue-600 text-lg"></i>
                </div>
                <span class="text-xs text-slate-400 font-medium">Total</span>
            </div>
            <p class="text-3xl font-bold text-slate-900">{{ $allstat['statwalKelas'] }}</p>
            <p class="text-sm text-slate-500 mt-1">Wali Kelas</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6" style="--i: 2">
            <div class="flex items-center justify-between mb-2">
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-user-tie text-blue-600 text-lg"></i>
                </div>
                <span class="text-xs text-slate-400 font-medium">Total</span>
            </div>
            <p class="text-3xl font-bold text-slate-900">{{ $allstat['statkapJurusan'] }}</p>
            <p class="text-sm text-slate-500 mt-1">Kaprodi</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6" style="--i: 3">
            <div class="flex items-center justify-between mb-2">
                <div class="w-10 h-10 rounded-lg {{ $allstat['statTelat'] > 0 ? 'bg-red-50' : 'bg-blue-50' }} flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle {{ $allstat['statTelat'] > 0 ? 'text-red-600' : 'text-blue-600' }} text-lg"></i>
                </div>
                <span class="text-xs text-slate-400 font-medium">Akumulasi</span>
            </div>
            <p class="text-3xl font-bold {{ $allstat['statTelat'] > 0 ? 'text-red-600' : 'text-slate-900' }}">{{ $allstat['statTelat'] }}</p>
            <p class="text-sm text-slate-500 mt-1">Total Keterlambatan</p>
        </div>
    </div>

    {{-- Grafik Keterlambatan --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6 slide-up">
        <h3 class="text-base font-semibold text-slate-900 mb-4">Grafik Keterlambatan</h3>
        <div class="relative" style="height:280px">
            <canvas id="barChart"></canvas>
        </div>
    </div>

    {{-- Bottom Grid: Top Late Siswa + Donut Jurusan --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 stagger-fade">
        {{-- Top Late Siswa --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6" style="--i: 0">
            <h3 class="text-base font-semibold text-slate-900 mb-4">Siswa Paling Sering Telat</h3>
            <div class="space-y-3">
                @php
                    $topLate = \App\Models\datasiswa::withCount('keterlambatan')->orderBy('keterlambatan_count', 'desc')->take(5)->get();
                @endphp
                @forelse ($topLate as $i => $siswa)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full {{ $i === 0 ? 'bg-red-100 text-red-700' : 'bg-slate-100 text-slate-600' }} flex items-center justify-center text-xs font-bold">{{ $i + 1 }}</span>
                            <span class="text-sm text-slate-700">{{ $siswa->Nama_siswa }}</span>
                        </div>
                        <span class="text-sm font-medium {{ $siswa->keterlambatan_count > 0 ? 'text-red-600' : 'text-slate-400' }}">{{ $siswa->keterlambatan_count }}x</span>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 text-center py-4">Belum ada data keterlambatan.</p>
                @endforelse
            </div>
        </div>

        {{-- Donut Chart per Jurusan --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6" style="--i: 1">
            <h3 class="text-base font-semibold text-slate-900 mb-4">Keterlambatan per Jurusan</h3>
            <div class="relative" style="height:220px">
                <canvas id="donutChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(function() {
        var barChartEl = document.getElementById('barChart');
        if (barChartEl) {
            var existingBar = Chart.getChart(barChartEl);
            if (existingBar) existingBar.destroy();
        }

        var labels = @json($dates);
        var data = @json($telatData);

        var maxVal = Math.max(...data, 0);
        var bgColors = data.map(function(v) {
            return v === maxVal && maxVal > 0 ? 'rgba(220, 38, 38, 0.85)' : 'rgba(37, 99, 235, 0.75)';
        });
        var borderColors = data.map(function(v) {
            return v === maxVal && maxVal > 0 ? 'rgba(220, 38, 38, 1)' : 'rgba(37, 99, 235, 1)';
        });

        new Chart(barChartEl, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Siswa telat',
                    data: data,
                    backgroundColor: bgColors,
                    borderColor: borderColors,
                    borderWidth: 1,
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                resize: { delay: 0 },
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });

        var donutChartEl = document.getElementById('donutChart');
        if (donutChartEl) {
            var existingDonut = Chart.getChart(donutChartEl);
            if (existingDonut) existingDonut.destroy();
        }

        var jurusanData = @json(\App\Models\keterlambatan::selectRaw('jurusan_id, SUM(Telat) as total')
            ->with('jurusan')
            ->groupBy('jurusan_id')
            ->get()
            ->map(function($item) {
                return ['label' => $item->jurusan->Nama_jurusan ?? 'Unknown', 'total' => (int) $item->total];
            })
        );

        if (jurusanData.length > 0) {
            new Chart(donutChartEl, {
                type: 'doughnut',
                data: {
                    labels: jurusanData.map(function(d) { return d.label; }),
                    datasets: [{
                        data: jurusanData.map(function(d) { return d.total; }),
                        backgroundColor: ['rgba(37, 99, 235, 0.8)', 'rgba(16, 185, 129, 0.8)', 'rgba(245, 158, 11, 0.8)', 'rgba(139, 92, 246, 0.8)'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    resize: { delay: 0 },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { font: { size: 11 } }
                        }
                    },
                    cutout: '65%',
                }
            });
        } else if (donutChartEl) {
            donutChartEl.parentElement.innerHTML = '<p class="text-sm text-slate-400 text-center py-8">Belum ada data.</p>';
        }
    });
</script>
@endpush

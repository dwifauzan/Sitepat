@extends('template.master')
{{-- @if (auth()->user()->isSuperAdmin()) --}}
@section('dashboard')
    <!-- Main content -->
    <section class="content content-wrapper">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $allstat['statSiswa'] }}</h3>

                            <p class="text-capitalize">jumlah siswa</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $allstat['statwalKelas'] }}</h3>

                            <p class="text-capitalize">Jumlah Wali kelas</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $allstat['statkapJurusan'] }}</h3>

                            <p class="text-capitalize">Jumlah Kaproli</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            @if ( $allstat['statTelat'] > 0)
                                <h3>{{ $allstat['statTelat'] }}</h3>
                            @else
                                <h3>0</h3>
                            @endif

                            <p class="text-capitalize">Jumlah Telat</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>

                    </div>
                </div>
                <div style="width: 80%; margin: auto;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

    </section>
    <!-- right col -->
    </div>
    <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection

@push('scriptChart')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('barChart').getContext('2d');

    var data = {
        labels: @json($dates), // Labels will be the formatted dates
        datasets: [
            {
                label: 'Siswa telat hari ini',
                data: @json($telatData), // Data will be the count of late students
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },
        ]
    };

    var options = {
        scales: {
            x: {
                stacked: true
            },
            y: {
                beginAtZero: true,
                stacked: true
            }
        }
    };

    var myChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options
    });
</script>


@endpush

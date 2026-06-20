@extends('layouts.app')

@section('content')
    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Data Siswa Terlambat</h1>
            <form action="{{ route('reset') }}" method="post">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-danger-600 hover:bg-danger-700 text-white font-medium rounded-lg text-sm transition-colors" onclick="return confirm('Reset semua data telat?')">
                    <i class="fas fa-undo"></i>
                    Reset
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="min-w-full divide-y divide-slate-200" id="tableLate">
                <thead class="bg-primary-600">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Nama Siswa</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Kelas</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Jurusan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Telat</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @foreach ($dataLateSiswa as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-slate-800">{{ $item->datasiswa->Nama_siswa ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $item->kelas->Nama_kelas }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $item->jurusan->Nama_jurusan }}</td>
                            <td class="px-4 py-3 text-sm"><x-badge variant="danger">{{ $item->Telat }} menit</x-badge></td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $item->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        outline: none;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
        margin-left: 0.5rem;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #2563EB;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        outline: none;
        margin: 0 0.25rem;
    }
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: #2563EB;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 0.5rem;
        padding: 0.375rem 0.75rem;
        margin: 0 0.125rem;
        font-size: 0.875rem;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #475569 !important;
        transition: all 0.15s ease;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f1f5f9 !important;
        border-color: #cbd5e1 !important;
        color: #1e293b !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #2563EB !important;
        border-color: #2563EB !important;
        color: #fff !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #1D4ED8 !important;
        border-color: #1D4ED8 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        opacity: 0.4;
        cursor: default;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        background: #fff !important;
        border-color: #e2e8f0 !important;
    }
    .dataTables_wrapper .dataTables_info {
        font-size: 0.875rem;
        color: #64748b;
        padding-top: 0.75rem;
    }
    .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter {
        font-size: 0.875rem;
        color: #475569;
        padding-bottom: 0.5rem;
    }
    .dataTables_wrapper .dataTables_paginate {
        padding-top: 0.75rem;
    }
    table.dataTable.no-footer { border-bottom: 1px solid #e2e8f0; }
    table.dataTable thead th { border-bottom: none; }
    table.dataTable tbody tr { background-color: transparent; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        $('#tableLate').DataTable({
            responsive: true,
            pageLength: 25,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                zeroRecords: "Tidak ada data ditemukan",
                paginate: { first: "Pertama", last: "Terakhir", next: "›", previous: "‹" }
            }
        });
    });
</script>
@endpush

@extends('layouts.app')

@section('content')
    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Data Kelas</h1>
            <x-modal title="Tambah Kelas" size="md">
                <x-slot:trigger>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2 bg-danger-600 hover:bg-danger-700 text-white font-medium rounded-lg text-sm transition-colors">
                        <i class="fas fa-plus"></i>
                        Tambah Kelas
                    </button>
                </x-slot:trigger>
                <form action="{{ route('actionKelas') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tingkat Kelas <span class="text-danger-500">*</span></label>
                        <select name="tingkatKelas" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm">
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </div>
                    <x-input name="namaKelas" label="Nama Kelas" placeholder="Masukan nama kelas" :required="true" />
                    <x-input name="waliKelas" label="Nama Wali Kelas" placeholder="Masukan nama walikelas" :required="true" />
                    <div class="mt-6 flex gap-3 justify-end">
                        <button type="button" @click="open = false" class="px-4 py-2 border-2 border-slate-300 text-slate-600 hover:bg-slate-50 font-medium rounded-lg text-sm transition-colors">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg text-sm transition-colors">Simpan</button>
                    </div>
                </form>
            </x-modal>
        </div>

        @if (session()->has('success'))
            <x-alert variant="success" :message="session('success')" />
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="min-w-full divide-y divide-slate-200" id="tableKelas">
                <thead class="bg-primary-600">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Tingkat</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Nama Kelas</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Wali Kelas</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @foreach ($dataKelas as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $item->Tingkat_kelas }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-slate-800">{{ $item->Nama_kelas }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $item->Walikelas }}</td>
                            <td class="px-4 py-3 text-sm flex gap-2">
                                <a href="{{ route('kelasForm', $item->id) }}" class="px-3 py-1.5 bg-primary-600 hover:bg-primary-700 text-white rounded-lg text-xs font-medium transition-colors">Update</a>
                                <form action="{{ route('deleteKelas', $item->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-danger-600 hover:bg-danger-700 text-white rounded-lg text-xs font-medium transition-colors">Delete</button>
                                </form>
                            </td>
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
        $('#tableKelas').DataTable({
            responsive: true,
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

@extends('layouts.app')

@section('content')
    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Data Siswa</h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg text-sm transition-colors">
                    <i class="fas fa-plus"></i>
                    Halaman Tambah
                </a>
                <x-modal title="Tambah Data Siswa" size="xl">
                    <x-slot:trigger>
                        <button type="button" class="inline-flex items-center gap-2 px-4 py-2 bg-danger-600 hover:bg-danger-700 text-white font-medium rounded-lg text-sm transition-colors">
                            <i class="fas fa-plus"></i>
                            Tambah Siswa
                        </button>
                    </x-slot:trigger>
                    <form action="{{ route('action') }}" method="post" x-data="{ step: 1, totalSteps: 3 }">
                        @csrf
                        {{-- Step Indicators --}}
                        <div class="flex items-center justify-center gap-4 mb-8">
                            <template x-for="(label, i) in ['Data Pribadi', 'Data Akademik', 'Data Kontak']" :key="i">
                                <div class="flex items-center gap-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-colors"
                                            :class="step >= i + 1 ? 'bg-primary-600 text-white' : 'bg-slate-200 text-slate-500'"
                                            x-text="i + 1">
                                        </div>
                                        <span class="text-xs font-medium hidden sm:block"
                                            :class="step >= i + 1 ? 'text-primary-600' : 'text-slate-400'"
                                            x-text="label">
                                        </span>
                                    </div>
                                    <template x-if="i < totalSteps - 1">
                                        <div class="w-8 h-0.5" :class="step > i + 1 ? 'bg-primary-600' : 'bg-slate-200'"></div>
                                    </template>
                                </div>
                            </template>
                        </div>

                        {{-- Step 1: Data Pribadi --}}
                        <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
                                <x-input name="nisn" label="NISN" placeholder="Masukan NISN" :required="true" maxlength="10" />
                                <x-input name="siswa" label="Nama Siswa" placeholder="Masukan Nama Siswa" :required="true" />
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Kelamin <span class="text-danger-500">*</span></label>
                                    <select name="gender" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm">
                                        <option value="laki-laki">Laki laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <x-input name="alamat" label="Alamat" placeholder="Masukan Alamat" :required="true" />
                            </div>
                        </div>

                        {{-- Step 2: Data Akademik --}}
                        <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Kelas <span class="text-danger-500">*</span></label>
                                    <select name="kelas" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm">
                                        @foreach ($data['kelas'] as $item)
                                            <option value="{{ $item->id }}">{{ $item->Nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Jurusan <span class="text-danger-500">*</span></label>
                                    <select name="jurusan" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm">
                                        @foreach ($data['jurusan'] as $item)
                                            <option value="{{ $item->id }}">{{ $item->Nama_jurusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Step 3: Data Kontak --}}
                        <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
                                <x-input name="nohp" label="No Handphone" placeholder="Masukan No HP" maxlength="12" />
                                <x-input name="ayah" label="Nama Ayah" placeholder="Masukan Nama Ayah" />
                                <x-input name="ibu" label="Nama Ibu" placeholder="Masukan Nama Ibu" />
                                <x-input name="hpAyah" label="No HP Ayah" placeholder="Masukan No HP Ayah" maxlength="12" />
                                <x-input name="hpIbu" label="No HP Ibu" placeholder="Masukan No HP Ibu" maxlength="12" />
                            </div>
                        </div>

                        {{-- Navigation --}}
                        <div class="mt-6 flex items-center justify-between">
                            <div>
                                <button type="button" @click="open = false" class="px-4 py-2 border-2 border-slate-300 text-slate-600 hover:bg-slate-50 font-medium rounded-lg text-sm transition-colors">Batal</button>
                            </div>
                            <div class="flex gap-3">
                                <button type="button" x-show="step > 1" @click="step--" class="px-4 py-2 border-2 border-primary-600 text-primary-600 hover:bg-primary-50 font-medium rounded-lg text-sm transition-colors">
                                    <i class="fas fa-arrow-left mr-1"></i> Sebelumnya
                                </button>
                                <button type="button" x-show="step < totalSteps" @click="step++" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg text-sm transition-colors">
                                    Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                                </button>
                                <button type="submit" x-show="step === totalSteps" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg text-sm transition-colors">
                                    <i class="fas fa-check mr-1"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </x-modal>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200" id="tableSiswa">
                    <thead class="bg-primary-600">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">No</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">NISN</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Nama</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">JK</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Kelas</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Jurusan</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Alamat</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">No HP</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Ayah</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Ibu</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">HP Ayah</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">HP Ibu</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">QR</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @foreach ($data['dataRelasi'] as $item)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3 text-sm text-slate-600">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-slate-800">{{ $item->Nisn }}</td>
                                <td class="px-4 py-3 text-sm text-slate-800">{{ $item->Nama_siswa }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600">{{ $item->Jenis_kelamin }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600">{{ $item->kelas->Nama_kelas }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600">{{ $item->jurusan->Nama_jurusan }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600 max-w-xs truncate">{{ $item->Alamat }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600">{{ $item->No_Handphone }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600">{{ $item->Nama_Ortu_Ayah }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600">{{ $item->Nama_Ortu_Ibu }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600">{{ $item->No_Handphone_Ayah }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600">{{ $item->No_Handphone_Ibu }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('qrCode', $item->id) }}" class="text-primary-600 hover:text-primary-800">
                                        {!! QrCode::size(40)->generate($item->Nisn) !!}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
    .dataTables_wrapper .dataTables_length {
        font-size: 0.875rem;
        color: #475569;
        padding-bottom: 0.5rem;
    }
    .dataTables_wrapper .dataTables_filter {
        font-size: 0.875rem;
        color: #475569;
        padding-bottom: 0.5rem;
    }
    .dataTables_wrapper .dataTables_paginate {
        padding-top: 0.75rem;
    }
    table.dataTable.no-footer {
        border-bottom: 1px solid #e2e8f0;
    }
    table.dataTable thead th {
        border-bottom: none;
    }
    table.dataTable tbody tr {
        background-color: transparent;
    }
    table.dataTable.stripe tbody tr.odd {
        background-color: #f8fafc;
    }
    table.dataTable tbody tr.selected {
        background-color: #eff6ff;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        $('#tableSiswa').DataTable({
            responsive: true,
            pageLength: 25,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                zeroRecords: "Tidak ada data ditemukan",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "›",
                    previous: "‹"
                }
            }
        });
    });
</script>
@endpush

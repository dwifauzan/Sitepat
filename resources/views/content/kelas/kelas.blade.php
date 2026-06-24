@extends('layouts.app')

@section('page-header', 'Manajemen Kelas')

@section('breadcrumb')
    <a href="{{ route('dash') }}" class="hover:text-slate-700 transition-colors">Beranda</a>
    <span class="mx-1.5 text-slate-300">/</span>
    <span class="text-slate-800 font-medium">Manajemen Kelas</span>
@endsection

@section('page-action')
    <x-modal title="Tambah Kelas" size="md">
        <x-slot:trigger>
            <button type="button" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg text-sm transition-colors duration-150">
                <i class="fas fa-plus"></i>
                Tambah Kelas
            </button>
        </x-slot:trigger>
        <form action="{{ route('actionKelas') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="block text-sm font-medium text-slate-700 mb-1">Tingkat Kelas <span class="text-red-500">*</span></label>
                <select name="tingkatKelas" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                </select>
            </div>
            <x-input name="namaKelas" label="Nama Kelas" placeholder="Masukan nama kelas" :required="true" />
            <x-input name="waliKelas" label="Nama Wali Kelas" placeholder="Masukan nama walikelas" :required="true" />
            <div class="mt-6 flex gap-3 justify-end">
                <button type="button" @click="open = false" class="px-4 py-2 border border-slate-300 text-slate-700 hover:bg-slate-50 font-medium rounded-lg text-sm transition-colors duration-150">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition-colors duration-150">Simpan</button>
            </div>
        </form>
    </x-modal>
@endsection

@section('content')
    @if (session()->has('success'))
        <x-alert variant="success" :message="session('success')" />
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <!-- Table Header with Search and Filter -->
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h3 class="text-base font-semibold text-slate-900">Daftar Kelas</h3>
                    <p class="text-sm text-slate-500 mt-0.5">Kelola data kelas dan wali kelas</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <select id="filterTingkat" class="px-4 py-3.5 border-2 border-slate-200 rounded-xl text-sm font-medium
                                                       bg-slate-50 transition-all duration-200 ease-in-out
                                                       focus:bg-white focus:border-blue-400 focus:ring-4 focus:ring-blue-100
                                                       hover:border-slate-300 hover:bg-white min-w-[140px]">
                            <option value="">Semua Tingkat</option>
                            <option value="X">Kelas X</option>
                            <option value="XI">Kelas XI</option>
                            <option value="XII">Kelas XII</option>
                        </select>
                    </div>
                    <div class="relative flex-1 max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-slate-400 text-base"></i>
                        </div>
                        <input type="text" id="searchKelas" placeholder="Cari kelas atau wali kelas..." 
                               class="w-full pl-12 pr-6 py-3.5 border-2 border-slate-200 rounded-xl text-sm font-medium
                                      placeholder:text-slate-400 placeholder:font-normal
                                      bg-slate-50 transition-all duration-200 ease-in-out
                                      focus:bg-white focus:border-blue-400 focus:ring-4 focus:ring-blue-100
                                      hover:border-slate-300 hover:bg-white">
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-hidden rounded-2xl border-2 border-slate-200 shadow-lg bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200" id="tableKelas">
                    <thead class="bg-gradient-to-r from-slate-50 to-slate-100">
                        <tr>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider w-20 border-b-2 border-slate-200">No</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider w-28 border-b-2 border-slate-200">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-layer-group text-green-500 text-sm"></i>
                                    Tingkat
                                </div>
                            </th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-b-2 border-slate-200">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-door-open text-blue-500 text-sm"></i>
                                    Nama Kelas
                                </div>
                            </th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-b-2 border-slate-200">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-chalkboard-teacher text-purple-500 text-sm"></i>
                                    Wali Kelas
                                </div>
                            </th>
                            <th class="px-8 py-5 text-center text-xs font-bold text-slate-700 uppercase tracking-wider w-36 border-b-2 border-slate-200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        @forelse ($dataKelas as $item)
                            <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group" data-tingkat="{{ $item->Tingkat_kelas }}">
                                <td class="px-8 py-6 text-sm text-slate-500 font-medium">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 text-slate-600 group-hover:from-blue-100 group-hover:to-blue-200 group-hover:text-blue-700 transition-all duration-200 font-semibold">
                                        {{ $loop->iteration }}
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold shadow-sm
                                        {{ $item->Tingkat_kelas == 'X' ? 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 border border-green-200' : '' }}
                                        {{ $item->Tingkat_kelas == 'XI' ? 'bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-700 border border-blue-200' : '' }}
                                        {{ $item->Tingkat_kelas == 'XII' ? 'bg-gradient-to-r from-purple-100 to-violet-100 text-purple-700 border border-purple-200' : '' }}">
                                        Kelas {{ $item->Tingkat_kelas }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl shadow-sm
                                            {{ $item->Tingkat_kelas == 'X' ? 'bg-gradient-to-br from-green-100 to-emerald-200' : '' }}
                                            {{ $item->Tingkat_kelas == 'XI' ? 'bg-gradient-to-br from-blue-100 to-cyan-200' : '' }}
                                            {{ $item->Tingkat_kelas == 'XII' ? 'bg-gradient-to-br from-purple-100 to-violet-200' : '' }}
                                            flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-users text-lg
                                                {{ $item->Tingkat_kelas == 'X' ? 'text-green-600' : '' }}
                                                {{ $item->Tingkat_kelas == 'XI' ? 'text-blue-600' : '' }}
                                                {{ $item->Tingkat_kelas == 'XII' ? 'text-purple-600' : '' }}"></i>
                                        </div>
                                        <div>
                                            <p class="text-base font-bold text-slate-900 mb-1">{{ $item->Nama_kelas }}</p>
                                            <p class="text-sm text-slate-500 font-medium">Kelas {{ $item->Tingkat_kelas }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                                            <span class="text-white text-sm font-bold">{{ strtoupper(substr($item->Walikelas, 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-900">{{ $item->Walikelas }}</p>
                                            <p class="text-xs text-slate-500">Wali Kelas</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('kelasForm', $item->id) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-blue-600 hover:bg-blue-500 hover:text-white bg-blue-50 transition-all duration-200 text-sm font-semibold shadow-sm hover:shadow-md transform hover:scale-105" title="Edit">
                                        <i class="fas fa-pen text-xs"></i>
                                        <span>Edit</span>
                                    </a>
                                    <form action="{{ route('deleteKelas', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data kelas {{ $item->Nama_kelas }}?\n\nTindakan ini tidak bisa dibatalkan dan akan menghapus semua data terkait.')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-red-600 hover:bg-red-50 transition-all duration-150 text-sm font-medium" title="Hapus">
                                            <i class="fas fa-trash text-xs"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mb-3">
                                        <i class="fas fa-inbox text-slate-400 text-2xl"></i>
                                    </div>
                                    <p class="text-sm font-medium text-slate-900 mb-1">Belum ada data kelas</p>
                                    <p class="text-xs text-slate-500">Klik tombol "Tambah Kelas" untuk menambahkan data</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer with Info -->
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
            <div class="flex items-center justify-between text-sm text-slate-600">
                <span id="tableInfo">Menampilkan <span class="font-medium text-slate-900">{{ count($dataKelas) }}</span> kelas</span>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-sm bg-green-100"></span>
                        <span class="text-xs">Kelas X</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-sm bg-blue-100"></span>
                        <span class="text-xs">Kelas XI</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-sm bg-purple-100"></span>
                        <span class="text-xs">Kelas XII</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('components.data-table-styles')

@push('scripts')
<script>
    $(function() {
        // Custom search functionality
        $('#searchKelas').on('keyup', function() {
            filterTable();
        });

        // Filter by tingkat
        $('#filterTingkat').on('change', function() {
            filterTable();
        });

        function filterTable() {
            var searchValue = $('#searchKelas').val().toLowerCase();
            var tingkatValue = $('#filterTingkat').val();
            
            $('#tableKelas tbody tr[data-tingkat]').each(function() {
                var row = $(this);
                var text = row.text().toLowerCase();
                var tingkat = row.data('tingkat');
                
                var matchSearch = text.indexOf(searchValue) > -1;
                var matchTingkat = tingkatValue === '' || tingkat === tingkatValue;
                
                row.toggle(matchSearch && matchTingkat);
            });
            
            // Update count and show/hide no results
            var visibleRows = $('#tableKelas tbody tr[data-tingkat]:visible').length;
            var totalRows = $('#tableKelas tbody tr[data-tingkat]').length;
            
            if (visibleRows === 0 && totalRows > 0) {
                if ($('#tableKelas tbody tr.no-results').length === 0) {
                    var message = searchValue !== '' ? `Tidak ada hasil untuk "${searchValue}"` : 'Tidak ada kelas pada tingkat ini';
                    $('#tableKelas tbody').append(`
                        <tr class="no-results">
                            <td colspan="5" class="px-6 py-8 text-center">
                                <i class="fas fa-search text-slate-300 text-2xl mb-2"></i>
                                <p class="text-sm text-slate-500">${message}</p>
                            </td>
                        </tr>
                    `);
                }
            } else {
                $('#tableKelas tbody tr.no-results').remove();
            }
            
            $('#tableInfo').html(`Menampilkan <span class="font-medium text-slate-900">${visibleRows}</span> dari ${totalRows} kelas`);
        }

        // Add animation to rows
        $('#tableKelas tbody tr[data-tingkat]').each(function(index) {
            $(this).css({
                'animation': 'fadeInUp 0.3s ease-out forwards',
                'animation-delay': (index * 0.05) + 's',
                'opacity': '0'
            });
        });
    });
</script>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

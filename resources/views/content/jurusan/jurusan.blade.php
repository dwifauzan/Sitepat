@extends('layouts.app')

@section('page-header', 'Manajemen Jurusan')

@section('breadcrumb')
    <a href="{{ route('dash') }}" class="hover:text-slate-700 transition-colors">Beranda</a>
    <span class="mx-1.5 text-slate-300">/</span>
    <span class="text-slate-800 font-medium">Manajemen Jurusan</span>
@endsection

@section('page-action')
    <x-modal title="Tambah Jurusan" size="md">
        <x-slot:trigger>
            <button type="button" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg text-sm transition-colors duration-150">
                <i class="fas fa-plus"></i>
                Tambah Jurusan
            </button>
        </x-slot:trigger>
        <form action="{{ route('actionJurusan') }}" method="post">
            @csrf
            <x-input name="namaJurusan" label="Nama Jurusan" placeholder="Masukan nama Jurusan" :required="true" />
            <x-input name="kaproli" label="Nama Kaprodi" placeholder="Masukan nama Kaprodi" :required="true" />
            <div class="mt-6 flex gap-3 justify-end">
                <button type="button" @click="open = false" class="px-4 py-2 border border-slate-300 text-slate-700 hover:bg-slate-50 font-medium rounded-lg text-sm transition-colors duration-150">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition-colors duration-150">Simpan</button>
            </div>
        </form>
    </x-modal>
@endsection

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <!-- Table Header with Search -->
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h3 class="text-base font-semibold text-slate-900">Daftar Jurusan</h3>
                    <p class="text-sm text-slate-500 mt-0.5">Kelola data jurusan dan kepala program studi</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                        <input type="text" id="searchJurusan" placeholder="Cari jurusan..." class="pl-9 pr-4 py-2 border border-slate-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all">
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200" id="tableJurusan">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider w-16">No</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-graduation-cap text-slate-400"></i>
                                Nama Jurusan
                            </div>
                        </th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-user-tie text-slate-400"></i>
                                Kepala Program Studi
                            </div>
                        </th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse ($dataJurusan as $item)
                        <tr class="hover:bg-blue-50 transition-colors duration-150 group">
                            <td class="px-6 py-4 text-sm text-slate-500 font-medium">
                                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-600 group-hover:bg-blue-100 group-hover:text-blue-700 transition-colors">
                                    {{ $loop->iteration }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-book text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900">{{ $item->Nama_jurusan }}</p>
                                        <p class="text-xs text-slate-500">Program Studi</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center flex-shrink-0">
                                        <span class="text-white text-xs font-semibold">{{ strtoupper(substr($item->Nama_kaproli, 0, 1)) }}</span>
                                    </div>
                                    <span class="text-sm text-slate-700">{{ $item->Nama_kaproli }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('jurusanForm', $item->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-blue-600 hover:bg-blue-50 transition-all duration-150 text-sm font-medium" title="Edit">
                                        <i class="fas fa-pen text-xs"></i>
                                        <span>Edit</span>
                                    </a>
                                    <form action="{{ route('deleteJurusan', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data jurusan {{ $item->Nama_jurusan }}?\n\nTindakan ini tidak bisa dibatalkan dan akan menghapus semua data terkait.')" class="inline">
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
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mb-3">
                                        <i class="fas fa-inbox text-slate-400 text-2xl"></i>
                                    </div>
                                    <p class="text-sm font-medium text-slate-900 mb-1">Belum ada data jurusan</p>
                                    <p class="text-xs text-slate-500">Klik tombol "Tambah Jurusan" untuk menambahkan data</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer with Pagination Info -->
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
            <div class="flex items-center justify-between text-sm text-slate-600">
                <span id="tableInfo">Menampilkan <span class="font-medium text-slate-900">{{ count($dataJurusan) }}</span> jurusan</span>
            </div>
        </div>
    </div>
@endsection

@include('components.data-table-styles')

@push('scripts')
<script>
    $(function() {
        // Custom search functionality
        $('#searchJurusan').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#tableJurusan tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
            
            // Update count
            var visibleRows = $('#tableJurusan tbody tr:visible').length;
            if (visibleRows === 0 && value !== '') {
                if ($('#tableJurusan tbody tr.no-results').length === 0) {
                    $('#tableJurusan tbody').append(`
                        <tr class="no-results">
                            <td colspan="4" class="px-6 py-8 text-center">
                                <i class="fas fa-search text-slate-300 text-2xl mb-2"></i>
                                <p class="text-sm text-slate-500">Tidak ada hasil untuk "${value}"</p>
                            </td>
                        </tr>
                    `);
                }
            } else {
                $('#tableJurusan tbody tr.no-results').remove();
                $('#tableInfo').html(`Menampilkan <span class="font-medium text-slate-900">${visibleRows}</span> jurusan`);
            }
        });

        // Add animation to rows
        $('#tableJurusan tbody tr').each(function(index) {
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

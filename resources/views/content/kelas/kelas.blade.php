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
        <table class="min-w-full divide-y divide-slate-200" id="tableKelas">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tingkat</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama Kelas</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Wali Kelas</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @foreach ($dataKelas as $item)
                    <tr class="hover:bg-blue-50 transition-colors duration-100">
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $item->Tingkat_kelas }}</td>
                        <td class="px-4 py-3 text-sm font-medium text-slate-800">{{ $item->Nama_kelas }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $item->Walikelas }}</td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center gap-1.5">
                                <a href="{{ route('kelasForm', $item->id) }}" class="p-2 rounded-md text-blue-600 hover:bg-blue-50 transition-colors" aria-label="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('deleteKelas', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data kelas {{ $item->Nama_kelas }}? Tindakan ini tidak bisa dibatalkan.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 rounded-md text-red-600 hover:bg-red-50 transition-colors" aria-label="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@include('components.data-table-styles')

@push('scripts')
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

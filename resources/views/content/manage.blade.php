@extends('layouts.app')

@section('page-header', 'Kelola Data Siswa')

@section('breadcrumb')
    <a href="{{ route('dash') }}" class="hover:text-slate-700 transition-colors">Beranda</a>
    <span class="mx-1.5 text-slate-300">/</span>
    <span class="text-slate-800 font-medium">Kelola Data Siswa</span>
@endsection

@section('page-action')
    <x-modal title="Tambah Data Siswa" size="xl">
        <x-slot:trigger>
            <button type="button" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg text-sm transition-colors duration-150">
                <i class="fas fa-plus"></i>
                Tambah Siswa
            </button>
        </x-slot:trigger>
        <form action="{{ route('action') }}" method="post" x-data="{ step: 1, totalSteps: 3 }">
            @csrf
            <div class="flex items-center justify-center gap-4 mb-8">
                <template x-for="(label, i) in ['Data Pribadi', 'Data Akademik', 'Data Kontak']" :key="i">
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-colors"
                                :class="step >= i + 1 ? 'bg-blue-600 text-white' : 'bg-slate-200 text-slate-500'"
                                x-text="i + 1">
                            </div>
                            <span class="text-xs font-medium hidden sm:block"
                                :class="step >= i + 1 ? 'text-blue-600' : 'text-slate-400'"
                                x-text="label">
                            </span>
                        </div>
                        <template x-if="i < totalSteps - 1">
                            <div class="w-8 h-0.5" :class="step > i + 1 ? 'bg-blue-600' : 'bg-slate-200'"></div>
                        </template>
                    </div>
                </template>
            </div>

            <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
                    <x-input name="nisn" label="NISN" placeholder="Masukan NISN" :required="true" maxlength="10" />
                    <x-input name="siswa" label="Nama Siswa" placeholder="Masukan Nama Siswa" :required="true" />
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="gender" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                            <option value="laki-laki">Laki laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <x-input name="alamat" label="Alamat" placeholder="Masukan Alamat" :required="true" />
                </div>
            </div>

            <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Kelas <span class="text-red-500">*</span></label>
                        <select name="kelas" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                            @foreach ($data['kelas'] as $item)
                                <option value="{{ $item->id }}">{{ $item->Nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Jurusan <span class="text-red-500">*</span></label>
                        <select name="jurusan" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                            @foreach ($data['jurusan'] as $item)
                                <option value="{{ $item->id }}">{{ $item->Nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
                    <x-input name="nohp" label="No Handphone" placeholder="Masukan No HP" maxlength="12" />
                    <x-input name="ayah" label="Nama Ayah" placeholder="Masukan Nama Ayah" />
                    <x-input name="ibu" label="Nama Ibu" placeholder="Masukan Nama Ibu" />
                    <x-input name="hpAyah" label="No HP Ayah" placeholder="Masukan No HP Ayah" maxlength="12" />
                    <x-input name="hpIbu" label="No HP Ibu" placeholder="Masukan No HP Ibu" maxlength="12" />
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <div>
                    <button type="button" @click="open = false" class="px-4 py-2 border border-slate-300 text-slate-700 hover:bg-slate-50 font-medium rounded-lg text-sm transition-colors duration-150">Batal</button>
                </div>
                <div class="flex gap-3">
                    <button type="button" x-show="step > 1" @click="step--" class="px-4 py-2 border border-blue-600 text-blue-600 hover:bg-blue-50 font-medium rounded-lg text-sm transition-colors duration-150">
                        <i class="fas fa-arrow-left mr-1"></i> Sebelumnya
                    </button>
                    <button type="button" x-show="step < totalSteps" @click="step++" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition-colors duration-150">
                        Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                    <button type="submit" x-show="step === totalSteps" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition-colors duration-150">
                        <i class="fas fa-check mr-1"></i> Simpan Data
                    </button>
                </div>
            </div>
        </form>
    </x-modal>
@endsection

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200" id="tableSiswa">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">NISN</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">JK</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Kelas</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Jurusan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Alamat</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">No HP</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @foreach ($data['dataRelasi'] as $item)
                        <tr class="hover:bg-blue-50 transition-colors duration-100">
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm font-mono font-medium text-slate-800">{{ $item->Nisn }}</td>
                            <td class="px-4 py-3 text-sm text-slate-800">{{ $item->Nama_siswa }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $item->Jenis_kelamin }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $item->kelas->Nama_kelas }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $item->jurusan->Nama_jurusan }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600 max-w-xs truncate">{{ $item->Alamat }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $item->No_Handphone }}</td>
                            <td class="px-4 py-3 text-sm">
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('qrCode', $item->id) }}" class="p-2 rounded-md text-blue-600 hover:bg-blue-50 transition-colors" aria-label="Lihat QR">
                                        <i class="fas fa-qrcode"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@include('components.data-table-styles')

@push('scripts')
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

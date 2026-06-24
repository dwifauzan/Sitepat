@extends('layouts.app')

@section('page-header', 'Rekap Keterlambatan')

@section('breadcrumb')
    <a href="{{ route('dash') }}" class="hover:text-slate-700 transition-colors">Beranda</a>
    <span class="mx-1.5 text-slate-300">/</span>
    <span class="text-slate-800 font-medium">Rekap Keterlambatan</span>
@endsection

@section('page-action')
    <form action="{{ route('reset') }}" method="post" onsubmit="return confirm('Reset semua counter keterlambatan? Tindakan ini tidak bisa dibatalkan.')">
        @csrf
        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 border border-red-600 text-red-600 hover:bg-red-50 font-medium rounded-lg text-sm transition-colors duration-150">
            <i class="fas fa-undo"></i>
            Reset Semua Counter
        </button>
    </form>
@endsection

@section('content')
    <div class="overflow-hidden rounded-2xl border-2 border-slate-200 shadow-lg bg-white">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200" id="tableLate">
                <thead class="bg-gradient-to-r from-slate-50 to-slate-100">
                    <tr>
                        <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider w-16 border-b-2 border-slate-200">No</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-b-2 border-slate-200">Nama Siswa</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-b-2 border-slate-200">Kelas</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-b-2 border-slate-200">Jurusan</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-b-2 border-slate-200">Telat</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-b-2 border-slate-200">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    @foreach ($dataLateSiswa as $item)
                        <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group">
                            <td class="px-6 py-5 text-sm text-slate-500 font-medium">
                                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-slate-100 to-slate-200 text-slate-600 group-hover:from-blue-100 group-hover:to-blue-200 group-hover:text-blue-700 transition-all duration-200 font-semibold text-xs">
                                    {{ $loop->iteration }}
                                </div>
                            </td>
                            <td class="px-6 py-5 text-sm font-bold text-slate-900">{{ $item->datasiswa->Nama_siswa ?? '-' }}</td>
                            <td class="px-6 py-5 text-sm font-medium text-slate-700">{{ $item->kelas->Nama_kelas }}</td>
                            <td class="px-6 py-5 text-sm text-slate-600">{{ $item->jurusan->Nama_jurusan }}</td>
                            <td class="px-6 py-5 text-sm">
                                @php
                                    $telatVal = $item->Telat;
                                    $badgeVariant = $telatVal >= 3 ? 'danger' : ($telatVal >= 2 ? 'warning' : 'success');
                                @endphp
                                <div class="inline-flex items-center px-3 py-2 rounded-xl text-sm font-bold shadow-sm
                                    {{ $telatVal >= 3 ? 'bg-gradient-to-r from-red-100 to-red-200 text-red-700 border border-red-300' : '' }}
                                    {{ $telatVal >= 2 && $telatVal < 3 ? 'bg-gradient-to-r from-yellow-100 to-orange-200 text-orange-700 border border-orange-300' : '' }}
                                    {{ $telatVal < 2 ? 'bg-gradient-to-r from-green-100 to-emerald-200 text-green-700 border border-green-300' : '' }}">
                                    {{ $telatVal }} menit
                                </div>
                            </td>
                            <td class="px-6 py-5 text-sm text-slate-600 font-medium">{{ $item->updated_at }}</td>
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

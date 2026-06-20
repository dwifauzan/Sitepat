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
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200" id="tableLate">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama Siswa</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Kelas</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Jurusan</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Telat</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tanggal</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @foreach ($dataLateSiswa as $item)
                    <tr class="hover:bg-blue-50 transition-colors duration-100">
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 text-sm font-medium text-slate-800">{{ $item->datasiswa->Nama_siswa ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $item->kelas->Nama_kelas }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $item->jurusan->Nama_jurusan }}</td>
                        <td class="px-4 py-3 text-sm">
                            @php
                                $telatVal = $item->Telat;
                                $badgeVariant = $telatVal >= 3 ? 'danger' : ($telatVal >= 2 ? 'warning' : 'success');
                            @endphp
                            <x-badge :variant="$badgeVariant">{{ $telatVal }} menit</x-badge>
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $item->updated_at }}</td>
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

@extends('layouts.app')

@section('page-header')
@section('breadcrumb')
    <a href="{{ route('manage') }}" class="hover:text-slate-700 transition-colors">Kelola Data Siswa</a>
    <span class="mx-1.5 text-slate-300">/</span>
    <span class="text-slate-800 font-medium">QR Code Siswa</span>
@endsection

@section('content')
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 text-center">
            <div class="mb-6">
                <h3 class="text-xl font-bold text-slate-900">{{ $data['dataSiswa']->Nama_siswa }}</h3>
                <p class="text-sm font-mono text-slate-500 mt-1">{{ $data['dataSiswa']->Nisn }}</p>
                <p class="text-sm text-slate-500">{{ $data['dataSiswa']->jurusan->Nama_jurusan }} · {{ $data['dataSiswa']->kelas->Nama_kelas }}</p>
            </div>
            <div class="bg-white p-4 rounded-xl inline-block shadow-sm mb-6">
                {!! QrCode::size(300)->generate($data['dataSiswa']->Nisn) !!}
            </div>
            <div class="flex gap-3 justify-center">
                <a href="{{ route('manage') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-slate-300 text-slate-700 hover:bg-slate-50 font-medium rounded-lg text-sm transition-colors duration-150">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition-colors duration-150">
                    <i class="fas fa-print"></i>
                    Cetak
                </button>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 text-center">
            <div class="mb-4">
                <h3 class="text-xl font-bold text-slate-800">{{ $data['dataSiswa']->Nama_siswa }}</h3>
                <p class="text-sm text-slate-500">{{ $data['dataSiswa']->Nisn }}</p>
                <p class="text-sm text-slate-500">{{ $data['dataSiswa']->jurusan->Nama_jurusan }} · {{ $data['dataSiswa']->kelas->Nama_kelas }}</p>
                <p class="text-sm text-slate-400 mt-2">{{ $data['dataSiswa']->Alamat }}</p>
            </div>
            <div class="bg-white p-4 rounded-xl inline-block shadow-sm mb-4">
                {!! QrCode::size(300)->generate($data['dataSiswa']->Nisn) !!}
            </div>
            <div class="flex gap-3 justify-center">
                <a href="{{ route('manage') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg text-sm transition-colors">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection

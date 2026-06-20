@extends('layouts.app')

@section('page-header', 'Perbarui Jurusan')

@section('breadcrumb')
    <a href="{{ route('jurusan') }}" class="hover:text-slate-700 transition-colors">Manajemen Jurusan</a>
    <span class="mx-1.5 text-slate-300">/</span>
    <span class="text-slate-800 font-medium">Perbarui Jurusan</span>
@endsection

@section('content')
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form action="{{ route('jurusanUpdate', $dataJurusan->id) }}" method="post">
                @csrf
                <x-input name="namaJurusan" label="Nama Jurusan" :value="$dataJurusan->Nama_jurusan" placeholder="Masukan nama Jurusan" :required="true" />
                <x-input name="kaproli" label="Nama Kaprodi" :value="$dataJurusan->Nama_kaproli" placeholder="Masukan nama Kaprodi" :required="true" />
                <div class="mt-6 flex gap-3 justify-end">
                    <a href="{{ route('jurusan') }}" class="px-4 py-2 border border-slate-300 text-slate-700 hover:bg-slate-50 font-medium rounded-lg text-sm transition-colors duration-150">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition-colors duration-150">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

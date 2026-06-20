@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto">
        <h1 class="text-2xl font-bold text-slate-800 mb-6 text-center">Update Jurusan</h1>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form action="{{ route('jurusanUpdate', $data['jurusan']->id) }}" method="post">
                @csrf
                <x-input name="namaJurusan" label="Nama Jurusan" :value="$data['jurusan']->Nama_jurusan" placeholder="Masukan nama Jurusan" />
                <x-input name="Nama_kaproli" label="Nama Kaprodi" :value="$data['jurusan']->Nama_kaproli" placeholder="Masukan nama Kaprodi" />
                <button type="submit" class="w-full py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors text-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection

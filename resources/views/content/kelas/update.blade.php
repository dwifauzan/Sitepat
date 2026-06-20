@extends('layouts.app')

@section('page-header', 'Perbarui Kelas')

@section('breadcrumb')
    <a href="{{ route('kelas') }}" class="hover:text-slate-700 transition-colors">Manajemen Kelas</a>
    <span class="mx-1.5 text-slate-300">/</span>
    <span class="text-slate-800 font-medium">Perbarui Kelas</span>
@endsection

@section('content')
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form action="{{ route('kelasUpdate', $dataKelas->id) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tingkat Kelas <span class="text-red-500">*</span></label>
                    <select name="tingkatKelas" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                        <option value="X" {{ $dataKelas->Tingkat_kelas == 'X' ? 'selected' : '' }}>X</option>
                        <option value="XI" {{ $dataKelas->Tingkat_kelas == 'XI' ? 'selected' : '' }}>XI</option>
                        <option value="XII" {{ $dataKelas->Tingkat_kelas == 'XII' ? 'selected' : '' }}>XII</option>
                    </select>
                </div>
                <x-input name="namaKelas" label="Nama Kelas" :value="$dataKelas->Nama_kelas" placeholder="Masukan nama kelas" :required="true" />
                <x-input name="waliKelas" label="Nama Wali Kelas" :value="$dataKelas->Walikelas" placeholder="Masukan nama walikelas" :required="true" />
                <div class="mt-6 flex gap-3 justify-end">
                    <a href="{{ route('kelas') }}" class="px-4 py-2 border border-slate-300 text-slate-700 hover:bg-slate-50 font-medium rounded-lg text-sm transition-colors duration-150">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition-colors duration-150">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto">
        <h1 class="text-2xl font-bold text-slate-800 mb-6 text-center">Update Kelas</h1>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form action="{{ route('kelasUpdate', $data['kelas']->id) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tingkat Kelas</label>
                    <select name="tingkatKelas" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm">
                        <option disabled>Tingkat saat ini: {{ $data['kelas']->Tingkat_kelas }}</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>
                <x-input name="namaKelas" label="Nama Kelas" :value="$data['kelas']->Nama_kelas" placeholder="Masukan nama kelas" />
                <x-input name="waliKelas" label="Nama Wali Kelas" :value="$data['kelas']->Walikelas" placeholder="Masukan nama walikelas" />
                <button type="submit" class="w-full py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors text-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection
